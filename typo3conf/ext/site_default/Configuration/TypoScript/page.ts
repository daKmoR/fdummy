<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/page.ts">

RTE.default {
	loadConfig = EXT:tinymce_rte/static/standard.ts
	
	linkhandler {
		tt_news {
			24 {
				# instead of default you could write the id of the storage folder
				# id of the Single News Page
				parameter = 23
				additionalParams = &tx_ttnews[tt_news]={field:uid}
				additionalParams.insertData = 1
				# you need: uid, hidden, header [this is the displayed title] (use xx as header to select other properties)
				# you can provide: bodytext [alternative title], starttime, endtime [to display the current status]
				select = uid,title as header,hidden,starttime,endtime,bodytext
				sorting = crdate desc
			}
		}
	}
	
}

# set zoom enlarge as default for new content elements
TCAdefaults.tt_content.image_zoom = 1

# enable categories for tt_address
TCEFORM.tt_address.module_sys_dmail_category.PAGE_TSCONFIG_IDLIST = 40
TCEFORM.tt_address.module_sys_dmail_category.disabled = 0

# enable categories in recipient lists
TCEFORM.sys_dmail_group.select_categories.PAGE_TSCONFIG_IDLIST = 40
TCEFORM.sys_dmail_group.select_categories.disabled = 0

# enable categories for content elements
#TCEFORM.tt_content.module_sys_dmail_category.PAGE_TSCONFIG_IDLIST = 40
#TCEFORM.tt_content.module_sys_dmail_category.disabled = 0

# enable categories for fe_users
#TCEFORM.fe_users.module_sys_dmail_category.PAGE_TSCONFIG_IDLIST = 40
#TCEFORM.fe_users.module_sys_dmail_category.disabled = 0
