####################################################################################################
## cab_tv_getcontentparts
# add the following XML beyond </eType> in TemplaVoila DS:
# <eType_EXTRA type="array">
# 	<objPath>lib.content</objPath>
# </eType_EXTRA>
# <TypoScriptObjPath>lib.content</TypoScriptObjPath>

## Recursive slide #################################################################################
# <INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/templates/default/common/ts/setup.contentslide.ts">
# lib.contentLeft < content.slide
# lib.contentLeft.50.cObject.source.postUserFunc.field = field_contentleft
content.slide = COA
content.slide {
	50 = TEXT
	50 {
		cObject = RECORDS
		cObject {
			source.postUserFunc = tx_cabtvgetcontentparts_pi1->main
			source.postUserFunc.langChild = 1
			tables = tt_content
		}
	}
}

## Content from default page #######################################################################
# lib.contentLeft < content.default
# lib.contentLeft {
# 	50 {
# 		cObject.source.postUserFunc.uid = 7
# 		cObject.source.postUserFunc.field = field_contentleft
# 	}
# }
content.default = COA
content.default {
	50 = TEXT
	50 {
		cObject = RECORDS
		cObject {
			source.postUserFunc = tx_cabtvgetcontentparts_pi1->main
			source.postUserFunc.langChild = 1
			tables = tt_content
		}
		override.cObject = RECORDS
		override.cObject {
			source.current = 1
			tables = tt_content
		}
	}
}

## Content from current page #######################################################################
# lib.content < content.current
content.current = COA
content.current {
	50 = TEXT
	50 {
		cObject = RECORDS
		cObject {
			source.current = 1
			tables = tt_content
		}
	}
}
