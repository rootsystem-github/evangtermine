<?php
defined('TYPO3') or die('Access denied.');


$extensionkey = 'Evangtermine';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$extensionkey,
	'List',
	array(
		ArbkomEKvW\Evangtermine\Controller\EventcontainerController::class => 'list,show,genericinfo'
	),
	// non-cacheable actions
	array(
		ArbkomEKvW\Evangtermine\Controller\EventcontainerController::class => 'list,show,genericinfo'
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$extensionkey,
	'Detail',
	array(
		ArbkomEKvW\Evangtermine\Controller\EventcontainerController::class => 'show,genericinfo'
	),
	// non-cacheable actions
	array(
		ArbkomEKvW\Evangtermine\Controller\EventcontainerController::class => 'genericinfo'
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$extensionkey,
	'Teaser',
	array(
		ArbkomEKvW\Evangtermine\Controller\EventcontainerController::class => 'teaser,show,genericinfo'
	),
	// non-cacheable actions
	array(
		ArbkomEKvW\Evangtermine\Controller\EventcontainerController::class => 'teaser,show,genericinfo'
	)
);


