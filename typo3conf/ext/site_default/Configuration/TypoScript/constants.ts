<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/constants.ts">

## baseUrl for RealURL #############################################################################
baseUrl = http://demo.fdummy.com/
[globalString = _SERVER|HTTPS = on]
  baseUrl = https://demo.fdummy.com/
[global]

[globalString = ENV:HTTP_HOST = fdummy]
  baseUrl = http://fdummy/
[global]
[globalString = ENV:HTTP_HOST = fdummy.clients.moodley.at]
  baseUrl = http://fdummy.clients.moodley.at/
[global]

## default description & keywords ##################################################################
description = standard describtion
keywords = standard keywords

## picture width ###################################################################################
styles.content.imgtext.maxW = 600
styles.content.imgtext.maxWInText = 245