<?php
declare(strict_types=1);

namespace Service\DiscountCalculator;

use PHPUnit\Framework\TestCase;
use Teamleader\Service\DiscountCalculator\CheapestToolCalculator;

/**
 * @coversDefaultClass \Teamleader\Service\DiscountCalculator\CheapestToolCalculator
 */
class CheapestToolCalculatorTest extends TestCase
{
    /**
     * @covers ::getDiscount
     */
    public function testGetDiscount()
    {
        $calculator = new CheapestToolCalculator();

        $order = json_decode('{
          "id": "3",
          "customer-id": "3",
          "items": [
            {
              "product-id": "A101",
              "quantity": "1",
              "unit-price": "9.75",
              "total": "19.50"
            }
          ],
          "total": "69.00"
        }');
        $noDiscount = $calculator->getDiscount($order);
        $this->assertNull($noDiscount);


        $order = json_decode('{
          "id": "3",
          "customer-id": "3",
          "items": [
            {
              "product-id": "A101",
              "quantity": "2",
              "unit-price": "9.75",
              "total": "19.50"
            },
            {
              "product-id": "A102",
              "quantity": "1",
              "unit-price": "49.50",
              "total": "49.50"
            }
          ],
          "total": "69.00"
        }');

        $discount = $calculator->getDiscount($order);
        $this->assertEquals('3.90', $discount->discount);
        $this->assertEquals('cheapest_tool_20_pct_off', $discount->reason);
        $this->assertEquals(3, $discount->priority);
    }

    /**
     * @covers ::getPriority
     */
    public function testGetPriority()
    {
        $calculator = new CheapestToolCalculator();

        $this->assertEquals(3, $calculator->getPriority());
    }
}
