<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.ts">
# if you use TemplaVoila uncomment the following line
# <INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/TemplaVoila/setup.templaVoila.ts">
# if you need multilanguage uncomment the following line
# <INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.multilanguage.ts">
# if english is your second language (most common case) uncomment the following line
# <INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.english.ts">

## Global ##########################################################################################
# the Bootstrap responsive css is disabled by default
page.includeCSS.bootstrapResponsive >

# uses a custom bootstrap with [...] example: @gridGutterWidth: 8px; @gridColumns: 4; @gridColumnWidth: 187px;
# page.includeCSS.bootstrap = EXT:site_default/Resources/Public/Css/bootstrap.min.css

# allow HTML in the header of an element
# lib.stdheader.10.setCurrent.htmlSpecialChars = 0

## Language ########################################################################################

## Header ##########################################################################################
lib.headerMenu < menus.nestedList
lib.headerMenu.2 >

## lib.leftContent #################################################################################

# Menu: default nested ul/li list
lib.leftMenu < menus.nestedList
lib.leftMenu.entryLevel = 1
lib.leftMenu.1.wrap = <ul class="nav nav-list lvl1">|</ul>
lib.leftMenu.2 >

## lib.content #####################################################################################
lib.content {
	10 = TEXT
	10.data = page:title
	10.wrap = <header><h1>|</h1></header>
}

## lib.rightContent ################################################################################

## lib.footer ######################################################################################
lib.footerMenu < menus.footer
lib.footerMenu.special.value = 4

####################################################################################################
## Special page options ############################################################################
# options for a specific page
# [globalVar = TSFE:id = 23]
# options for a page and its subpages (list possible)
# [PIDinRootline = 13]
# options for subpages only (list possible)
# [PIDupinRootline = 13,37]

# Home
[globalVar = TSFE:id = 1]
	lib.content.10 >
[global]








## Dev Mode ########################################################################################
# if you want to always use it - not only if you logged in (usefull for example if testing multiple
# browser you just have comment the first line
[globalVar = TSFE:id = -1]
	config {
		no_cache = 1
		concatenateCss = 0
		concatenateJs = 0
	}
	plugin.tx_mootoolsessentials.settings.behavior.breakOnErrors = true
	plugin.tx_mootoolsessentials.settings.delegator.breakOnErrors = true
[global]

## include some post setup ts ######################################################################
<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.post.ts">