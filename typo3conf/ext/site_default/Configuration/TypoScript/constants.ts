<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/constants.ts">

## baseUrl for RealURL #############################################################################
baseUrl = http://demo.fdummy.com/
[globalString = _SERVER|HTTPS = on]
  baseUrl = https://demo.fdummy.com/
[global]

[globalString = ENV:HTTP_HOST = local.demo.fdummy.com]
  baseUrl = http://local.demo.fdummy.com/
[global]
[globalString = ENV:HTTP_HOST = demofdummycom.clients.moodley.at]
  baseUrl = http://demofdummycom.clients.moodley.at/
[global]

## default description & keywords ##################################################################
description = standard describtion
keywords = standard keywords

## picture width ###################################################################################
styles.content.imgtext.maxW = 600
styles.content.imgtext.maxWInText = 245