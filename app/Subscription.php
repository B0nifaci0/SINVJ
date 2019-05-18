<?php

namespace App;

class Subscription {

	public $description = "Suscripcion premium";
	public $price = 100;
	public $months;
	public $discount;
	public $subtotal;
	public $total;

	public function __construct($months = 1, $discount = 0){

		$this->months = $months;
		$this->discount = $discount;

		$this->subtotal = ($this->price * $this->months);
		$this->total = $this->subtotal - ($this->subtotal * $this->discount);
	}

	public function makePayPalItem()
	{
		return \PaypalPayment::item()->setName("Suscripcion premium")
								->setDescription("Pago de suscripcion premium por {$this->months} meses")
								->setCurrency("MXN")
								->setQuantity(1)
								->setPrice($this->total);
	}

}
