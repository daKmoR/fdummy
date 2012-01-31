## Menu ############################################################################################
# Menu: default nested ul/li list
# <ul>
#   <li> Item 1 </li>
#   <li> Item 2 <ul>
#     <li> Item 2.1 </li>
#     <li> Item 2.2 </li>
#   </ul> </li>
#   <li> Item 3 </li>
# </ul>
menus.nestedList = HMENU
menus.nestedList {
	1 = TMENU
	1 {
		wrap = <ul class="lvl1">|</ul>
		noBlur = 1

		NO = 1
		NO {
			wrapItemAndSub = <li class="first">|</li> |*| <li>|</li> |*| <li class="last">|</li>
			ATagParams = class="first" |*||*| class="last"
			stdWrap.dataWrap = <span>|</span>
		}
		
		ACT < .NO
		ACT.ATagParams = class="active first" |*| class="active" |*| class="active last"
		ACT.wrapItemAndSub = <li class="active first">|</li> |*| <li class="active">|</li> |*| <li class="active last">|</li>
		
		IFSUB < .NO
		IFSUB.ATagParams = class="ifsub first" |*| class="ifsub" |*| class="ifsub last"
		IFSUB.wrapItemAndSub = <li class="ifsub first">|</li> |*| <li class="ifsub">|</li> |*| <li class="ifsub last">|</li>
		
		ACTIFSUB < .NO
		ACTIFSUB.ATagParams = class="active ifsub first" |*| class="active ifsub" |*| class="active ifsub last"
		ACTIFSUB.wrapItemAndSub = <li class="active ifsub first">|</li> |*| <li class="active ifsub">|</li> |*| <li class="active ifsub last">|</li>
		
		CURIFSUB < .NO
		CURIFSUB.ATagParams = class="active current ifsub first" |*| class="active current ifsub" |*| class="active current ifsub last"
		CURIFSUB.wrapItemAndSub = <li class="active current ifsub first">|</li> |*| <li class="active current ifsub">|</li> |*| <li class="active current ifsub last">|</li>
		
		# CUR needs to be defined after CURIFSUB as otherwise the CURIFSUB won't be taken into account?
		CUR < .NO
		CUR.ATagParams = class="active current first" |*| class="active current" |*| class="active current last"
		CUR.wrapItemAndSub = <li class="active current first">|</li> |*| <li class="active current">|</li> |*| <li class="active current last">|</li>
	}
	
	2 < .1
	2.wrap = <ul class="lvl2">|</ul>
	3 < .1
	3.wrap = <ul class="lvl3">|</ul>
	4 < .1
	4.wrap = <ul class="lvl4">|</ul>
}

menus.nestedListUid < menus.nestedList
menus.nestedListUid {
	1.NO.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.ACT.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.CUR.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.IFSUB.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.ACTIFSUB.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.CURIFSUB.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	
	2 < .1
	2.wrap = <ul class="lvl2">|</ul>
	3 < .1
	3.wrap = <ul class="lvl3">|</ul>
	4 < .1
	4.wrap = <ul class="lvl4">|</ul>
}

# Menu: default nested ul/li list with all menu points (regardless of current level)
menus.nestedListAll < menus.nestedList
menus.nestedListAll {
	1.expAll = 1
	2.expAll = 1
	3.expAll = 1
	4.expAll = 1
}

# Menu: default nested ul/li list with all menu points (regardless of current level)
menus.nestedListUidAll < menus.nestedListUid
menus.nestedListUidAll {
	1.expAll = 1
	2.expAll = 1
	3.expAll = 1
	4.expAll = 1
}

## Active Path #####################################################################################
# gives you only the active path element of the selected level (default level 0)
# 10 < menus.activePath
# # if needed set entryLevel to select level 1,2,3
# 10.entryLevel = 1
menus.activePath = HMENU
menus.activePath {
	1 = TMENU
	1 {
		noBlur = 1
		NO = 1
		NO {
			doNotShowLink = 1
		}
		
		ACT < .NO
		ACT.doNotShowLink = 0
		
		CUR < .ACT
		CUR.ATagParams = class="current"
	}
}
## Absolute URL ####################################################################################
# returns absolute url (e.g. to frontpage): http://localhost/typo3/project/
# temp < menus.absoluteUrl
menus.absoluteUrl = TEXT
menus.absoluteUrl {
	wrap = {$baseUrl} |
	
	typolink {
		parameter.data = page : uid
		returnLast = url
	}
}

## Absolute URL Link ###############################################################################
# returns absolute url (e.g. to frontpage): <a href="http://localhost/typo3/project/">http://localhost/typo3/project/</a>
# temp < menus.absoluteUrlLink
menus.absoluteUrlLink = COA 
menus.absoluteUrlLink {
	10 = TEXT
	10.value = <a href="
	20 < menus.absoluteUrl
	30 = TEXT
	30.value = ">
	40 < menus.absoluteUrl
	50 = TEXT
	50.value = </a>
}

