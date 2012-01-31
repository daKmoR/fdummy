<?php

/**
 * Class/Function which offers TCE main hook functions.
 *
 * @author		Jo Hasenau <info@cybercraft.de>
 * @package		TYPO3
 * @subpackage	tx_gridelements
 */

class tx_gridelements_TCEformsHook {

	/**
	 * Function to set the colPos of an element depending on
	 * whether it is a child of a parent container or not
	 * changes are applied to the FieldArray of the parent object by reference
	 *
	 * @param   string          $table: The name of the table we are currently working on
	 * @param   string          $field: The name of the field we are currently working on
	 * @param   array           $row: The data of the current record
	 * @param   \t3lib_TCEforms $parentObject: The parent object that triggered the hook
	 * @return  void
	 *
	 */
	public function getSingleField_beforeRender($table, $field, $row, &$parentObject) {

		if ($field == 'pi_flexform' && $row['CType'] == 'gridelements_pi1' && $row['tx_gridelements_backend_layout']) {
			$layoutSetup = t3lib_div::makeInstance('tx_gridelements_layoutsetup', $row['pid'])
								->getSetup($row['tx_gridelements_backend_layout']);
/*
			$dataStructure = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
				'pi_flexform_ds',
				'tx_gridelements_backend_layout',
				'uid=' . intval($row['tx_gridelements_backend_layout'])
			);
*/
			if ($layoutSetup['pi_flexform_ds']) {
				$parentObject['fieldConf']['config']['ds']['*,gridelements_pi1'] = $layoutSetup['pi_flexform_ds'];
			} else {
				$parentObject['fieldConf']['config']['ds']['*,gridelements_pi1'] = '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
<T3DataStructure>
	<meta type="array">
		<langDisable>1</langDisable>
	</meta>
	<ROOT type="array">
		<tx_templavoila type="array">
			<title>ROOT</title>
		</tx_templavoila>
		<type>array</type>
		<el type="array">
			<field_content type="array">
				<TCEforms type="array">
					<config type="array">
						<type>none</type>
					</config>
				</TCEforms>
			</field_content>
		</el>
	</ROOT>
</T3DataStructure>
';
			}

		}

	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/gridelements/lib/class.tx_gridelements_tceformshook.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/gridelements/lib/class.tx_gridelements_tceformshook.php']);
}

?>