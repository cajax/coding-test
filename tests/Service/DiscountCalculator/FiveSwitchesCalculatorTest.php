<?php
declare(strict_types=1);

namespace Service\DiscountCalculator;

use PHPUnit\Framework\TestCase;
use Teamleader\Service\DiscountCalculator\FiveSwitchesCalculator;

/**
 * @coversDefaultClass \Teamleader\Service\DiscountCalculator\FiveSwitchesCalculator
 */
class FiveSwitchesCalculatorTest extends TestCase
{
    /**
     * @covers ::getDiscount
     */
    public function testGetDiscount()
    {
        $calculator = new FiveSwitchesCalculator();

        $order = json_decode('{
          "id": "2",
          "customer-id": "2",
          "items": [
            {
              "product-id": "B102",
              "quantity": "5",
              "unit-price": "4.99",
              "total": "24.95"
            }
          ],
          "total": "24.95"
        }');
        $noDiscount = $calculator->getDiscount($order);
        $this->assertNull($noDiscount);


        $order = json_decode('{
          "id": "2",
          "customer-id": "2",
          "items": [
            {
              "product-id": "B102",
              "quantity": "13",
              "unit-price": "4.99",
              "total": "24.95"
            }
          ],
          "total": "24.95"
        }');

        $discount = $calculator->getDiscount($order);
        $this->assertEquals('9.98', $discount->discount);
        $this->assertEquals('every_6th_switch_for_free', $discount->reason);
        $this->assertEquals(2, $discount->priority);
    }

    /**
     * @covers ::getPriority
     */
    public function testGetPriority()
    {
        $calculator = new FiveSwitchesCalculator();

        $this->assertEquals(2, $calculator->getPriority());
    }
}
