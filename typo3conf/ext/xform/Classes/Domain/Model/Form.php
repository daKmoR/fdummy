<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Allmer <at@delusionworld.com>, WEBTEAM GmbH
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
 * @package xform
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Xform_Domain_Model_Form extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Xform_Domain_Model_FormInterface {

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * @var string
	 * @validate EmailAddress
	 */
	protected $email;

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $nameClient;

	/**
	 * @var string
	 * @validate EmailAddress
	 */
	protected $emailClient;
	
	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $subject;
	
	/**
	 * @var array
	 */
	protected $settings;

	/**
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getNameClient() {
		return $this->nameClient;
	}

	/**
	 * @param string $nameClient
	 * @return void
	 */
	public function setNameClient($nameClient) {
		$this->nameClient = $nameClient;
	}

	/**
	 * @return string
	 */
	public function getEmailClient() {
		return $this->emailClient;
	}

	/**
	 * @param string $emailClient
	 * @return void
	 */
	public function setEmailClient($emailClient) {
		$this->emailClient = $emailClient;
	}

	/**
	 * @return string $subject
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * @param string $subject
	 * @return void
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
	}
	
	/**
	 * @return string $subject
	 */
	public function getEmailSubject() {
		return $this->getSubject();
	}

	/**
	 * @return string $settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * @param string $settings
	 * @return void
	 */
	public function setSettings($settings) {
		$this->settings = $settings;
	}

	/**
	 * Magic method to support automatic setters and getters
	 * 
	 * @return mixed
	 */
	public function __call($method, $args) {
		$property = lcfirst(substr($method, 3));
		if (strpos($method, 'set') === 0 && property_exists($this, $property)) {
			$this->$property = $args[0];
		}
		if (strpos($method, 'get') === 0 && property_exists($this, $property)) {
			return $this->$property;
		}
	}

}
?>