<?php

/*
 * This file is part of the TYPO3 project.
 *
 * @author Frank Berger <fberger@sudhaus7.de>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace ArbkomEKvW\Evangtermine\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2021 Christoph Roth <christoph.roth@ekvw.de>, Evangelische Kirche von Westfalen
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

use ArbkomEKvW\Evangtermine\Domain\Model\Categorylist;
use ArbkomEKvW\Evangtermine\Domain\Model\EtKeys;
use ArbkomEKvW\Evangtermine\Domain\Model\Grouplist;
use ArbkomEKvW\Evangtermine\Domain\Repository\EventcontainerRepository;
use ArbkomEKvW\Evangtermine\Util\Etpager;
use ArbkomEKvW\Evangtermine\Util\ExtConf;
use ArbkomEKvW\Evangtermine\Util\SettingsUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * EventcontainerController
 */
class EventcontainerController extends ActionController
{
    /**
     * @var ArbkomEKvW\Evangtermine\Domain\Repository\EventcontainerRepository
     */
    protected $eventcontainerRepository;

    /**
     * Uid value of current tt_content record
     * serves as unique id of this plugin instance, used for session identification
     * @var int
     */
    private $currentPluginUid;

    /**
     * session data
     * @var array
     */
    private $session;

    /**
     * @var ArbkomEKvW\Evangtermine\Util\SettingsUtility
     */
    private $settingsUtility;

    /**
     * @var ArbkomEKvW\Evangtermine\Domain\Model\Categorylist
     */
    private $categorylist;

    /**
     * @var ArbkomEKvW\Evangtermine\Domain\Model\Grouplist
     */
    private $grouplist;

    /**
     * @var ArbkomEKvW\Evangtermine\Domain\Model\EtKeys
     */
    private $etkeys;

    /**
     * @var ArbkomEKvW\Evangtermine\Util\Etpager
     */
    private $pager;

    /**
     * @param SettingsUtility
     */
    public function injectSettingsUtility(SettingsUtility $settingsUtility)
    {
        $this->settingsUtility = $settingsUtility;
    }

    /**
     * @param EventcontainerRepository
     */
    public function injectEventcontainerRepository(EventcontainerRepository $eventcontainerRepository)
    {
        $this->eventcontainerRepository = $eventcontainerRepository;
    }

    /**
     * @param Categorylist $categorylist
     */
    public function injectCategorylist(Categorylist $categorylist)
    {
        $this->categorylist = $categorylist;
    }

    /**
     * @param Grouplist $grouplist
     */
    public function injectGrouplist(Grouplist $grouplist)
    {
        $this->grouplist = $grouplist;
    }

    /**
     * @param Etpager $pager
     */
    public function injectPager(Etpager $pager)
    {
        $this->pager = $pager;
    }

    /**
     * (non-PHPdoc)
     * @see \TYPO3\CMS\Extbase\Mvc\Controller\ActionController::initializeAction()
     */
    protected function initializeAction()
    {
        $this->currentPluginUid = $this->configurationManager->getContentObject()->data['uid'];

        $this->session = $this->loadSession();

        // if etkeys were stored before,
        if (isset($this->session['etkeysJson'])) {
            $this->etkeys = GeneralUtility::makeInstance(EtKeys::class);
            $this->etkeys->initFromJson($this->session['etkeysJson']);
        }

        // include CSS and JS
        $this->includeAdditionalHeaderData();
    }

    /**
     * load session data
     * @return mixed
     */
    private function loadSession()
    {
        // load session, but only for this single plugin instance
        $sessionKey = 'tx_evangtermine' . $this->currentPluginUid;
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', $sessionKey);

        return $sessionData;
    }

    /**
     * save session data
     */
    private function saveSession()
    {
        $sessionKey = 'tx_evangtermine' . $this->currentPluginUid;

        // Replace object with Json representation
        $this->session['etkeysJson'] = $this->etkeys->toJson();

        $GLOBALS['TSFE']->fe_user->setKey('ses', $sessionKey, $this->session);
        $GLOBALS['TSFE']->fe_user->storeSessionData();
    }