## Simple links ####################################################################################
# a simple Menu with just <a href="#">...</a> <a href="#">...</a> <a href="#">...</a>
# temp < simpleLinks
menus.simpleLinks = HMENU
menus.simpleLinks {
	1 = TMENU
	1 {
		noBlur = 1
		NO = 1
		NO {
			ATagParams = class="first" |*||*| class="last"
			ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
			ATagParams.noTrimWrap = | | |
			stdWrap.dataWrap = <span>|</span>
		}
		ACT < .NO
		ACT.ATagParams = class="active first" |*| class="active" |*| class="active last"

		CUR < .NO
		CUR.ATagParams = class="active current first" |*| class="active current" |*| class="active current last"
		
		IFSUB < .NO
		IFSUB.ATagParams = class="ifsub first" |*| class="ifsub" |*| class="ifsub last"
		
		ACTIFSUB < .NO
		ACTIFSUB.ATagParams = class="active ifsub first" |*| class="active ifsub" |*| class="active ifsub last"
		
		CURIFSUB < .NO
		CURIFSUB.ATagParams = class="active current ifsub first" |*| class="active current ifsub" |*| class="active current ifsub last"
	}
	2 < .1
	3 < .1
	4 < .1
}

# lime simple links but with the id="uid12" where 12 is the id of the page
menus.simpleLinksUid < menus.simpleLinks
menus.simpleLinksUid {
	1.NO.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.ACT.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.CUR.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.IFSUB.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.ACTIFSUB.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	1.CURIFSUB.ATagParams.dataWrap = id="uid{field:uid}" title="{field:title}"
	
	2 < .1
	3 < .1
	4 < .1
}

## Footer menu #####################################################################################
# a common footer menu, looks like:   Impressum  |  Sitemap  |  AGB  |  Karriere
# temp < menus.footer
# temp.special.value = 129
menus.footer = HMENU
menus.footer {
	special = directory
	# set to the footer page
	# special.value = 129
	1 = TMENU
	1 {
		noBlur = 1
		NO.allWrap = | &nbsp; &#124; &nbsp; |*||*| |
		NO.stdWrap.htmlSpecialChars = 1
	}
}

## Breadcrumb Menu #################################################################################
# a common breadcrumb menu, looks like:     home > Produkte > Internet > mein tolles Internet Product
# each item will be cropped after 40 chars; crops only after words
# temp < menus.breadcrumb
menus.breadcrumb = HMENU
menus.breadcrumb {
	special = rootline
	1 = TMENU
	1 {
		noBlur = 1
		NO.allWrap = | &nbsp; &gt; &nbsp; |*||*| |
		NO.stdWrap.htmlSpecialChars = 1
		NO.stdWrap.crop = 40 | ... | 1

		CUR < .NO
		CUR = 1
		CUR.ATagParams = class="current"
	}
}

## Language Menu ###################################################################################
# Language switch with TEXT [de] [en]
# set menus.language.1.NO.stdWrap.override = yourGerman || yourEnglish
# set menus.language.1.ACT.stdWrap.override = yourGerman || yourEnglish
# MODIFY IF YOU NEED MORE LANGUAGES
# menus.language.special.value = 0,1,2
# menus.language.1.NO.stdWrap.override = <span>German</span> || <span>English</span> || <span>Russian</span>
# menus.language.1.ACT.stdWrap.override < menus.language.1.NO.stdWrap.override
# menus.language.1.NO.stdWrap.typolink.ATagParams = class="german" || class="english" || class="russian"
# menus.language.1.NO.stdWrap.typolink.additionalParams = &L=0 || &L=1 || &L=2
# menus.language.1.ACT.stdWrap.wrap = <span class="active german">|</span> || <span class="active english">|</span> || <span class="active russian">|</span>
menus.language = HMENU
menus.language {
	wrap = <div id="language">|</div>
	special = language
	special.value = 0,1
	special.normalWhenNoLanguage = 0
	1 = TMENU
	1 {
		noBlur = 1
		# Standard Sprachen
		NO = 1
		NO {
			# default title would be the pagetitle need to be override with the language labels
			stdWrap.override = <span>[de]</span> || <span>[en]</span>
			# remove default link as there would be no GET params
			doNotLinkIt = 1
			# create new link with current GET params
			stdWrap.typolink { 
				parameter.data = page:uid
				additionalParams = &L=0 || &L=1
				addQueryString = 1
				addQueryString.exclude = L,id,cHash,no_cache
				addQueryString.method = GET
				no_cache = 0
				ATagParams = class="german" || class="english"
			}
		}
		ACT < .NO
		ACT = 1
		ACT {
			stdWrap.typolink > 
			stdWrap.wrap = <span class="active german">|</span> || <span class="active english">|</span>
		}
	}
}

