<?php
	$workflow = new \TYPO3\Surf\Domain\Model\SimpleWorkflow();
	$deployment->setWorkflow($workflow);

	$node = new \TYPO3\Surf\Domain\Model\Node('<name>');
	$node->setHostname('<hostname>');
	$node->setOption('username', '<username>');
	$node->setOption('password', '<password>');
	//$node->setOption('port', '26');

	$application = new \TYPO3\Surf\Application\TYPO3v6();
	$application->setDeploymentPath('<pathWithOutTrailingSlash>');
	$application->setOption('repositoryUrl', '<fullGitUrl>');
	$application->setOption('transferMethod', 'rsync');
	$application->setOption('keepReleases', 2);
	$application->addNode($node);

	$deployment->addApplication($application);
?>