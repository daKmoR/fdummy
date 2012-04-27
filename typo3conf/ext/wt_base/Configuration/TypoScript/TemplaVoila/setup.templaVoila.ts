## Default page ####################################################################################
# creates default Page Type rendered with TemplaVoila
page {
	10 >
	10 = USER
	10.userFunc = tx_templavoila_pi1->main_page
}

page.includeCSS {
	bootstrap >
	screen >
}

page.headerData.50 >

<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/TemplaVoila/setup.contentslide.ts">