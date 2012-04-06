## Language Meta Tags ##############################################################################
# get the meta tags from the language overlay
# if you want to add additional languages you have to create the overlay for the root page first and
# set it's id to source
# [globalVar = GP:L = 2]
# 	page.meta.keywords.cObject.source = 5
# 	page.meta.description.cObject.source = 5
# [global]

[globalVar = GP:L > 0]
	page.meta.keywords.cObject {
		tables = pages_language_overlay
		conf.pages_language_overlay = TEXT
		conf.pages_language_overlay.field = keywords
	}

	page.meta.description.cObject {
		tables = pages_language_overlay
		conf.pages_language_overlay = TEXT
		conf.pages_language_overlay.field = description
	}
[global]