<?php
declare(strict_types=1);

namespace Teamleader\Service\DiscountCalculator;


use Teamleader\Document\Discount;

class ThousandEurosCalculator implements CalculatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDiscount($order):?Discount
    {
        if (bccomp($order->total, '1000', 2) > 0) {
            return new Discount(bcmul($order->total, '0.1', 2), 'total_above_1000_euros', $this->getPriority());
        }

        return null;
    }

    public function getPriority(): int
    {
        return 1;
    }


}