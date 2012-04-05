<?php
/*                                                                        *
 * This script belongs to the FLOW3 package "Assets".                     *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Loads MooTools Manifest Files with Dependences
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <m:loadJs file="Core/Request" />
 * </code>
 * <output>
 * // loads the Core/Request File and all it's dependences
 * </output>
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_MootoolsEssentials_ViewHelpers_LoadViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Adds the given file to the packager so it will be included
	 *
	 * @param string $file
	 * @author Thomas Allmer <at@delusionworld.com>
	 */
	public function render($file = NULL) {
		$packager = t3lib_div::makeInstance('Tx_MootoolsEssentials_Domain_Model_Packager');
		$packager->addFile($file);
		return '';
	}
	
}
?>