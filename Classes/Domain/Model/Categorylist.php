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

namespace ArbkomEKvW\Evangtermine\Domain\Model;

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

use ArbkomEKvW\Evangtermine\Util\CategoryUtil;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Categorylist
 */
class Categorylist extends AbstractEntity
{
    protected $itemList;

    public function __construct($typeMethod = 'getCategories', $sessionKey = 'tx_evangtermine_categorylist')
    {
        // if itemList is empty, load from session
        if (! $this->itemList) {
            $this->itemList = $GLOBALS['TSFE']->fe_user->getKey('ses', $sessionKey);

            // if necessary, initialize it
            if (! $this->itemList) {
                $this->itemList = [];
                $categoryUtil = GeneralUtility::makeInstance(CategoryUtil::class);
                $categoryUtil->$typeMethod($this->itemList);

                $newlist = [];
                foreach ($this->itemList['items'] as $item) {
                    $newlist[(string)($item[1])] = $item[0];
                }
                $this->itemList['items'] = $newlist;

                $GLOBALS['TSFE']->fe_user->setKey('ses', $sessionKey, $this->itemList);

                $GLOBALS['TSFE']->fe_user->storeSessionData();
            }
        }
    }

    public function getItemslist()
    {
        return $this->itemList['items'];
    }
}
