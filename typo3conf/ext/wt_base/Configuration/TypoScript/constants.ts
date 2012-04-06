# Making sure each line in image captions (of Image content elements) are applied to corresponding image number in the element:
styles.content.imgtext.captionSplit = 1

# enlarge on click should be a lightbox, or a plain link to the image, no fancy inline javascript shit
styles.content.imgtext.linkWrap.lightboxEnabled = 1

# We want absolute no target attribute as it is not XHTML-strict
# compliant and I really don't like new windows (_blank target) !
PAGE_TARGET =
content.pageFrameObj =
styles.content {
	links {
		extTarget =
		target =
	}
	loginform.target =
	mailform.target =
	searchresult {
		resultTarget =
		target =
	}
}
lib.parseFunc.tags.link.typolink.target >