<?php
declare(strict_types=1);

namespace Teamleader\Service;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Symfony\Component\Finder\SplFileInfo;
use Teamleader\Document\Discount;
use Teamleader\Document\Order;
use Teamleader\Service\DiscountCalculator\CalculatorInterface;

class OrdersManager
{
    /**
     * @var CalculatorInterface[]
     */
    private $discountCalculators;

    /**
     * Apply first matching discount
     * @param Order $order
     * @return null|Discount
     */
    public function getDiscount($order):?Discount
    {
        foreach ($this->getCalcuators() as $calcuator) {
            $discount = $calcuator->getDiscount($order);

            if ($discount) {
                return $discount;
            }
        }

        return null;
    }

    /**
     * Get sorted list of discount calculators
     * @return CalculatorInterface[]
     */
    public function getCalcuators(): array
    {
        if ($this->discountCalculators) {
            return $this->discountCalculators;
        }

        $this->discountCalculators = [];

        $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/DiscountCalculator/'));
        $phpFiles = new RegexIterator($allFiles, '/Calculator\.php$/');
        /** @var SplFileInfo $phpFile */
        foreach ($phpFiles as $phpFile) {
            $className = 'Teamleader\Service\DiscountCalculator\\' . $phpFile->getBasename('.php');
            /** @var CalculatorInterface $calculator */
            $calculator = new $className;
            $this->discountCalculators[$calculator->getPriority()] = $calculator;
        }

        ksort($this->discountCalculators);
        return $this->discountCalculators;
    }
}