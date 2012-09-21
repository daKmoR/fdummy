<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

## Load Default Configuration ######################################################################
if (is_file(PATH_typo3conf . 'ext/wt_base/Resources/Private/Php/localconf.default.php')) {
	require_once(PATH_typo3conf . 'ext/wt_base/Resources/Private/Php/localconf.default.php');
}

## Load Site Configuration ######################################################################
if (is_file(PATH_typo3conf . 'ext/site_default/Resources/Private/Php/localconf.site.php')) {
	require_once(PATH_typo3conf . 'ext/site_default/Resources/Private/Php/localconf.site.php');
}

## Load Host Configuration #########################################################################
if (is_file(PATH_typo3conf . 'hostconf.php')) {
	require_once(PATH_typo3conf . 'hostconf.php');
}
if (is_file(PATH_site . '../hostconf.php')) {
	require_once(PATH_site . '../hostconf.php');
}

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!

$TYPO3_CONF_VARS['EXT']['extList'] = 'extbase,info,perm,func,filelist,about,version,tsconfig_help,context_help,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,aboutmodules,setup,taskcenter,info_pagetsconfig,viewpage,t3skin,t3editor,reports,felogin,form,fluid,tinymce_rte,site_default,cshmanual,opendocs,recycler,scheduler,workspaces,mootools_stack,mootools_essentials,gridelements';	// Modified or inserted by TYPO3 Extension Manager. Modified or inserted by TYPO3 Core Update Manager. 
// Updated by TYPO3 Core Update Manager 31-01-12 12:27:18
$TYPO3_CONF_VARS['SYS']['encryptionKey'] = '109e0c8d057cdec2b5d220756a0cd8cde90e91737d41518eeb8da1c77e5c8845fb948eb1ad9dbc325a609a714a452f95';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.7';	// Modified or inserted by TYPO3 Install Tool. 
// Updated by TYPO3 Install Tool 31-01-12 12:27:30
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'extbase,version,install,t3skin,felogin,form,fluid,tinymce_rte,site_default,workspaces,mootools_stack,mootools_essentials,gridelements';	// Modified or inserted by TYPO3 Extension Manager. 
$TYPO3_CONF_VARS['EXT']['extConf']['extbase'] = 'a:0:{}';	// Modified or inserted by TYPO3 Extension Manager. 
$TYPO3_CONF_VARS['EXT']['extConf']['fluid'] = 'a:0:{}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['tinymce_rte'] = 'a:2:{s:10:"loadConfig";s:34:"EXT:tinymce_rte/static/standard.ts";s:18:"pageLoadConfigFile";s:34:"EXT:tinymce_rte/static/pageLoad.ts";}';	//  Modified or inserted by TYPO3 Extension Manager.
$TYPO3_CONF_VARS['EXT']['extConf']['realurl'] = 'a:5:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"0";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager.
// Updated by TYPO3 Extension Manager 16-05-12 13:26:43
// Updated by TYPO3 Install Tool 16-05-12 15:59:01
// Updated by TYPO3 Extension Manager 16-05-12 15:59:20
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installsysexts'] = '1';	//  Modified or inserted by TYPO3 Upgrade Wizard.
// Updated by TYPO3 Upgrade Wizard 16-05-12 15:59:20
// Updated by TYPO3 Extension Manager 16-05-12 15:59:30
$TYPO3_CONF_VARS['INSTALL']['wizardDone']['tx_coreupdates_installnewsysexts'] = '1';	//  Modified or inserted by TYPO3 Upgrade Wizard.
// Updated by TYPO3 Upgrade Wizard 16-05-12 15:59:31
$TYPO3_CONF_VARS['EXT']['extConf']['em'] = 'a:1:{s:17:"selectedLanguages";s:2:"de";}';	//  Modified or inserted by TYPO3 Extension Manager.
// Updated by TYPO3 Extension Manager 21-09-12 12:26:00
?>