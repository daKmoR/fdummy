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
class Tx_Xform_Domain_Model_Custom2 extends Tx_Xform_Domain_Model_Message {

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
	 * @var DateTime
	 * @validate DateTime
	 */
	protected $birthday;

	/**
	 * @var string
	 */
	protected $phone;
	
	/**
	 * @var string
	 */
	protected $firstName2;

	/**
	 * @var string
	 */
	protected $lastName2;
	
	/**
	 * @var DateTime
	 */
	protected $birthday2;
	
	/**
	 * @var string
	 */
	protected $sportType;	
	
	/**
	 * @var DateTime
	 * @validate DateTime
	 */
	protected $classDate;
	
	/**
	 * @var string
	 */
	protected $classStart;
	
	/**
	 * @var string
	 */
	protected $classEnd;
	
	/**
	 * @var string
	 */
	protected $skill;

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
	public function getClassStartValue() {
		return $this->settings['classStarts'][$this->classStart];
	}
	
	/**
	 * @return string
	 */
	public function getClassEndValue() {
		return $this->settings['classEnds'][$this->classEnd];
	}
	
	/**
	 * @return string
	 */
	public function getPrice() {
		$price = 0;
		$singleHour = 38;
		$fivePackHours = 170;
		if ($this->getName2() !== ' ') {
			$singleHour = 48;
			$fivePackHours = 215;
		}
		$duration = ($this->getClassEnd() - $this->getClassStart()) / 100;
		if ($duration >= 5) {
			$price = $fivePackHours;
			$duration -= 5;
		}
		$price += $singleHour * $duration;
		return $price;
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		return $this->getFirstName() . ' ' . $this->getLastName();
	}
	
	/**
	 * @return string
	 */
	public function getName2() {
		return $this->getFirstName2() . ' ' . $this->getLastName2();
	}

	/**
	 * @return string $subject
	 */
	public function getEmailSubject() {
		return $this->getSubject() . ' ' . $this->getClassDate()->format('d.m.Y') . ' ' . $this->getClassStartValue() . ' - ' . $this->getClassEndValue();
	}

}
?>