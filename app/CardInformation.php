<?php

namespace App;

/**
* by Jorge Carmine
*/
class CardInformation
{

	public $type;
	public $number;
	public $expire_month;
	public $expire_year;
	public $cvv;
	public $first_name;
	public $last_name;
	
	function __construct($type, $number, $expire_month, $expire_year, $cvv, $first_name, $last_name)
	{
		$this->type = $type;
		$this->number = $number;
		$this->expire_month = $expire_month;
		$this->expire_year = $expire_year;
		$this->cvv = $cvv;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
	}
}
