<INCLUDE_TYPOSCRIPT: source="FILE: fileadmin/templates/common/direct_mail/ts/setup.TwoColumns.ts">

# set your OWN css if needed
page.10.css.10.file = fileadmin/templates/default/direct_mail/css/TwoColumns.css

# use own plaintext file if needed
tx_directmail_pi1.10.template.file = fileadmin/templates/default/direct_mail/TwoColumns.txt

# unsubscribe page for html and text version
newsletter.unsubscribe.typolink.parameter = 43

# rest all content elments we don't want the default menu or any sliding
lib.header < content.current
lib.content < content.current
lib.contentLeft < content.current
lib.contentRight < content.current
lib.footer < content.current

lib.aboveheader = COA
lib.aboveheader {
	10 = TEXT
	10.value = Falls dieser Newsletter nicht richtig angezeigt wird, klicken Sie bitter hier:<br />
	
	20 < menus.absoluteUrlLink
}

lib.footer {
	60 = TEXT
	60.value = <img src="fileadmin/templates/common/direct_mail/images/footer.jpg" alt="footer" /><br />Wollen Sie keinen Newsletter mehr erhalten klicken Sie bitte 
	60.noTrimWrap = || |
	70 = < newsletter.unsubscribeLink
	80 = TEXT
	80.value = <br />
	90 < menus.footer
	90.special.value = 5
}


