<?php

	// DEFINE your root page id here... this has to be done on every project
	// works only for single domain installations, for multidomain see bottom of this file
	$ROOT_PAGE_ID = 1;

	// realurl - Flush RealURL Cache
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_urldecodecache'] = 'tx_realurl_urldecodecache';
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_urlencodecache'] = 'tx_realurl_urlencodecache';
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_pathcache'] = 'tx_realurl_pathcache';
	// end - Flush RealURL Cache 	

	$TYPO3_CONF_VARS['FE']['addRootLineFields'].= ',tx_realurl_pathsegment';
	
	$tx_realurl_config = array(
		'init' => array(
			'enableCHashCache' => 1,
			'appendMissingSlash' => 'ifNotFile',
			'enableUrlDecodeCache' => 1,
			'enableUrlEncodeCache' => 1,
			'postVarSet_failureMode' => '',
		),
		'redirects' => array(),
		'preVars' => array(
			array(
				'GETvar' => 'no_cache',
					'valueMap' => array(
						'nc' => 1,
					),
					'noMatch' => 'bypass',
				),
				array(
					'GETvar' => 'L',
					'valueMap' => array(
						'de' => '0',
						'en' => '1',
					),
					'valueDefault' => 'de',
					'noMatch' => 'bypass',
				),
			),
			'pagePath' => array(
				'type' => 'user',
				'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
				'spaceCharacter' => '-',
				'languageGetVar' => 'L',
				'expireDays' => 7,
				'rootpage_id' => 1,
				'firstHitPathCache' => 1,
			),
			'fixedPostVars' => array(),
			'postVarSets' => array(
				'_DEFAULT' => array(
					// tt_news archive parameters
					'archive' => array(
						array(
							'GETvar' => 'tx_ttnews[year]' ,
						),
						array(
							'GETvar' => 'tx_ttnews[month]' ,
							'valueMap' => array(
							'january' => '01',
							'february' => '02',
							'march' => '03',
							'april' => '04',
							'may' => '05',
							'june' => '06',
							'july' => '07',
							'august' => '08',
							'september' => '09',
							'october' => '10',
							'november' => '11',
							'december' => '12',
						)
					),
				),
				// tt_news pagebrowser
				'browse' => array(
					array(
						'GETvar' => 'tx_ttnews[pointer]',
					),
				),
				// tt_news categories
				'select_category' => array (
					array(
						'GETvar' => 'tx_ttnews[cat]',
					),
				),
				// tt_news articles anMd searchwords
				'article' => array(
					array(
						'GETvar' => 'tx_ttnews[tt_news]',
						'lookUpTable' => array(
							'table' => 'tt_news',
							'id_field' => 'uid',
							'alias_field' => 'title',
							'addWhereClause' => ' AND NOT deleted',
							'useUniqueCache' => 1,
							'useUniqueCache_conf' => array(
								'strtolower' => 1,
								'spaceCharacter' => '-',
							),
						),
					),
					// tt_news append backID into the link
					array(
						'GETvar' => 'tx_ttnews[backPid]',
					),
					array(
						'GETvar' => 'tx_ttnews[swords]',
					),
				),
				// sr_email_subscribe
				'subscribe' => array(
					array(
						'GETvar' => 'tx_sremailsubscribe_pi1[regHash]'
					)
				),
			),
		),
		// configure filenames for different pagetypes
		'fileName' => array(
			'defaultToHTMLsuffixOnPrev' => 0,
			'index' => array(
				'print.html' => array(
					'keyValues' => array(
						'type' => 98,
					),
				),
				'rss.xml' => array(
					'keyValues' => array(
						'type' => 100,
					),
				),
				'rss091.xml' => array(
					'keyValues' => array(
						'type' => 101,
					),
				),
				'rdf.xml' => array(
					'keyValues' => array(
						'type' => 102,
					),
				),
				'atom.xml' => array(
					'keyValues' => array(
						'type' => 103,
					),
				),
			),
		),
	);

	//disable for multidomain
	$TYPO3_CONF_VARS['EXTCONF']['realurl']['_DEFAULT'] = $tx_realurl_config;
	$TYPO3_CONF_VARS['EXTCONF']['realurl']['_DEFAULT']['pagePath']['rootpage_id'] = $ROOT_PAGE_ID;
	
	//multidomain config
	// $TYPO3_CONF_VARS['EXTCONF']['realurl']['domainA.at'] = $tx_realurl_config;
	// $TYPO3_CONF_VARS['EXTCONF']['realurl']['domainA.at']['pagePath']['rootpage_id'] = 1;
	// $TYPO3_CONF_VARS['EXTCONF']['realurl']['www.domainA.at'] = $TYPO3_CONF_VARS['EXTCONF']['realurl']['domainA.at'];
	
	// $TYPO3_CONF_VARS['EXTCONF']['realurl']['domainB.at'] = $tx_realurl_config;
	// $TYPO3_CONF_VARS['EXTCONF']['realurl']['domainB.at']['pagePath']['rootpage_id'] = 70;
	// $TYPO3_CONF_VARS['EXTCONF']['realurl']['www.domainB.at'] = $TYPO3_CONF_VARS['EXTCONF']['realurl']['domainB.at'];
	
	
	
	
	