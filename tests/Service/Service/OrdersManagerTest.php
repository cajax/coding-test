<?php
declare(strict_types=1);

namespace Service;

use PHPUnit\Framework\TestCase;
use Teamleader\Service\DiscountCalculator\CalculatorInterface;
use Teamleader\Service\OrdersManager;

/**
 * @coversDefaultClass \Teamleader\Service\OrdersManager
 */
class OrdersManagerTest extends TestCase
{
    /**
     * @covers ::getCalculators
     */
    public function testGetCalculators()
    {
        $ordersManager = new OrdersManager();
        $calculators = $ordersManager->getCalcuators();

        foreach ($calculators as $calculator) {
            $this->assertInstanceOf(CalculatorInterface::class, $calculator);
        }
    }
}
