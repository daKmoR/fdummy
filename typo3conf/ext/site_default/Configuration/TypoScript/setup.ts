<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.ts">
# if you need multilanguage uncomment the following line
<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.multilanguage.ts">
# if english is your second language (most common case) uncomment the following line
<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/setup.english.ts">

## Header ##########################################################################################
lib.header = COA
lib.header {
	10 = IMAGE
	10 {
		file = EXT:site_default/Resources/Public/Css/Images/logo.png
		stdWrap.typolink {
			parameter = 1
			ATagParams = id="homeLink"
		}
	}
}

lib.headerMenu < menus.nestedList
lib.headerMenu.1.wrap = <ul class="nav lvl1">|</ul>
lib.headerMenu.2 >

## Left Content ####################################################################################
# get first content from parentpage up to rootpage # use additional slide.collect = -1 to get all content
lib.leftContent.50.slide = -1

# Menu: default nested ul/li list
lib.leftMenu < menus.nestedList
lib.leftMenu.entryLevel = 1
lib.leftMenu.1.wrap = <ul class="nav nav-list lvl1">|</ul>
lib.leftMenu.2 >

## Content #########################################################################################
# so far nothing defined

## Right Content ###################################################################################
# so far nothing defined

## Footer ##########################################################################################
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

[globalVar = TSFE:id = 6]
	<INCLUDE_TYPOSCRIPT: source="FILE: EXT:xform/Configuration/TypoScript/setup.txt">
	plugin.tx_xform {
		view {
			#templateRootPath = fileadmin/templates/default/xform/
		}
	}
[global]