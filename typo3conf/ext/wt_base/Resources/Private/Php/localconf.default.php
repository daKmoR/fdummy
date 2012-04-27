<?php
## Page settings for production-mode ###############################################################
$TYPO3_CONF_VARS['SYS']['sitename'] = 'fDummy';
$TYPO3_CONF_VARS['SYS']['curlUse'] = '1';
$TYPO3_CONF_VARS['SYS']['displayErrors'] = '0';

// activates pageNotFound Handling so bots clear deleted pages from the search index
$TYPO3_CONF_VARS['FE']['pageNotFound_handling'] = '1';
$TYPO3_CONF_VARS['FE']['pageNotFound_handling_statheader'] = 'HTTP/1.1 404 Not Found';

// set session timeout to 1h, so this popup won't appear so often
$TYPO3_CONF_VARS['BE']['sessionTimeout'] = '3600';

// allow editing of *.ts and *.xml files in the TYPO3 BE
$TYPO3_CONF_VARS['SYS']['textfile_ext'] = 'txt,html,htm,css,inc,tmpl,js,sql,ts,xml';

// no deprecation log
$TYPO3_CONF_VARS['SYS']['enableDeprecationLog'] = '';

// file/folder create masks
$TYPO3_CONF_VARS['BE']['fileCreateMask'] = '0666';
$TYPO3_CONF_VARS['BE']['folderCreateMask'] = '0777';

// change access list mode to explicit Allow
$TYPO3_CONF_VARS['BE']['explicitADmode'] = 'explicitAllow';

// use salted user password hashes
#$TYPO3_CONF_VARS['BE']['loginSecurityLevel'] = 'rsa';
#$TYPO3_CONF_VARS['FE']['loginSecurityLevel'] = 'rsa';

// default image configuration
$TYPO3_CONF_VARS['GFX']['gdlib_png'] = '0';
$TYPO3_CONF_VARS['GFX']['TTFdpi'] = '96';
$TYPO3_CONF_VARS['BE']['disable_exec_function'] = '0';

// do not allow donation window
$TYPO3_CONF_VARS['BE']['allowDonateWindow'] = FALSE;

// set required extensions
$TYPO3_CONF_VARS['EXT']['requiredExt'] = 'css_styled_content,realurl,openid';
	
## Additional page settings for development-mode ###################################################
if (is_file(PATH_typo3conf . 'ENABLE_INSTALL_TOOL')) {
	$TYPO3_CONF_VARS['BE']['installToolPassword'] = '49fd0da71f9468b4b7f7d25fcfa4d7d2';
}

if (getenv('TYPO3_CONTEXT') == 'Development') {
	// Default password is "joh316" :
	$TYPO3_CONF_VARS['BE']['installToolPassword'] = 'bacb98acf97e0b6112b1d1b650b84971';
	$TYPO3_CONF_VARS['BE']['lockIP'] = '0';
	$TYPO3_CONF_VARS['BE']['sessionTimeout'] = '86400';
	$TYPO3_CONF_VARS['EXT']['extCache'] = '0';
	$TYPO3_CONF_VARS['EXT']['noEdit'] = '0';
	$TYPO3_CONF_VARS['FE']['debug'] = '1';
	$TYPO3_CONF_VARS['FE']['disableNoCacheParameter'] = '0';
	$TYPO3_CONF_VARS['SYS']['displayErrors'] = '1';
	$TYPO3_CONF_VARS['SYS']['sqlDebug'] = '0';
}