<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

## Load Default Configuration ######################################################################
if (is_file(PATH_typo3conf . 'ext/wt_base/Resources/Private/Php/AdditionalConfiguration.php')) {
	require_once(PATH_typo3conf . 'ext/wt_base/Resources/Private/Php/AdditionalConfiguration.php');
}

## Load Site Configuration ######################################################################
if (is_file(PATH_typo3conf . 'ext/site_default/Resources/Private/Php/AdditionalConfiguration.php')) {
	require_once(PATH_typo3conf . 'ext/site_default/Resources/Private/Php/AdditionalConfiguration.php');
}

## Load Host Configuration #########################################################################
if (is_file(PATH_typo3conf . 'hostconf.php')) {
	require_once(PATH_typo3conf . 'hostconf.php');
}
if (is_file(PATH_site . '../hostconf.php')) {
	require_once(PATH_site . '../hostconf.php');
}

?>