<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Xform',
	array(
		'Form' => 'new, create, createMessage, createTipAFriend, createCustom1, createCustom2',
	),
	// non-cacheable actions
	array(
		'Form' => 'create, createMessage, createTipAFriend, createCustom1, createCustom2',
	)
);

?>