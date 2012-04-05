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

include_once t3lib_div::getFileAbsFileName('EXT:mootools_essentials/Resources/Private/Php/Packager/packager.php');

/**
 *
 *
 * @singleton
 * @package mootools_essentials
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_MootoolsEssentials_Domain_Model_Packager extends Packager implements t3lib_Singleton {

	/*
	 * @var array
	 */
	protected $files = array();

	public function __construct() {}

	public function addManifests($manifests) {
		foreach ($manifests as $manifest) {
			$this->add_package($manifest);
		}
	}

	public function addFiles($files = array()) {
		$files = $files ? $files : array();
		$this->setFiles(array_merge($this->getFiles(), $files));
	}

	public function	addFile($file) {
		$this->files[] = $file;
	}

	public function setFiles($files) {
		$this->files = $files;
	}

	public function getFiles() {
		return $this->files;
	}

	public function getCompleteFiles($files = NULL) {
		$files = $files ? $files : $this->getFiles();
		$files = array_unique($files);
		return $this->complete_files($files);
	}

	public function getFilePath($file) {
		$path = $this->get_file_path($file);
		$path = substr($path, strpos($path, 'typo3conf/ext/mootools_essentials'));
		$path = (TYPO3_MODE === 'BE') ? '../' . $path : $path;
		return $path;
	}

	public function getBehaviors() {
		return $this->filterPackages('Behavior.');
	}

	public function getDelegators() {
		return $this->filterPackages('Delegator.');
	}

	public function getBehaviorsAndDelegators() {
		return array_merge($this->getBehaviors(), $this->getDelegators());
	}

	public function getPackages() {
		return $this->filterPackages();
	}

	protected function filterPackages($search = '') {
		$results = array();
		$keys = $this->get_all_files();
		foreach ($keys as $key) {
			if (strpos($key, $search) !== false || $search === '') {
				$results[] = $this->packageNameToObject($key);
			}
		}
		return $results;
	}

	protected function packageNameToObject($key) {
		$package = t3lib_div::makeInstance('Tx_MootoolsEssentials_Domain_Model_Package');
		$package->setKey($key);
		$package->setAuthors($this->get_package_authors($package->getManifest()));
		$package->setDescription($this->get_file_description($key));
		$package->setPath($this->getFilePath($key));

		return $package;
	}

}
?>