<?php

require_once(t3lib_extMgm::extPath('cms') . 'layout/interfaces/interface.tx_cms_layout_tt_content_drawitemhook.php');

/**
 * Class/Function which manipulates the rendering of item example content and replaces it with a grid of child elements.
 *
 * @author		Jo Hasenau <info@cybercraft.de>
 * @package		TYPO3
 * @subpackage	tx_gridelements
 */
class tx_gridelements_drawItemHook implements tx_cms_layout_tt_content_drawItemHook {

	/**
	 * Processes the item to be rendered before the actual example content gets rendered
	 * Deactivates the original example content output
	 *
	 * @param \tx_cms_layout    $parentObject: The parent object that triggered this hook
	 * @param boolean           $drawItem: A switch to tell the parent object, if the item still must be drawn
	 * @param string            $headerContent: The content of the item header
	 * @param string            $itemContent: The content of the item itself
	 * @param array             $row: The current data row for this item
	 * @return	void
	 */
	public function preProcess(tx_cms_layout &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row) {

		if ($row['CType'] === 'gridelements_pi1') {

			$drawItem = FALSE;
			$itemContent = '';
			$tempContent = '';
			$head = array();
			$gridContent = array();
			$editUidList = array();
			$colPosValues = array();
			$items = array();
			$parserRows = array();
			$singleColumn = FALSE;

			// get the layout record for the selected backend layout if any
			$layoutUid = $row['tx_gridelements_backend_layout'];
			$layoutSetup = t3lib_div::makeInstance('tx_gridelements_layoutsetup', $row['pid'])
				->getSetup($layoutUid);
#			$backendLayoutRecord = t3lib_BEfunc::getRecord('tx_gridelements_backend_layout', $layoutUid);

			// initialize TS parser to parse config to array
#			$parser = t3lib_div::makeInstance('t3lib_TSparser');
#			$parser->parse($backendLayoutRecord['config']);
#			$parserRows = $backendLayoutSetup['config']['backend_layout.']['rows.'];
			$parserRows = $layoutSetup['config']['rows.'];

			$showHidden = $parentObject->tt_contentConfig['showHidden'] ? '' : t3lib_BEfunc::BEenableFields('tt_content');

			// if there is anything to parse, lets check for existing columns in the layout

			if (count($parserRows) > 0) {

				foreach ($parserRows as $parserRow) {

					if (is_array($parserRow['columns.']) && count($parserRow['columns.']) > 0) {

						foreach ($parserRow['columns.'] as $parserColumns) {
							$name = $GLOBALS['LANG']->sL($parserColumns['name'], true);

							if ($parserColumns['colPos'] != '') {
								$colPosValues[intval($parserColumns['colPos'])] = $name;
							} else {
								$colPosValues[256] = $name
									? $name
									: $GLOBALS['LANG']->getLL('notAssigned');
							}

						}

					}

				}

			} else {
				$singleColumn = TRUE;

				// Due to the pid being "NOT USED" in makeQueryArray we have to set pidSelect here
				$originalPidSelect = $parentObject->pidSelect;
				$parentObject->pidSelect = $row['pid'];

				$queryParts = $parentObject->makeQueryArray(
					'tt_content',
					$row['pid'],
					'AND colPos = -1 AND tx_gridelements_container=' .
					$row['uid'] .
					$showHidden .
					$parentObject->showLanguage
				);

				// Due to the pid being "NOT USED" in makeQueryArray we have to reset pidSelect here
				$parentObject->pidSelect = $originalPidSelect;

				$result = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray($queryParts);
				$items = $parentObject->getResult($result);
				$colPosValues[] = 0;
			}

			// if there are any columns, lets build the content for them
			if (count($colPosValues) > 0) {

				foreach ($colPosValues as $colPos => $name) {

					// first we have to create the column content separately for each column
					// so we can check for the first and the last element to provide proper sorting
					if ($singleColumn === FALSE) {

						// Due to the pid being "NOT USED" in makeQueryArray we have to set pidSelect here
						$originalPidSelect = $parentObject->pidSelect;
						$parentObject->pidSelect = $row['pid'];

						$queryParts = $parentObject->makeQueryArray(
							'tt_content',
							$row['pid'],
							'AND colPos = -1 AND tx_gridelements_container=' .
							$row['uid'] .
							' AND tx_gridelements_columns=' .
							$colPos .
							$showHidden .
							$parentObject->showLanguage
						);

						// Due to the pid being "NOT USED" in makeQueryArray we have to reset pidSelect here
						$parentObject->pidSelect = $originalPidSelect;

						$result = $GLOBALS['TYPO3_DB']->exec_SELECT_queryArray($queryParts);
						$items = $parentObject->getResult($result);
					}

					// Low priority 
					/*if($row['pi_flexform']) {

						$dataStructArray = t3lib_div::xml2array($layoutSetup['pi_flexform_ds']);

						if(is_array($dataStructArray)) {

							$flexformTools = t3lib_div::makeInstance('t3lib_flexformtools');

								// Get flexform XML data:
							$xmlData = $row['pi_flexform'];

								// Convert charset:
							if ($flexformTools->convertCharset) {
								$xmlHeaderAttributes = t3lib_div::xmlGetHeaderAttribs($xmlData);
								$storeInCharset = strtolower($xmlHeaderAttributes['encoding']);
								if ($storeInCharset) {
									$currentCharset = $GLOBALS['LANG']->charSet;
									$xmlData = $GLOBALS['LANG']->csConvObj->conv($xmlData, $storeInCharset, $currentCharset, 1);
								}
							}

							$editData = t3lib_div::xml2array($xmlData);
							if (!is_array($editData)) {
								return 'Parsing error: ' . $editData;
							}

								// Language settings:
							$langChildren = $dataStructArray['meta']['langChildren'] ? 1 : 0;
							$langDisabled = $dataStructArray['meta']['langDisable'] ? 1 : 0;

								// empty or invalid <meta>
							if (!is_array($editData['meta'])) {
								$editData['meta'] = array();
							}
							$editData['meta']['currentLangId'] = array();
							$languages = $flexformTools->getAvailableLanguages();

							foreach ($languages as $lInfo) {
								$editData['meta']['currentLangId'][] = $lInfo['ISOcode'];
							}
							if (!count($editData['meta']['currentLangId'])) {
								$editData['meta']['currentLangId'] = array('DEF');
							}
							$editData['meta']['currentLangId'] = array_unique($editData['meta']['currentLangId']);

							if ($langChildren || $langDisabled) {
								$lKeys = array('DEF');
							} else {
								$lKeys = $editData['meta']['currentLangId'];
							}

								// Tabs sheets
							if (is_array($dataStructArray['sheets'])) {
								$sKeys = array_keys($dataStructArray['sheets']);
							} else {
								$sKeys = array('sDEF');
							}

								// Traverse languages:
							foreach ($lKeys as $lKey) {
								foreach ($sKeys as $sheet) {
									$sheetCfg = $dataStructArray['sheets'][$sheet];
									list ($dataStruct, $sheet) = t3lib_div::resolveSheetDefInDS($dataStructArray, $sheet);

										// Render sheet:
									if (is_array($dataStruct['ROOT']) && is_array($dataStruct['ROOT']['el'])) {
										$lang = 'l' . $lKey; // Separate language key
										$PA['vKeys'] = $langChildren && !$langDisabled ? $editData['meta']['currentLangId'] : array('DEF');
										$PA['lKey'] = $lang;
										$PA['callBackMethod_value'] = '';
										$PA['table'] = 'tt_content';
										$PA['field'] = 'pi_flexform';
										$PA['uid'] = $row['uid'];

										$flexformTools->traverseFlexFormXMLData_DS = &$dataStruct;
										$flexformTools->traverseFlexFormXMLData_Data = &$editData;

											// Render flexform:
										$flexformTools->traverseFlexFormXMLData_recurse(
											$dataStruct['ROOT']['el'],
											$editData['data'][$sheet][$lang],
											$PA,
												'data/' . $sheet . '/' . $lang
										);
									} else {
										return 'Data Structure ERROR: No ROOT element found for sheet "' . $sheet . '".';
									}
								}
							}
						} else {
							return 'Data Structure ERROR: ' . $dataStructArray;
						}
					}

					t3lib_utility_Debug::debug($flexformTools->traverseFlexFormXMLData_DS);
					t3lib_utility_Debug::debug($flexformTools->traverseFlexFormXMLData_Data);

					*/

					if ($colPos < 255) {
						$newP = $parentObject->newContentElementOnClick(
							$row['pid'],
							'-1&tx_gridelements_container=' .
							$row['uid'] .
							'&tx_gridelements_columns=' .
							$colPos,
							$parentObject->lP);
					}

					// if there are any items, we can create the HTML for them just like in the original TCEform
					if (count($items) > 0) {

						foreach ($items as $itemRow) {

							if(is_array($itemRow)) {

								if (intval($itemRow['colPos']) < 255 && intval($itemRow['colPos']) > -1) {
									// update query for a "soft" migration from TV style to Grid View
									$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
										'tt_content',
										'uid=' . $itemRow['uid'],
										array(
										     'colPos' => -1,
										)
									);
								}
								$singleElementHTML = $parentObject->tt_content_drawHeader(
									$itemRow,
									$parentObject->tt_contentConfig['showInfo']
										? 15
										: 5,
									$parentObject->defLangBinding && $parentObject->lP > 0,
									TRUE);

								$isRTE = $parentObject->RTE && $parentObject->isRTEforField('tt_content', $itemRow, 'bodytext');
								$singleElementHTML .= '<div ' .
								                      ($itemRow['_ORIG_uid']
									                      ? ' class="ver-element"'
									                      : '') .
								                      '>' .
								                      $parentObject->tt_content_drawItem($itemRow, $isRTE) .
								                      '</div>';

								// NOTE: this is the end tag for <div class="t3-page-ce-body">
								// because of bad (historic) conception, starting tag has to be placed inside tt_content_drawHeader()
								$singleElementHTML .= '</div>';

								$statusHidden = $parentObject->isDisabled('tt_content', $itemRow)
									? ' t3-page-ce-hidden'
									: '';

								$gridContent[$colPos] .= '<div class="t3-page-ce' . $statusHidden . '">' .
								                         $singleElementHTML .
								                         '</div>';
								$editUidList[$colPos] .= $editUidList[$colPos]
									? ',' . $itemRow['uid']
									: $itemRow['uid'];
							}

						}

					}

					// we will need a header for each of the columns to activate mass editing for elements of that column
					$head[$colPos] = $parentObject->tt_content_drawColHeader(
						$name,
						($parentObject->doEdit && $editUidList[$colPos])
							? '&edit[tt_content][' . $editUidList[$colPos] . ']=edit' .
							  $parentObject->pageTitleParamForAltDoc
							: '',
						$newP);

				}

			}

			// if we got a selected backend layout, we have to create the layout table now
			if ($layoutUid && !$parentObject->tt_contentConfig['languageMode'] && isset($layoutSetup['config'])) {

				$grid = '<div class="t3-gridContainer' .
					($layoutSetup['frame']
						? ' t3-gridContainer-' . $layoutSetup['frame']
						: ''
					) .
				'">';
				if ($layoutSetup['frame']) {
					$grid .= '<h4 class="t3-gridContainer-title-' . $layoutSetup['frame'] . '">' .
						 $GLOBALS['LANG']->sL($layoutSetup['title'], TRUE) .
					'</h4>';
				}
				$grid .= '<table border="0" cellspacing="1" cellpadding="4" width="100%" height="100%" class="t3-page-columns t3-gridTable">';

				// add colgroups
				$colCount = intval($layoutSetup['config']['colCount']);
				$rowCount = intval($layoutSetup['config']['rowCount']);

				$grid .= '<colgroup>';

				for ($i = 0; $i < $colCount; $i++) {
					$grid .= '<col style="width:' . (100 / $colCount) . '%"></col>';
				}

				$grid .= '</colgroup>';

				// cycle through rows
				for ($layoutRow = 1; $layoutRow <= $rowCount; $layoutRow++) {
					$rowConfig = $layoutSetup['config']['rows.'][$layoutRow . '.'];

					if (!isset($rowConfig)) {
						continue;
					}

					$grid .= '<tr>';

					for ($col = 1; $col <= $colCount; $col++) {
						$columnConfig = $rowConfig['columns.'][$col . '.'];

						if (!isset($columnConfig)) {
							continue;
						}

						// which column should be displayed inside this cell
						$columnKey = $columnConfig['colPos'] != '' ? intval($columnConfig['colPos']) : 256;

						// render the grid cell

						$colSpan = intval($columnConfig['colspan']);
						$rowSpan = intval($columnConfig['rowspan']);

						$grid .= '<td valign="top"' .
						         (isset($columnConfig['colspan'])
							         ? ' colspan="' . $colSpan . '"'
							         : '') .
						         (isset($columnConfig['rowspan'])
							         ? ' rowspan="' . $rowSpan . '"'
							         : '') .
						         'id="column-' . $row['uid'] . 'x' . $columnKey . '" class="t3-gridCell t3-page-column t3-page-column-' . $columnKey .
						         (!isset($columnConfig['colPos'])
							         ? ' t3-gridCell-unassigned'
							         : '') .
						         (isset($columnConfig['colspan'])
							         ? ' t3-gridCell-width' . $colSpan
							         : '') .
						         (isset($columnConfig['rowspan'])
							         ? ' t3-gridCell-height' . $rowSpan
							         : '') . '">';

						$grid .= ($GLOBALS['BE_USER']->uc['hideColumnHeaders'] ? '' : $head[$columnKey]) . $gridContent[$columnKey];
						$grid .= '</td>';
					}

					$grid .= '</tr>';

				}

				$itemContent .= $grid . '</table>';
				// otherwise we can just output the content of the grid container without additional layout
			} else {
				$itemContent = '<div class="t3-gridContainer">';
				$itemContent .= '<table border="0" cellspacing="1" cellpadding="4" width="100%" height="100%" class="t3-page-columns t3-gridTable">';
				$itemContent .= '<tr><td valign="top" class="t3-gridCell t3-page-column t3-page-column-0">' . $gridContent[0] . '</td></tr>';
				$itemContent .= '</table>';
			}
			if(count($piFlexformValues)) {
				$itemContent .= '<table border="0" cellspacing="1" cellpadding="4" class="t3-page-additional-gridInfo">';
				foreach($piFlexformValues as $key => $value) {
					$itemContent .= '<tr><th>' . $GLOBALS['LANG']->getLL($key) . ':</th><td>' . $value . '</td></tr>';
				}
				$itemContent .= '</table>';
			}
			$itemContent .= '</div>';
		}

