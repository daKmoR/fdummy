# define default Language Label and Flag
mod.SHARED {
	defaultLanguageLabel = German
	defaultLanguageFlag = at
}

## Frame ###########################################################################################
TCEFORM {
  tt_content {
    section_frame {
      removeItems = 1,5,6,10,11,12,20,21
      addItems.50 = Box
      addItems.60 = ScrollBar Both
      addItems.70 = ScrollBar Vertical
      addItems.80 = ScrollBar Horizontal
    }
  }
}
# set in setupTS
# tt_content.stdWrap.innerWrap.cObject {
#   50 = TEXT
#   50 {
#     value = <div class="box">|</div>
#   }
# }

## new Content Element wizard ############################################################
# use tabs
mod.wizards.newContentElement.renderMode = tabs
# only show text & textpic
mod.wizards.newContentElement.wizardItems.common.show = text,textpic,image

# Pages will NOT have "(copy)" appended:
TCEMAIN.table.pages.disablePrependAtCopy = 1
# Content will NOT have "(copy)" appended:
TCEMAIN.table.tt_content.disablePrependAtCopy = 1