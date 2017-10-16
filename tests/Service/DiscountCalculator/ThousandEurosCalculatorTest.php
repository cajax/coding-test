<?php
declare(strict_types=1);

namespace Service\DiscountCalculator;

use PHPUnit\Framework\TestCase;
use Teamleader\Document\Order;
use Teamleader\Service\DiscountCalculator\ThousandEurosCalculator;

/**
 * @coversDefaultClass \Teamleader\Service\DiscountCalculator\ThousandEurosCalculator
 */
class ThousandEurosCalculatorTest extends TestCase
{
    /**
     * @covers ::getDiscount
     */
    public function testGetDiscount()
    {
        $calculator = new ThousandEurosCalculator();

        $order = new Order();
        $order->total = '100';
        $noDiscount = $calculator->getDiscount($order);
        $this->assertNull($noDiscount);

        $order = new Order();
        $order->total = '1000.99';
        $discount = $calculator->getDiscount($order);
        $this->assertEquals('100.09', $discount->discount);
        $this->assertEquals('total_above_1000_euros', $discount->reason);
        $this->assertEquals(1, $discount->priority);
    }

    /**
     * @covers ::getPriority
     */
    public function testGetPriority()
    {
        $calculator = new ThousandEurosCalculator();

        $this->assertEquals(1, $calculator->getPriority());
    }
}
