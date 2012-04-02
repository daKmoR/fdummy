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
 * Validator for not xform honeypots and user agent and fe_user cookie
 *
 * @package Extbase
 * @subpackage Validation\Validator
 * @version $Id$
 */
class Tx_Xform_Domain_Validator_XformValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * Checks if
	 * - honeypots are empty (or still have there designated values)
	 * - there is a user agent
	 * - there is a fe_user cookie
	 * if any of these is wrong it dies with a message.
	 *
	 */
	public function isValid() {
		if (t3lib_div::_GP('name') || t3lib_div::_GP('email') || t3lib_div::_GP('e-mail') || t3lib_div::_GP('phone')) {
			die('honeypot filled - u sure you are not a bot?');
		}
		
		if (t3lib_div::_GP('subject') !== strrev(t3lib_div::_GP('subject2'))) {
			die('tempared with subject and subject2 - u sure you are not a bot?');
		}
		
		if (t3lib_div::getIndpEnv('HTTP_USER_AGENT') == "") {
			die('no user agent - u sure you are not a bot?');
		}
		
		if (!$_COOKIE['fe_typo_user']) {
			die('no cookies - pls activate cookies for this page');
		}
		
		return true;
	}
	
}

?>