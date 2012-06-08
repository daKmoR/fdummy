<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.ts">
# if you use TemplaVoila uncomment the following line
# <INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/TemplaVoila/setup.templaVoila.ts">
# if you need multilanguage uncomment the following line
# <INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.multilanguage.ts">
# if english is your second language (most common case) uncomment the following line
# <INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.english.ts">

## Global ##########################################################################################
# the Bootstrap responsive css is disabled by default
# page.includeCSS.bootstrapResponsive >

## Language ########################################################################################

## Header ##########################################################################################
lib.headerMenu < menus.nestedList
lib.headerMenu.1.wrap = <ul class="nav lvl1">|</ul>
lib.headerMenu.2 >

## lib.leftContent #################################################################################

# Menu: default nested ul/li list
lib.leftMenu < menus.nestedList
lib.leftMenu.entryLevel = 1
lib.leftMenu.1.wrap = <ul class="nav nav-list lvl1">|</ul>
lib.leftMenu.2 >

## lib.content #####################################################################################

## lib.rightContent ################################################################################

## lib.footer ######################################################################################
lib.footer {
	5 = TEXT
	5.value = WEBTEAM GmbH - Münzgrabenstrasse 36 - 8010 Graz - <a href="mailto:office@webteam.at">office@webteam.at</a>
}

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