    /**
     * include CSS and JS resources
     */
    private function includeAdditionalHeaderData()
    {
        $additHDD = '';

        if (isset($this->settings['jQueryUICSS'])) {
            $additHDD .=
            '<link rel="stylesheet" href="' . PathUtility::getAbsoluteWebPath($this->settings['jQueryUICSS']) . '" media="all" />' . "\n";
        }

        if (isset($this->settings['CSSFile'])) {
            $additHDD .=
            '<link rel="stylesheet" href="' . PathUtility::getAbsoluteWebPath($this->settings['CSSFile']) . '" media="all" />' . "\n";
        }

        if (isset($this->settings['jQuery'])) {
            $additHDD .= '<script type="text/javascript" src="' . PathUtility::getAbsoluteWebPath($this->settings['jQuery']) . '"></script>' . "\n";
        }

        if (isset($this->settings['jQueryUI'])) {
            $additHDD .= '<script type="text/javascript" src="' . PathUtility::getAbsoluteWebPath($this->settings['jQueryUI']) . '"></script>' . "\n";
        }

        $GLOBALS['TSFE']->additionalHeaderData['tx_evangtermine'] = $additHDD;
    }

    /**
     * create new Etkeys object and load Settings
     * @return EtKeys $etkeys
     */
    private function getNewFromSettings()
    {
        $etkeys = GeneralUtility::makeInstance(EtKeys::class);

        $etkeys->setResetValues();

        $this->settingsUtility->fetchParamsFromSettings($this->settings, $etkeys);

        return $etkeys;
    }

    /**
     * action list
     * - must collect all parameters (etKeys) from config-settings, session and request
     * - update session
     * - retrieve XML data
     * - hand it to view
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        if (!isset($this->session['etkeysJson'])) {
            // no session data exists. set up fresh container object for params and load settings
            $this->etkeys = $this->getNewFromSettings();
        }

        // collect params from request
        $this->settingsUtility->fetchParamsFromRequest($this->request->getArguments(), $this->etkeys);

        // check if params are coming in from (search-) form
        $requestArguments = $this->request->getArguments();
        if (isset($requestArguments['etkeysForm']) && $requestArguments['etkeysForm']['pluginUid'] == $this->currentPluginUid) {
            // did user trigger form parameter reset?
            if (isset($requestArguments['sf_reset'])) {
                $this->etkeys = $this->getNewFromSettings(); // do reset
            } else {
                $this->settingsUtility->fetchParamsFromRequest($requestArguments['etkeysForm'], $this->etkeys);
            }
        }

        // retrieve XML
        $evntContainer = $this->eventcontainerRepository->findByEtKeys($this->etkeys);

        // fine tune and save parameters to session
        if ($this->etkeys->getQ() == 'none') {
            $this->etkeys->setQ('');
        }
        $this->saveSession();

        // Set up pager widget (no Widgets in Fluid ViewHelpers since TYPO3 v11!)
        $this->pager->up(
            $evntContainer->getMetaData()->totalItems,
            $this->etkeys->getItemsPerPage(),
            $this->etkeys->getPageID()
        );

        // hand model data to the view
        $this->view->assignMultiple([
            'events' => $evntContainer,
            'etkeys' => $this->etkeys,
            'pageId' => $GLOBALS['TSFE']->id,
            'pluginUid' => $this->currentPluginUid,
            'categoryList' => $this->categorylist->getItemslist(),
            'groupList' => $this->grouplist->getItemslist(),
            'pagerdata' => $this->pager->getPgr(),
        ]);

        // Debugging only
        // $this->view->assign('request', $this->request->getArguments());
	    return $this->htmlResponse();
    }

    /**
     * action teaser
     */
    public function teaserAction(): \Psr\Http\Message\ResponseInterface
    {
        // teaser needs no session, just params from the settings array
        $etkeysTs = $this->getNewFromSettings();

        // retrieve XML
        $evntContainer = $this->eventcontainerRepository->findByEtKeys($etkeysTs);

        // hand model data to the view
        $this->view->assign('events', $evntContainer);
        $this->view->assign('pageId', $GLOBALS['TSFE']->id);
		
		return $this->htmlResponse();
    }

    /**
     * action show
     */
    public function showAction(): \Psr\Http\Message\ResponseInterface
    {
        $etkeys = GeneralUtility::makeInstance(EtKeys::class);

        $extconf = GeneralUtility::makeInstance(ExtConf::class);

        if (isset($this->request->getArguments()['ID'])) {
            $etkeys->setID($this->request->getArguments()['ID']);

            // retrieve XML
            $evntContainer = $this->eventcontainerRepository->findByEtKeys($etkeys);

            // hand model data to the view
            $this->view->assign('event', $evntContainer->getItems()[0]);
            $this->view->assign('meta', $evntContainer->getMetaData());
            $this->view->assign('detailitems', $evntContainer->getDetail());
            $this->view->assign('eventhost', $extconf->getExtConfArray()['host']);
        } else {
            $this->addFlashMessage('Keine Event-ID übergeben', '', AbstractMessage::ERROR);
            $this->redirect('genericinfo');
        }
		
		return $this->htmlResponse();
    }

    /**
     * action genericinfo
     */
    public function genericinfoAction()
    {
    }
}
