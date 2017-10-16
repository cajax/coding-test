<?php
declare(strict_types=1);

namespace Teamleader\Service\DiscountCalculator;


use Teamleader\Document\Discount;
use Teamleader\Document\Order;
use Teamleader\Repository\ProductRepository;

class CheapestToolCalculator implements CalculatorInterface
{

    /**
     * Get 20% off for cheapest of different tools
     * @param Order $order
     * @return Discount|null
     */
    public function getDiscount($order):?Discount
    {
        $productRepository = new ProductRepository();


        $prices = [];

        foreach ($order->items as $item) {
            $product = $productRepository->getProduct($item->{'product-id'});
            if (null === $product || '1' !== $product->category) {
                continue;
            }

            $prices[(int)$product->price * 100] = $item->total;


        }

        if (count($prices) < 2) {
            return null;
        }

        ksort($prices);
        $discount = bcmul(reset($prices), '0.2', 2);
        return new Discount($discount, 'cheapest_tool_20_pct_off', $this->getPriority());

    }

    /**
     * @return int Priority of calculator
     */
    public function getPriority(): int
    {
        return 3;
    }
}