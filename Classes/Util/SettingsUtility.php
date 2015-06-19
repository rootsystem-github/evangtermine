<?php
namespace ArbkomEKvW\Evangtermine\Util;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Christoph Roth <christoph.roth@lka.ekvw.de>, Evangelische Kirche von Westfalen
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
 * Settings utility
 */
 class SettingsUtility {
 	
 	/**
 	 * fetch etkey params from TypoScript/Flexform config
 	 * @param array $settingsArray
 	 * @param \ArbkomEKvW\Evangtermine\Domain\Model\EtKeys $etks
 	 */
 	public function fetchParamsFromConfig(array $settingsArray, \ArbkomEKvW\Evangtermine\Domain\Model\EtKeys $etks) {
 	
 		foreach ($settingsArray as $key => $value) {
 			if (substr($key, 0, 6) == 'etkey_') {
 				$etks->setSingleKey(substr($key, 6), $value);
 			}
 		}
 		
 		// evaluate additional params field in flexform
 		if (isset($settingsArray['evt_addprms']) && $settingsArray['evt_addprms'] != '') {
 			$addprms = explode(',', $settingsArray['evt_addprms']);
 			foreach ($addprms as $keyval) {
 				list($key, $value) = explode('=', trim($keyval));
 				$etks->setSingleKey(trim($key), trim($value));
 			}
 		}
 	}
 	
 	/**
 	 * fetch etkey params from Request
 	 * @param unknown $requestParams
 	 * @param \ArbkomEKvW\Evangtermine\Domain\Model\EtKeys $etks
 	 */
 	public function fetchParamsFromRequest($requestParams, \ArbkomEKvW\Evangtermine\Domain\Model\EtKeys $etks) {
 		
 		foreach ($requestParams as $key => $value) {
 			$etks->setSingleKey($key, $value);
 		}
 	}
 	
 }