<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/templates/common/ts/setup.ts">
# if you need multilanguage uncomment the following line
<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/templates/common/ts/setup.multilanguage.ts">
# if english is your second language (most common case) uncomment the following line
<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/templates/common/ts/setup.english.ts">

## Page Layout #####################################################################################
page.includeCSS {
	base = fileadmin/templates/default/css/base.css
	screen = fileadmin/templates/default/css/screen.css
}

#	<link rel="stylesheet" href="css/base.css" type="text/css" media="screen" />
#	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" />
#	<!--[if IE 8]> <link rel="stylesheet" href="css/screen_ie8.css" type="text/css" media="screen" /> <![endif]-->
#	<!--[if IE 7]> <link rel="stylesheet" href="css/screen_ie7.css" type="text/css" media="screen" /> <![endif]-->

#content.currentWrap.9.value = <div class="content"><!--TYPO3SEARCH_begin-->
#content.currentWrap.200 = TEXT
#content.currentWrap.200.value = <!--TYPO3SEARCH_end--></div>

## Header ##########################################################################################
lib.header = COA
lib.header {
	10 = IMAGE
	10 {
		file = fileadmin/templates/default/css/images/logo.png
		stdWrap.typolink {
			parameter = 1
			ATagParams = id="homeLink"
		}
	}
	
	20 < menus.footer
	20.special.value = 1
	20.2 >
	20.3 >
	20.wrap = <div id="headerMenu">|</div>
	
	50 < styles.content.get
	50.select.where = colPos = 4
}

## Left Content ####################################################################################
# Menu: default nested ul/li list
lib.contentLeft = COA
lib.contentLeft {
	10 < menus.nestedList
	10.entryLevel = 1
	10.1.wrap = <ul id="menu">|</ul>
	50 < styles.content.get
	50.select.where = colPos = 2
	# get first content from parentpage up to rootpage # use additional slide.collect = -1 to get all content
	50.slide = -1
}

lib.contentLeft.110 = TEXT
lib.contentLeft.110.value = &#xA0;

## Content #########################################################################################
lib.content = COA
lib.content {
	50 < styles.content.get
	50.select.where = colPos = 1
}

lib.content.110 = TEXT
lib.content.110.value = &#xA0;

## Right Content ###################################################################################
lib.contentRight = COA
lib.contentRight {
	50 < styles.content.get
	50.select.where = colPos = 3
}
lib.contentRight.110 = TEXT
lib.contentRight.110.value = &#xA0;

## Footer ##########################################################################################
lib.footer = COA
lib.footer {
	5 = TEXT
	5.value = <div id="footerText">WEBTEAM GmbH - Münzgrabenstrasse 36 - 8010 Graz - <a href="mailto:office@webteam.at">office@webteam.at</a></div>
	10 < menus.footer
	10.special.value = 4
	10.wrap = <div id="footerMenu">|</div>
	20 = TEXT
	20.value = <br class="clear" />
	50 < styles.content.get
	50.select.where = colPos = 5
}

####################################################################################################
## Special page options ############################################################################
# options for a specific page
# [globalVar = TSFE:id = 23]
# options for a page and its subpages (list possible)
# [PIDinRootline = 13]
# options for subpages only (list possible)
# [PIDupinRootline = 13,37]



##
## DEVELOPMENT #####################################################################################
##
plugin.tx_mootoolspackager_pi1 {
	mergeFiles = 0
	mergeFiles.cache = 0
}
