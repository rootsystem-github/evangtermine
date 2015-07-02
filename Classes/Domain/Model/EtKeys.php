<?php
namespace ArbkomEKvW\Evangtermine\Domain\Model;

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
 * EtKeys: Collection of key-value-pairs for requesting events
 */
class EtKeys extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {
	
	
	/**
	 * veranstalter id
	 * @var string
	 */
	protected $vid = 'all';
	
	/**
	 * region
	 * @var string
	 */
	protected $region = 'all';
	
	/**
	 * kk
	 * @var string
	 */
	protected $kk = null;
	
	/**
	 *eventtype
	 * @var string
	 */
	protected $eventtype = 'all';
	
	/**
	 * highlight
	 * @var string
	 */
	protected $highlight = 'all';
	
	/**
	 * people
	 * @var string
	 */
	protected $people = '0';
	
	/**
	 * person
	 * @var string
	 */
	protected $person = null;
	
	/**
	 * place
	 * @var string
	 */
	protected $place = null;
	
	/**
	 * inputmask
	 * @var string
	 */
	protected $ipm = null;
	
	/**
	 * channel
	 * @var string
	 */
	protected $cha = null;
	
	/**
	 * itemsPerPage
	 * @var string
	 */
	protected $itemsPerPage = null;
	
	/**
	 * pageID
	 * @var string
	 */
	protected $pageID = '1';
	
	/**
	 * searchword
	 * @var string
	 */
	protected $q = 'none';
	
	/**
	 * day
	 * @var string
	 */
	protected $d = null;
	
	/**
	 * month
	 * @var string
	 */
	protected $month = null;
	
	/**
	 * date
	 * @var string
	 */
	protected $date = '';
	
	/**
	 * year
	 * @var string
	 */
	protected $year = null;
	
	/**
	 * start
	 * @var string
	 */
	protected $start = null;
	
	/**
	 * end
	 * @var string
	 */
	protected $end = null;
	
	/**
	 * dest
	 * @var string
	 */
	protected $dest = null;
	
	/**
	 * own
	 * @var string
	 */
	protected $own = 'all';
	
	/**
	 * menue1
	 * @var string
	 */
	protected $menue1 = null;
	
	/**
	 * menue2
	 * @var string
	 */
	protected $menue2 = null;
	
	/**
	 * zip
	 * @var string
	 */
	protected $zip = null;
	
	/**
	 * yesno1
	 * @var string
	 */
	protected $yesno1 = null;
	
	/**
	 * yesno2
	 * @var string
	 */
	protected $yesno2 = null;
	
	/**
	 * until
	 * @var string
	 */
	protected $until = null;
	
	/**
	 * encoding
	 * @var string
	 */
	protected $encoding = null;
	
	
	/**
	 * (non-PHPdoc)
	 * @see \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject::getValue()
	 */
	public function getValue() {
		
	}
	
	public function getVid() {
		return $this->vid;
	}
	
	public function setVid($vid) {
		$this->vid = $vid;
	}
	
	public function getRegion() {
		return $this->region;
	}
	
	public function setRegion($region) {
		$this->region = $region;
	}
	
	public function getKk() {
		return $this->kk;
	}
	
	public function setKk($kk) {
		$this->kk = $kk;
	}
	
	public function getEventtype() {
		return $this->eventtype;
	}
	
	public function setEventtype($eventtype) {
		$this->eventtype = $eventtype;
	}
	
	public function getHighlight() {
		return $this->highlight;
	}
	
	public function setHighlight($highlight) {
		$this->highlight = $highlight;
	}
	
	public function getPeople() {
		return $this->people;
	}
	
	public function setPeople($people) {
		$this->people = $people;
	}
	
	public function getPerson() {
		return $this->person;
	}
	
	public function setPerson($person) {
		$this->person = $person;
	}
	
	public function getPlace() {
		return $this->place;
	}
	
	public function setPlace($place) {
		$this->place = $place;
	}
	
	public function getIpm() {
		return $this->ipm;
	}
	
	public function setIpm($ipm) {
		$this->ipm = $ipm;
	}
	
	public function getCha() {
		return $this->cha;
	}
	
	public function setCha($cha) {
		$this->cha = $cha;
	}
	
	public function getItemsPerPage() {
		return $this->itemsPerPage;
	}
	
	public function setItemsPerPage($itemsPerPage) {
		$this->itemsPerPage = $itemsPerPage;
	}
	
	public function getPageID() {
		return $this->pageID;
	}
	
	public function setPageID($pageID) {
		$this->pageID = $pageID;
	}
	
	public function getQ() {
		return $this->q;
	}
	
	public function setQ($q) {
		$this->q = $q;
	}
	
	public function getD() {
		return $this->d;
	}
	
	public function setD($d) {
		$this->d = $d;
	}
	
	public function getMonth() {
		return $this->month;
	}
	
	public function setMonth($month) {
		$this->month = $month;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
	
	public function getYear() {
		return $this->year;
	}
	
	public function setYear($year) {
		$this->year = $year;
	}
	
	public function getStart() {
		return $this->start;
	}
	
	public function setStart($start) {
		$this->start = $start;
	}
	
	public function getEnd() {
		return $this->end;
	}
	
	public function setEnd($end) {
		$this->end = $end;
	}
	
	public function getDest() {
		return $this->dest;
	}
	
	public function setDest($dest) {
		$this->dest = $dest;
	}
	
	public function getOwn() {
		return $this->own;
	}
	
	public function setOwn($own) {
		$this->own = $own;
	}
	
	public function getMenue1() {
		return $this->menue1;
	}
	
	public function setMenue1($menue1) {
		$this->menue1 = $menue1;
	}
	
	public function getMenue2() {
		return $this->menue2;
	}
	
	public function setMenue2($menue2) {
		$this->menue2 = $menue2;
	}
	
	public function getZip() {
		return $this->zip;
	}
	
	public function setZip($zip) {
		$this->zip = $zip;
	}
	
	public function getYesno1() {
		return $this->yesno1;
	}
	
	public function setYesno1($yesno1) {
		$this->yesno1 = $yesno1;
	}
	
	public function getYesno2() {
		return $this->yesno2;
	}
	
	public function setYesno2($yesno2) {
		$this->yesno2 = $yesno2;
	}
	
	public function getUntil() {
		return $this->until;
	}
	
	public function setUntil($until) {
		$this->until = $until;
	}
	
	public function getEncoding() {
		return $this->encoding;
	}
	
	public function setEncoding($encoding) {
		$this->encoding = $encoding;
	}
	
}