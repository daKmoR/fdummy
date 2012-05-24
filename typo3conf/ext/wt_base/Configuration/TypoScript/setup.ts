## Language ########################################################################################
config {
	# only append the language value if not the default language
	linkVars = L(1)
	# prevent creation of double linkVars www.page.com/index.php?id=12&L=1&L=1 
	# is just a cosmetical fix
	uniqueLinkVars = 1
	sys_language_overlay = hideNonTranslated
	sys_language_mode = content_fallback
}

# default language (german)
config {
	language = de
	sys_language_uid = 0
	htmlTag_langKey = de
	locale_all = de_AT.UTF-8
}

plugin.tx_indexedsearch._DEFAULT_PI_VARS.lang = 0
plugin.tx_pagenotfoundhandler.operator = ODER
plugin.tx_mootoolsessentials.settings.language = de-DE

## Anti-Spam #######################################################################################
config {
	spamProtectEmailAddresses = -2
}

## Header ##########################################################################################
config {
	doctype = html5
	removeDefaultJS = external
	concatenateCss = 1
	# compressCss = 1
	concatenateJs = 1
	# compressJs = 1
}

# get meta tags by default from the page with the uid 1
page.meta.keywords.cObject = RECORDS
page.meta.keywords.cObject {
	tables = pages
	source = 1
	dontCheckPid = 1
	conf.pages = TEXT
	conf.pages.field = keywords
}

page.meta.description.cObject = RECORDS
page.meta.description.cObject {
	tables = pages
	source = 1
	dontCheckPid = 1
	conf.pages = TEXT
	conf.pages.field = description
}

# override meta tags if defined at page level
page.meta {
	keywords.override.field = keywords
	description.override.field = description
}

## Default CSS #####################################################################################
page.includeCSS {
	bootstrap = EXT:wt_base/Resources/Public/Bootstrap/Css/bootstrap.css
	# the responsive css is disabled by default
	#bootstrapResponsive = EXT:wt_base/Resources/Public/Bootstrap/Css/bootstrap-responsive.css
	screen = EXT:site_default/Resources/Public/Css/screen.css
}

page.headerData {
	50 = TEXT
	50.value (
		<!--[if IE 7]> <link rel="stylesheet" href="typo3conf/ext/site_default/Resources/Public/Css/screen_ie7.css" type="text/css" media="screen" /> <![endif]-->
		<!--[if IE 8]> <link rel="stylesheet" href="typo3conf/ext/site_default/Resources/Public/Css/screen_ie8.css" type="text/css" media="screen" /> <![endif]-->
	)
}

## RealUrl #########################################################################################
config {
	baseURL = {$baseUrl}
	simulateStaticDocuments = 0
	tx_realurl_enable = 1
	prefixLocalAnchors = all
}

# remove link-targets
config.extTarget = 
tt_content.uploads.20.linkProc.target =

# "to top"-link
tt_content.stdWrap.innerWrap2 = | <a class="totop" href="#">&#9650; nach oben</a><br class="clear" />

## Frame ###########################################################################################
tt_content.stdWrap.innerWrap.cObject {
  50 = TEXT
  50.value = <div class="box">|</div>

  60 = TEXT
  60.value = <div class="scrollBarBoth">|</div>

  70 = TEXT
  70.value = <div class="scrollBarVertical">|</div>
	
  80 = TEXT
  80.value = <div class="scrollBarHorizontal">|</div>
}

## Indexed Search ##################################################################################
page.config {
	index_enable = 1
	index_externals = 0
}

plugin.tx_indexedsearch {
	search.rootPidList = 1
	show.advancedSearchLink = 0
	
	_DEFAULT_PI_VARS.type = 1
	_DEFAULT_PI_VARS.ext = 1
	
	show {
		rules = 0
		clearSearchBox = 0
	}
	
	blind {
		type = 1
		defOp = 1
		sections = 1
		freeIndexUid = 1
		media = 1
		order = 1
		group = 1
		lang = 1
		desc = 1
		results = 1
		extResume = 1
	}
	
	_DEFAULT_PI_VARS.lang = 0
	_DEFAULT_PI_VARS.results = 10
	_CSS_DEFAULT_STYLE >
}

