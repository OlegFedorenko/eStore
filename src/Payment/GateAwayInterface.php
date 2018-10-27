<?php

/**
 * EXAMPLE
 */

namespace App\Payment;

use App\Entity\Order;

interface GateAwayInterface
{
    public function getButton(): string;

    public function checkPayment(Order $order): int;
}