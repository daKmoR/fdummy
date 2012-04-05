<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_extMgm::addTypoScript($_EXTKEY, 'setup', '
plugin.tx_mootoolsessentials {
	settings {
		manifests {
			Stack = EXT:mootools_stack/Resources/Public/Manifests/Stack/
			MooTools-DatePicker = EXT:mootools_stack/Resources/Public/Manifests/MootoolsDatepicker/
		}
	}
}
', 43);

?>