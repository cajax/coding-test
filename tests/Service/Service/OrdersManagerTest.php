<?php
declare(strict_types=1);

namespace Service;

use Teamleader\Service\DiscountCalculator\CalculatorInterface;
use Teamleader\Service\OrdersManager;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Teamleader\Service\OrdersManager
 */
class OrdersManagerTest extends TestCase
{
    /**
     * @covers ::getCalcuators
     */
    public function testGetCalculators()
    {
        $ordersManager = new OrdersManager();
        $calculators = $ordersManager->getCalcuators();

        foreach ($calculators as $calculator){
            $this->assertInstanceOf(CalculatorInterface::class,$calculator);
        }
    }
}
