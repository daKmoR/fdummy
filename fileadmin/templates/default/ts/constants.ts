<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/constants.ts">

## baseUrl for RealURL #############################################################################
baseUrl = http://fdummy.clients.webteam.at/
[globalString = ENV:HTTP_HOST = local.fdummy.clients.webteam.at]
  baseUrl = http://local.fdummy.clients.webteam.at/
[global]

## default description & keywords ##################################################################
description = standard describtion
keywords = standard keywords

## picture width ###################################################################################
styles.content.imgtext.maxW = 600
styles.content.imgtext.maxWInText = 245