		if($row['CType'] === 'shortcut') {
			$drawItem = FALSE;
			if($row['records']) {

				$shortcutItems = t3lib_div::trimExplode(',', $row['records']);

				foreach($shortcutItems as $shortcutItem) {
					if(strpos($shortcutItem, '_') === FALSE || strpos($shortcutItem, 'tt_content_') !== FALSE) {

						$shortcutItem = str_replace('tt_content_', '', $shortcutItem);

						$itemRow = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
							'*',
							'tt_content',
							'uid=' . $shortcutItem
						);

						//t3lib_utility_Debug::debug($itemRow);

						$singleElementHTML = '<div class="reference">';
						
						$singleElementHTML .= $parentObject->tt_content_drawHeader(
							$itemRow,
							$parentObject->tt_contentConfig['showInfo']
								? 15
								: 5,
							$parentObject->defLangBinding && $parentObject->lP > 0,
							TRUE);

						$isRTE = $parentObject->RTE && $parentObject->isRTEforField('tt_content', $itemRow, 'bodytext');
						$singleElementHTML .= '<div ' .
							($itemRow['_ORIG_uid']
							  ? ' class="ver-element"'
							  : '') .
							'>' .
							$parentObject->tt_content_drawItem($itemRow, FALSE) .
							'</div>';

						// NOTE: this is the end tag for <div class="t3-page-ce-body">
						// because of bad (historic) conception, starting tag has to be placed inside tt_content_drawHeader()
						$singleElementHTML .= '<div class="reference-overlay"></div></div></div>';
					} else {
						$singleElementHTML = '';
					}

					$itemContent .= $singleElementHTML;
				}

			}
		}

	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/gridelements/class.tx_gridelements_drawitemhook.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/gridelements/class.tx_gridelements_drawitemhook.php']);
}

?>