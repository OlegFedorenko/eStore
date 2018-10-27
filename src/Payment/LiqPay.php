<?php
/**
 * EXAMPLE
 */
namespace App\Payment;

use App\Entity\Order;

class LiqPay implements GateAwayInterface
{

    public function getButton(): string
    {
        // TODO: Implement getButton() method.
    }

    public function checkPayment(Order $order): int
    {
        // TODO: Implement checkPayment() method.
    }
}