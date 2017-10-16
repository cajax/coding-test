<?php
declare(strict_types=1);

namespace Teamleader\Service\DiscountCalculator;


use Teamleader\Document\Discount;
use Teamleader\Document\Order;
use Teamleader\Repository\ProductRepository;

class FiveSwitchesCalculator implements CalculatorInterface
{

    /**
     * Make every 6th switch free (grouped by product)
     * @param Order $order
     * @return Discount|null
     */
    public function getDiscount($order):?Discount
    {
        $productRepository = new ProductRepository();

        $discount = '0.00';

        foreach ($order->items as $item) {
            $product = $productRepository->getProduct($item->{'product-id'});
            if (null === $product || '2' !== $product->category) {
                continue;
            }

            $freeItems = (int)($item->quantity / 6);
            $discount = bcadd($discount, bcmul((string)$freeItems, $product->price, 2), 2);
        }

        if ('0.00' !== $discount) {
            return new Discount($discount, 'every_6th_switch_for_free', $this->getPriority());
        }

        return null;
    }

    /**
     * @return int Priority of calculator
     */
    public function getPriority(): int
    {
        return 2;
    }
}