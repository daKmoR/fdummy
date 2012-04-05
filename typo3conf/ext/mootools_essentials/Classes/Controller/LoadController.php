<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 
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
class Tx_MootoolsEssentials_Controller_LoadController extends Tx_Extbase_MVC_Controller_ActionController {

	/*
	 * @var Tx_MootoolsEssentials_Domain_Model_Packager
	 */
	protected $packager;

	/**
	 * includes all needed Javascript
	 *
	 * @return void
	 */
	public function loadAction() {
		$this->load($this->settings);
		return '';
	}

	/**
	 *
	 */
	public function __construct() {
		$this->packager = t3lib_div::makeInstance('Tx_MootoolsEssentials_Domain_Model_Packager');
	}

	/**
	 * @param array $settings
	 */
	public function loadManifests($settings) {
		foreach ($settings['manifests'] as $key => $manifest) {
			$settings['manifests'][$key] = t3lib_div::getFileAbsFileName($manifest);
		}

		$this->packager->addManifests($settings['manifests']);
	}
	
	/**
	 * @param array $settings
	 */
	public function load($settings) {
		$this->loadManifests($settings);
		$this->packager->addFiles($settings['load']['files']);
		$files = $this->packager->getCompletePackages();

		$renderer = t3lib_div::makeInstance('t3lib_PageRenderer');
		foreach ($files as $file) {
			$renderer->addJsFooterLibrary($file->getKey(), $file->getPath($file));
			$cssFileArray = $file->getCssFile();

			$path = $settings['manifests'][$cssFileArray['manifest']] . $cssFileArray['path'];
			if ($path !== '') {
				$path = t3lib_div::getFileAbsFileName($path);
				$path = substr($path, strpos($path, 'typo3conf/ext'));
				$path = (TYPO3_MODE === 'BE') ? '../' . $path : $path;
				$renderer->addCssFile($path);
			}
		}

		if ($settings['language'] !== 'en-US' && $settings['language'] !== '') {
			$renderer->addJsFooterInlineCode('mootoolsLanguage', "Locale.use('" . $settings['language'] . "');");
		}

		if ($this->hasPackage('Behavior/Behavior', $files)) {
			if ($this->hasPackage('Behavior/Delegator', $files)) {
				$renderer->addJsFooterInlineCode('behaviorAndDelegatorAtBottom', "var myBehavior = new Behavior().apply(document.body);	var myDelegator = new Delegator({getBehavior: function(){ return myBehavior; }}).attach(document.body);");
			} else {
				$renderer->addJsFooterInlineCode('behaviorAtBottom', "var myBehavior = new Behavior().apply(document.body);");
			}
		} else {
			if ($this->hasPackage('Behavior/Delegator', $files)) {
				$renderer->addJsFooterInlineCode('delegatorAtBottom', "var myDelegator = new Delegator().attach(document.body);");
			}
		}
	}
	
	/**
	 * @param string $search
	 * @param array $packages
	 * @return bool
	 */
	public function hasPackage($search, $packages) {
		foreach($packages as $package) {
			if ($package->getKey() === $search) {
				return TRUE;
			}
		}
		return FALSE;
	}

}
?>