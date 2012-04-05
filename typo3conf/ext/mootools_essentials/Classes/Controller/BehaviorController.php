<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Allmer <thomas.allmer@webteam.at>, WEBTEAM GmbH
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package mootools_essentials
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_MootoolsEssentials_Controller_BehaviorController extends Tx_MootoolsEssentials_Controller_BeActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		foreach ($this->settings['manifests'] as $key => $manifest) {
			$this->settings['manifests'][$key] = t3lib_div::getFileAbsFileName($manifest);
		}

		$packager = t3lib_div::makeInstance('Tx_MootoolsEssentials_Domain_Model_Packager');
		$packager->addManifests($this->settings['manifests']);

		$this->template->getPageRenderer()->addCssFile('../typo3conf/ext/mootools_essentials/Resources/Public/Backend/Css/screen.css');

		$this->view->assign('packages', $packager->getBehaviorsAndDelegators());
	}

}
?>