<?php
	$workflow = new \TYPO3\Surf\Domain\Model\SimpleWorkflow();
	$deployment->setWorkflow($workflow);

	$node = new \TYPO3\Surf\Domain\Model\Node('<name>'); //examples clients: webteamatClientsWebteamAt live: webteamAt
	$node->setHostname('<hostname>'); //examples clients: clients.webteam.at live: webteam.at
	$node->setOption('username', '<username>'); //examples clients: webteamat live: userabc
	$node->setOption('password', '<password>');
	//$node->setOption('port', '26');

	$application = new \TYPO3\Surf\Application\TYPO3v6();
	$application->setDeploymentPath('<pathWithOutTrailingSlash>'); //examples clients: /home/webteamat live: /home/userabc/www/
	$application->setOption('repositoryUrl', '<fullGitUrl>'); //example: git@git.webteam.at:clients/webteamat.git
	$application->setOption('transferMethod', 'rsync');
	$application->setOption('keepReleases', 2);
	$application->addNode($node);

	$deployment->addApplication($application);
?>