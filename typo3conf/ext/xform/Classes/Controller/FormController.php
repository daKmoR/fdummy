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
class Tx_Xform_Controller_FormController extends Tx_Extbase_MVC_Controller_ActionController {

	// /**
	 // * @var Tx_Xform_Domain_Repository_FormRepository
	 // */
	// protected $formRepository;

	// /**
	 // * @param Tx_Xform_Domain_Repository_FormRepository $formRepository
	 // * @return void
	 // */
	// public function injectFormRepository(Tx_Xform_Domain_Repository_FormRepository $formRepository) {
		// $this->formRepository = $formRepository;
	// }
	
	/**
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}
	
	/**
	 * @return void
	 */
	protected function initializeAction() {
		$this->settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
	}

	/**
	 * @param $newForm Tx_Xform_Domain_Model_FormInterface
	 * @dontvalidate $newForm
	 * @return void
	 */
	public function newAction($newForm = NULL) {
		if ($newForm === NULL) {
			$newForm = t3lib_div::makeInstance($this->settings['class']);
		}
		
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templateName = substr($this->settings['class'], strrpos($this->settings['class'], '_')+1);
		$this->view->setTemplatePathAndFilename($templateRootPath . 'Form/New' . $templateName . '.html');
		
		$this->view->assign('newForm', $newForm);
	}

	/**
	 * creates the actual text and sends it via e-mail
	 *
	 * @param $newForm
	 * @validate $newForm Tx_Xform_Domain_Validator_XformValidator
	 * @return void
	 */
	public function createAction(Tx_Xform_Domain_Model_FormInterface $newForm) {
		$newForm->setSettings($this->settings);
	
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templateName = substr($this->settings['class'], strrpos($this->settings['class'], '_')+1);
		
		$emailView = t3lib_div::makeInstance('Tx_Fluid_View_StandaloneView');
		$emailTemplateName = substr($this->settings['class'], strrpos($this->settings['class'], '_')+1);
		$emailView->setTemplatePathAndFilename($templateRootPath . 'Email/' . $emailTemplateName . '.html');
		
		$emailView->assign('templateRootPath', $templateRootPath);
		$emailView->assign('newForm', $newForm);
		$body = $emailView->render();
		
		$this->sendEmails($newForm, $body);
		
		$this->view->setTemplatePathAndFilename($templateRootPath . 'Form/Create' . $templateName . '.html');
		
		$this->view->assign('newForm', $newForm);
		return $this->view->render();
	}
	
	/**
	 * sends all mails configured in the setting sendEmail
	 *
	 * @param $newForm
	 * @param $body string
	 * @return void
	 */	
	public function sendEmails($newForm, $body) {
		if (is_array($this->settings['sendEmail'])) {
			foreach($this->settings['sendEmail'] as $mailSettings) {
				$mail = t3lib_div::makeInstance('t3lib_mail_Message');
				$mail->setFrom(array($newForm->$mailSettings['fromEmailProperty']() => $newForm->$mailSettings['fromNameProperty']()));
				$mail->setTo(array($newForm->$mailSettings['toEmailProperty']() => $newForm->$mailSettings['toNameProperty']()));
				$mail->setSubject($newForm->getEmailSubject());
				$mail->setBody($body, 'text/html');
				$mail->send();
			}
		}
	}
	
	/**
	 * @param $newForm
	 * @validate $newForm Tx_Xform_Domain_Validator_XformValidator
	 * @return void
	 */
	public function createMessageAction(Tx_Xform_Domain_Model_Message $newForm) {
		$this->forward('create', 'Form', 'xform', array('newForm' => $newForm) );
	}	
	
	/**
	 * @param $newForm
	 * @validate $newForm Tx_Xform_Domain_Validator_XformValidator
	 * @return void
	 */
	public function createTipAFriendAction(Tx_Xform_Domain_Model_TipAFriend $newForm) {
		$this->forward('create', 'Form', 'xform', array('newForm' => $newForm) );
	}
	
	/**
	 * @param $newForm
	 * @validate $newForm Tx_Xform_Domain_Validator_XformValidator
	 * @return void
	 */
	public function createCustom1Action(Tx_Xform_Domain_Model_Custom1 $newForm) {
		$this->forward('create', 'Form', 'xform', array('newForm' => $newForm) );
	}

	/**
	 * @param $newForm
	 * @validate $newForm Tx_Xform_Domain_Validator_XformValidator
	 * @return void
	 */
	public function createCustom2Action(Tx_Xform_Domain_Model_Custom2 $newForm) {
		$this->forward('create', 'Form', 'xform', array('newForm' => $newForm) );
	}
	
}
?>