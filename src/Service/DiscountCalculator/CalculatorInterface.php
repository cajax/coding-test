<?php
declare(strict_types=1);

namespace Teamleader\Service\DiscountCalculator;


use Teamleader\Document\Discount;
use Teamleader\Document\Order;

interface CalculatorInterface
{
    /**
     * @param Order $order
     * @return
     */
    public function getDiscount($order):?Discount;

    /**
     * @return int Priority of calculator
     */
    public function getPriority(): int;

}