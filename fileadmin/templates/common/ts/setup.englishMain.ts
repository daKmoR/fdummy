## Language ########################################################################################
# default language (english)
config {
	language = en
	sys_language_uid = 0
	htmlTag_langKey = en
	locale_all = en_US.UTF-8
}

# override some language states if german is selected
[globalVar = GP:L = 1]
	config {
		language = de
		sys_language_uid = 1
		htmlTag_langKey = de
		locale_all = de_AT.UTF-8
	}
[global]