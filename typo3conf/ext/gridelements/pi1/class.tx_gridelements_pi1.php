<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Jo Hasenau <info@cybercraft.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib . 'class.tslib_pibase.php');


/**
 * Plugin 'Grid Element' for the 'gridelements' extension.
 *
 * @author	Jo Hasenau <info@cybercraft.de>
 * @package	TYPO3
 * @subpackage	tx_gridelements
 */
class tx_gridelements_pi1 extends tslib_pibase {

	public $prefixId = 'tx_gridelements_pi1'; // Same as class name
	public $scriptRelPath = 'pi1/class.tx_gridelements_pi1.php'; // Path to this script relative to the extension dir.
	public $extKey = 'gridelements'; // The extension key.
	public $pi_checkCHash = true;

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content = '', $conf = array()) {

		// first we have to take care of possible flexform values containing additional information
		// that is not available via DB relations. It will be added as "virtual" key to the existing data Array
		// so that you can easily get the values with TypoScript
		$this->pi_initPIflexForm();
		$this->getPiFlexFormData();

		// now we have to find the children of this grid container regardless of their column
		// so we can get them within a single DB query instead of doing a query per column
		// but we will only fetch those columns that are used by the current grid layout
		$element = $this->cObj->data['uid'];
		$layout = $this->cObj->data['tx_gridelements_backend_layout'];

		/** @var tx_gridelements_layoutsetup $layoutSetup  */
		$layoutSetup = t3lib_div::makeInstance('tx_gridelements_layoutsetup', $this->cObj->data['pid'], $conf);

		$availableColumns = $layoutSetup->getLayoutColumns($layout);
		$children = $this->getChildren($element, $availableColumns['CSV']);

		// and we have to determine the frontend setup related to the backend layout record which is assigned to this container
		$setup = $layoutSetup->getTypoScriptSetup($layout);

		// if there are any children available, we can start with the render process
		if (count($children)) {
			// we need a sorting columns array to make sure that the columns are rendered in the order
			// that they have been created in the grid wizard but still be able to get all children
			// within just one SELECT query
			$sortColumns = t3lib_div::trimExplode(',', $availableColumns['CSV']);

			$columns = $this->renderChildren($children, $setup, $sortColumns, $availableColumns);

			// if there are any columns available, we can go on with the render process
			if (count($columns)) {
				$content = $this->renderColumns($columns, $setup);
			}
		}

		// finally we can unset the columns setup as well and apply stdWrap operations to the overall result
		// before returning the content
		unset($setup['columns.']);
		$content = count($setup)
			? $this->cObj->stdWrap($content, $setup)
			: $content;

		return $content;

	}

	/**
	 * fetches all available columns for a certain grid container
	 *
	 * @param   int     $layout: The selected backend layout of the grid container
	 * @return  CSV     $availableColumns: The columns available for the selected layout as CSV list
	 * @deprecated Use $this->layoutSetup->getLayoutColumns($layoutId) instead
	 *
	 */
	public function getAvailableColumns($layout = 0) {

		t3lib_div::logDeprecatedFunction();

		$availableColumns = array();

		if ($layout) {
			$backendLayout = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
				'*',
				'tx_gridelements_backend_layout',
				'uid=' . $layout
			);
			if (isset($backendLayout['config']) && $backendLayout['config']) {
				/** @var t3lib_TSparser $parser  */
				$parser = t3lib_div::makeInstance('t3lib_TSparser');
				$parser->parse($backendLayout['config']);

				$backendLayout['__config'] = $parser->setup;

				// create colPosList
				if ($backendLayout['__config']['backend_layout.'] && $backendLayout['__config']['backend_layout.']['rows.']) {
					foreach ($backendLayout['__config']['backend_layout.']['rows.'] as $row) {
						if (isset($row['columns.']) && is_array($row['columns.'])) {
							foreach ($row['columns.'] as $column) {
								$availableColumns[] = $column['colPos'];
							}
						}
					}
				}
			}
		}

		return implode(',', $availableColumns);

	}

	/**
	 * fetches all available children for a certain grid container
	 *
	 * @param   int     $element: The uid of the grid container
	 * @param   CSV     $availableColumns: A list of available column IDs
	 * @return  array   $children: The child elements of this grid container
	 *
	 */
	public function getChildren($element = 0, $availableColumns = '') {

		$children = array();

		if ($element) {
			$rawChildren = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'*',
				'tt_content',
				'tx_gridelements_container = ' . $element . $this->cObj->enableFields('tt_content') . ' AND colPos != -2 AND tx_gridelements_columns IN (' . $availableColumns . ')',
				'',
				'sorting ASC'
			);

            if (is_array($rawChildren) && count($rawChildren) >= 1) {
                foreach ($rawChildren as $child) {
                    $GLOBALS['TSFE']->sys_page->versionOL('tt_content', $child);
                    if ($overlay = $this->languageOverlay($child)) {
                        $children[] = $overlay;
                    }
                }
            }
        }

		return $children;

	}

	/**
	 * Language overlay for each of the children
	 *
	 * @param   array   $row: The record data to be translated
	 * @param   string  $table: The table the record has been coming from
	 * @return  array   $row: The translated record data
	 */
	public function languageOverlay($row, $table = 'tt_content') {

		if (is_array($row) && $GLOBALS['TSFE']->sys_language_contentOL) {
			$row = $GLOBALS['TSFE']->sys_page->getRecordOverlay(
				$table,
				$row,
				$GLOBALS['TSFE']->sys_language_content,
				$GLOBALS['TSFE']->sys_language_contentOL
			);
		}

		return $row;

	}

	/**
	 * fetches values from the grid flexform and assigns them to virtual fields in the data array
	 *
	 * @return void
	 *
	 */
	public function getPiFlexFormData() {

		$piFlexForm = $this->cObj->data['pi_flexform'];

		if (is_array($piFlexForm['data'])) {
			foreach ($piFlexForm['data'] as $sheet => $data) {
				foreach ($data as $lang => $value) {
					foreach ($value as $key => $val) {
						$this->cObj->data['flexform_' . $key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet);
					}
				}
			}
		}

	}

	/**
	 * fetches the setup for each of the columns
	 * assigns a default setup if there is none available
	 *
	 * @param   int     $layout: The selected backend layout of the grid container
	 * @param   array   $conf: The TypoScript setup of the grid container
	 * @return  array   $setup: The adjusted TypoScript setup for the container or a default setup
	 * @deprecated Use $this->layoutSetup->getTypoScriptSetup($layoutId) instead
	 *
	 */
	public function getSetup($layout = 0, $conf = array()) {

		t3lib_div::logDeprecatedFunction();

		$setup = array();

		if ($layout == '0' && isset($conf['setup.']['default.'])) {
			$setup = $conf['setup.']['default.'];
		} else if ($layout && isset($conf['setup.'][$layout . '.'])) {
			$setup = $conf['setup.'][$layout . '.'];
		} else if ($layout) {
			$setup = $conf['setup.']['default.'];
		}

		// if there is none, we will use a reference to the tt_content setup as a default renderObj
		// without additional stdWrap functionality
		if (!count($setup)) {
			$setup['columns.']['default.']['renderObj'] = '<tt_content';
		}

		return $setup;

	}

	/**
	 * renders the children of the grid container and
	 * puts them into their respective columns
	 *
	 * @param   array   $children: The children available for the grid container
	 * @param   array   $setup: The adjusted setup for the grid container
	 * @param   array   $sortColumns: An Array of column positions within the grid container in the order they got in the grid setup
	 * @param   array   $availablColumns: A CSV list of available columns together with the allowed elements for each of them
	 * @return  array   $columns: The columns of the grid container containing the HTML output of their children
	 *
	 */
	public function renderChildren($children = array(), $setup = array(), $sortColumns = array(), $availableColumns = array()) {

		$columns = array();

		// we need the array values as keys
		if(count($sortColumns) > 0) {
			foreach($sortColumns as $column_number) {
				$columns[$column_number . '.'] = '';
			}
		}
		// and have to remove the "unused elements" column first
		unset($columns['-2']);

		$counter = count($children);
		// first we have to make a backup copy of the original data array
		// and we have to modify the depth counter to avoid stopping too early
		$tempRecord = $this->cObj->currentRecord;
		$tempData = $this->cObj->data;
		$parsedData = array();
		foreach($tempData as $key => $value) {
		    if(substr($key, 0, 11) != 'parentgrid_') {
			$parsedData['parentgrid_'.$key] = $value;
		    }
		}
		$GLOBALS['TSFE']->cObjectDepthCounter += $counter;


		// each of the children will now be rendered separately and the output will be added to it's particular column
		foreach ($children as $child) {

			$this->cObj->data = array_merge($child, $parsedData);
			$this->cObj->currentRecord = 'tt_content:' . $child['uid'];

			$column_number = intval($child['tx_gridelements_columns']);
			$column = $column_number . '.';
			if (!isset($setup['columns.'][$column])) {
				$setupColumn = 'default.';
			} else {
				$setupColumn = $column;
			}

//			if(
//				t3lib_div::inList($availableColumns[$column], $this->cObj->data['CType']) ||
//				$availableColumns[$column] == '*'
//			) {
				$columns[$column] .= $this->cObj->cObjGetSingle(
					$setup['columns.'][$setupColumn]['renderObj'],
					$setup['columns.'][$setupColumn]['renderObj.']
				);
//			}

		}

		// now we can reset the depth counter and the data array so that the element will behave just as usual
		// it is important to do this before any stdWrap functions are applied to the grid container
		// since they will depend on the original data
		$GLOBALS['TSFE']->cObjectDepthCounter -= $counter;
		$this->cObj->data = $tempData;
		$this->cObj->currentRecord = $tempRecord;

		return $columns;

	}

	/**
	 * renders the columns of the grid container and returns the actual content
	 *
	 * @param   array   $columns: The columns of the grid container containing the HTML output of their children
	 * @param   array   $setup: The adjusted setup of the grid container
	 * @return  array   $content: The raw HTML output of the grid container before stdWrap functions will be applied to it
	 *
	 */
	public function renderColumns($columns = array(), $setup = array()) {

		$content = '';

		foreach ($columns as $column => $columnContent) {
			// if there are any columns available, we have to determine the corresponding TS setup
			// and if there is none we are going to use the default setup
			$tempSetup = isset($setup['columns.'][$column])
				? $setup['columns.'][$column]
				: $setup['columns.']['default.'];
			// now we just have to unset the renderObj
			// before applying the rest of the keys via the usual stdWrap operations
			unset($tempSetup['renderObj']);
			unset($tempSetup['renderObj.']);
			$columns[$column] = count($tempSetup)
				? $this->cObj->stdWrap($columnContent, $tempSetup)
				: $columnContent;
			$content .= $columns[$column];
		}

		return $content;

	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/gridelements/pi1/class.tx_gridelements_pi1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/gridelements/pi1/class.tx_gridelements_pi1.php']);
}

?>