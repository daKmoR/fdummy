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
class Tx_MootoolsEssentials_Domain_Model_Package {

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * @var string
	 */
	protected $authors;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @return string $name
	 */
	public function getName() {
		$parts = explode('/', $this->key);
		return $parts[1];
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$parts = explode('/', $this->key);
		$this->key = $parts[0] . '/' . $name;
	}

	/**
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param string $manifest
	 */
	public function setManifest($manifest) {
		$parts = explode('/', $this->key);
		$this->manifest = $manifest . '/' . $parts[1];
	}

	/**
	 * @return string
	 */
	public function getManifest() {
		$parts = explode('/', $this->key);
		return $parts[0];
	}

	/**
	 * @param string $key
	 */
	public function setKey($key) {
		$this->key = $key;
	}

	/**
	 * @return string
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @param string $authors
	 */
	public function setAuthors($authors) {
		$this->authors = $authors[0];
	}

	/**
	 * @return string
	 */
	public function getAuthors() {
		return $this->authors;
	}

	public function getAuthor() {
		preg_match_all('/\[(.*?)\]/', $this->getAuthors(), $matches);
		return $matches[1][0];
	}

	public function getAuthorUrl() {
		preg_match_all('/\((.*?)\)/', $this->getAuthors(), $matches);
		return $matches[1][0];
	}

	/**
	 * @param string $path
	 */
	public function setPath($path) {
		$this->path = $path;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

}
?>