## customImageMenu #################################################################################
# customImageMenu: allows you to define images for each page, which will be displayed instead
#   of the name; 1st picture = default; 2nd = rollover; 3rd = active, current;
# <ul id="nav">
# 	<li class="first">
# 		<a href="#" onmouseover="over('img10_1ff5_0');" onmouseout="out('img10_1ff5_0');"> <img src="#" id="img10_1ff5_0" /> </a>
# 		<ul>
# 			<li class="first">
# 				<a href="#" onmouseover="over('img19_0ac8_0');" onmouseout="out('img19_0ac8_0');"> <img src="#" id="img19_0ac8_0" /> </a>
# 			</li>
# 			<li>
# 				<a href="#" onmouseover="over('img21_0ac8_1');" onmouseout="out('img21_0ac8_1');"> <img src="#" id="img21_0ac8_1" /> </a>
# 			</li>
# 		</ul>
# 	</li>
# 	<li>
# 		<a href="#" onmouseover="over('img4_1ff5_1');" onmouseout="out('img4_1ff5_1');"> <img src="#" id="img4_1ff5_1" /> </a>
# 	</li>
# </ul>
menus.customImageMenu = HMENU
menus.customImageMenu {
	1 = GMENU 
	1 {
		wrap = <ul>|</ul>
		noBlur = 1
	
		NO = 1
		NO {
			wrapItemAndSub = <li class="first">|</li> |*| <li>|</li> |*| <li class="last">|</li>
			
			altImgResource.import = uploads/media/
			altImgResource.import.field = media
			altImgResource.import.listNum = 0
			
			# fall back GIFBUILDER item, if no result from altImgResource:
			XY = 125,25
			backColor = #FFFFFF
			10 = TEXT
			10.text.field = nav_title // title
			10.fontColor = #999999
			#10.fontFile = fileadmin/_projekt/fonts/tahoma.ttf
			10.offset = 10,16
		}
		
		ACT < .NO
		ACT.wrapItemAndSub = <li class="active first">|</li> |*| <li class="active">|</li> |*| <li class="active last">|</li>
		ACT.altImgResource.import.listNum = 1
		
		CUR < .NO
		CUR.wrapItemAndSub = <li class="active current first">|</li> |*| <li class="active current">|</li> |*| <li class="active current last">|</li>
		CUR.altImgResource.import.listNum = 1
		
		#IFSUB < .NO
		#IFSUB.wrapItemAndSub = <li class="ifsub first">|</li> |*| <li class="ifsub">|</li> |*| <li class="ifsub last">|</li>
		
		#ACTIFSUB < .NO
		#ACTIFSUB.wrapItemAndSub = <li class="active ifsub first">|</li> |*| <li class="active ifsub">|</li> |*| <li class="active ifsub last">|</li>
		
		#CURIFSUB < .NO
		#CURIFSUB.wrapItemAndSub = <li class="active current ifsub first">|</li> |*| <li class="active current ifsub">|</li> |*| <li class="active current ifsub last">|</li>
		
		RO < .NO
		RO.altImgResource.import.listNum = 1
		
	}
	2 < .1
	3 < .1
	
	1.ACT.altImgResource.import.listNum = 2
	1.CUR.altImgResource.import.listNum = 2
}

## JumpMenu ############################################################################################
# JumpMenu: selectbox
# <form class="jumpmenu" action="#" method="get">
# 	<fieldset>
# 		<select name="jumpmenu">
# 			<option value="">bitte ausw&auml;hlen</option>
# 			<option value="item-1">Item 1</option>
# 			<option value="item-2">Item 2</option>
# 		</select>
# 	</fieldset>
menus.jumpMenu = COA
menus.jumpMenu {
	10 = COA
	10 {
		wrap = <form class="jumpmenu" action="#" method="get"><fieldset><select name="jumpmenu">|</select></fieldset></form>
		
		10 = TEXT
		10 {
			wrap = <option value="">|</option>
			
			value = bitte ausw&auml;hlen
			lang.en = please select
		}
		
		20 = HMENU
		20 {
			1 = TMENU
			1 {
				NO = 1
				NO {
					doNotLinkIt = 1
					stdWrap.cObject = COA
					stdWrap.cObject {
						10 = COA
						10 {
							wrap = <option value="|">
							
							10 = TEXT
							10.typolink.parameter.field = uid
							10.typolink.returnLast = url
						}
						
						20 = TEXT
						20 {
							wrap = |</option>
							
							field = title
						}
					}
				}
				
				CUR < .NO
				CUR.stdWrap.cObject.10.wrap = <option value="|" selected="selected">
			}
		}
	}
}