## pagenotfound_handler ############################################################################
plugin.tx_pagenotfoundhandler {
	redirect = 1
	minRating = 80
}

## Formular Settings ###############################################################################
tt_content.mailform.20 {
	accessibility = 1
	noWrapAttr = 1
	formName = mailform
	dontMd5FieldNames = 1
	REQ = 1
	layout = <div>###LABEL### ###FIELD###</div>
	COMMENT.layout = <div>###LABEL###</div>
	RADIO.layout = <div>###FIELD###</div>
	LABEL.layout = <div>###LABEL### ###FIELD###</div>
	labelWrap.wrap = |
	commentWrap.wrap = |
	radioWrap.wrap = |
	stdWrap.wrap = <fieldset> | </fieldset>
	params.radio = class="csc-mailform-radio"
	params.check = class="csc-mailform-check"
	params.submit = class="csc-mailform-submit"
}

## Default page ####################################################################################
# creates default Page Type rendered with Fluidtemplate
page = PAGE
page {
	typeNum = 0
	
	bodyTag >
	bodyTagCObject = TEXT
	bodyTagCObject.field = uid
	bodyTagCObject.wrap = <body id="pid|">
	
	10 = FLUIDTEMPLATE
	10 {
		file.stdWrap.cObject = CASE
		file.stdWrap.cObject {
			# slide the template
			key.data = levelfield:-1, backend_layout_next_level, slide
			key.override.field = backend_layout
			# default template file
			default = TEXT
			default.value = EXT:site_default/Resources/Private/Templates/Page/TwoColumns.html
			# template file for backend-layout with ID 2
			2 = TEXT
			2.value = EXT:site_default/Resources/Private/Templates/Page/ThreeColumns.html
			3 = TEXT
			3.value = EXT:site_default/Resources/Private/Templates/Page/OneColumn.html
			4 = TEXT
			4.value = EXT:site_default/Resources/Private/Templates/Page/TwoColumns.html
		}
	}
}

## set default loadings ############################################################################
lib.header = COA
lib.header {
	50 < styles.content.get
	50.select.where = colPos = 4
}

lib.leftContent = COA
lib.leftContent {
	50 < styles.content.get
	50.select.where = colPos = 2
}

lib.content = COA
lib.content {
	50 < styles.content.get
	50.select.where = colPos = 1
	110 = TEXT
	110.value = &#xA0;
}

lib.rightContent = COA
lib.rightContent {
	50 < styles.content.get
	50.select.where = colPos = 3
}

lib.footer = COA
lib.footer {
	50 < styles.content.get
	50.select.where = colPos = 5
}

## FE display ######################################################################################
# no Anchors in the FE
tt_content.stdWrap.dataWrap >
tt_content.stdWrap.prepend.dataWrap >

# DO NOT AUTOLINK EVERY STRING THAT STARTS WITH HTTP OR MAILTO
# such strings in the content are assumed to be intentional
# lib.parseFunc_RTE.makelinks >
# lib.parseFunc_RTE.externalBlocks.ul.stdWrap.parseFunc.makelinks = 0
# lib.parseFunc_RTE.externalBlocks.ol.stdWrap.parseFunc.makelinks = 0

# DEFINE DEFAULT HEADER
# lib.stdheader.10.1.fontTag = <h2>|</h2>

# NO csc-header
lib.stdheader.stdWrap.dataWrap >

# lightbox size 
tt_content.image.20.1.imageLinkWrap {
	width = 860m
	height = 540m
}

<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/menus.ts">

## Cache & Debug ###################################################################################
# disable cache and concatenate if any typo3 be-user is logged in, otherwise remove debug-comments
[globalVar = TSFE:beUserLogin > 0]
	config {
		no_cache = 1
		concatenateCss = 0
		# compressCss = 0
		concatenateJs = 0
		# compressJs = 0
	}
	plugin.tx_mootoolsessentials.settings.behavior.breakOnErrors = true
	plugin.tx_mootoolsessentials.settings.delegator.breakOnErrors = true
[else]
	config.disablePrefixComment = 1
[global]