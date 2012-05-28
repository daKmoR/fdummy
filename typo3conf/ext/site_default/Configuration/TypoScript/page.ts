<INCLUDE_TYPOSCRIPT: source="FILE: EXT:wt_base/Configuration/TypoScript/page.ts">

RTE.default {
	loadConfig = EXT:tinymce_rte/static/standard.ts
}

# use zoom enlarge as default for new content elements
TCAdefaults.tt_content.image_zoom = 1