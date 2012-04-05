<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Loader',
	'include Javascript files and code'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'behaviors',	// Submodule key
		'',						// Position
		array(
			'Behavior' => 'list',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_behaviors.xml',
		)
	);

}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'MooTools Essentials');

?>