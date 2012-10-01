<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

// If you want to us the local MooTools Manifest uncomment the following lines
// t3lib_extMgm::addTypoScript($_EXTKEY, 'setup', '
// plugin.tx_mootoolsessentials {
// 	settings {
// 		manifests {
// 			Local = EXT:site_default/Resources/Public/Manifests/Local/
// 		}
// 	}
// }
// ', 43);