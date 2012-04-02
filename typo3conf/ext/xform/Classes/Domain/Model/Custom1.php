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
class Tx_Xform_Domain_Model_Custom1 extends Tx_Xform_Domain_Model_Message {

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $firstName;

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $lastName;

	/**
	 * @var string
	 */
	protected $gender;

	/**
	 * @var string
	 */
	protected $parentName;
	
	/**
	 * @var string
	 */
	protected $street;

	/**
	 * @var string
	 */
	protected $plz;

	/**
	 * @var string
	 */
	protected $place;

	/**
	 * @var DateTime
	 * @validate DateTime
	 */
	protected $birthday;

	/**
	 * @var string
	 */
	protected $parentPhone;	
	
	/**
	 * @var string
	 */
	protected $sportType;	
	
	/**
	 * @var string
	 */
	protected $classDate;
	
	/**
	 * @var string
	 */
	protected $skill;

	/**
	 * @var string
	 */
	protected $dragLift;

	/**
	 * @var string
	 */
	protected $liftCard;
	
	/**
	 * @return string
	 */
	public function getParticipantName() {
		return $this->getFirstName() . ' ' . $this->getLastName();
	}
	
	/**
	 * @return string
	 */
	public function getSportTypeValue() {
		return $this->settings['sportTypes'][$this->sportType];
	}
	
	/**
	 * @return string
	 */
	public function getSkillValue() {
		return $this->settings['skills'][$this->skill];
	}
	
	/**
	 * @return string
	 */
	public function getLiftCardValue() {
		return $this->settings['liftCards'][$this->liftCard];
	}
	
	/**
	 * @return string
	 */
	public function getClassDateValue() {
		return $this->settings['classDates'][$this->classDate];
	}
	
	/**
	 * @return string
	 */
	public function getPrice() {
		return $this->settings['classPrices'][$this->classDate];
	}

	/**
	 * @return string $subject
	 */
	public function getEmailSubject() {
		return $this->getSubject() . ' ' . $this->getClassDateValue();
	}

}
?>