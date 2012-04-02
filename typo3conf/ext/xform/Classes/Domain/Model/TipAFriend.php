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
class Tx_Xform_Domain_Model_TipAFriend extends Tx_Xform_Domain_Model_Message {

	/**
	 * @var string
	 */
	protected $requestUrl;

	/**
	 * @return string $requestUrl
	 */
	public function getRequestUrl() {
		if ($this->requestUrl === NULL || $this->requestUrl === '') {
			$this->setRequestUrl(t3lib_div::getIndpEnv('TYPO3_REQUEST_URL'));
		}
		return $this->requestUrl;
	}
	
	/**
	 * @return string $requestUrl encapsulated with "<|>"
	 */
	public function getRequestUrlForTextMail() {
		return '<' . $this->requestUrl . '>';
	}

	/**
	 * @param string $requestUrl
	 * @return void
	 */
	public function setRequestUrl($requestUrl) {
		$this->requestUrl = $requestUrl;
	}
	
	/**
	 * @return string $subject
	 */
	public function getEmailSubject() {
		return $this->getSubject() . ' ' . $this->getNameClient();
	}

}
?>