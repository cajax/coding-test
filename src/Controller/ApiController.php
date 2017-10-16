<?php
declare(strict_types=1);

namespace Teamleader\Controller;

use Teamleader\Document\Discount;
use Teamleader\Document\Order;
use Teamleader\Service\OrdersManager;

/**
 * Main demo controller
 */
class ApiController
{
    /**
     * Calculate discount for given order
     * @param string $requestBody
     * @return null|Discount
     */
    public function indexAction($requestBody)
    {
        /** @var Order $order */
        $order = json_decode($requestBody);
        if (!$order) {
            return null;
        }

        $ordersManager = new OrdersManager();
        return $ordersManager->getDiscount($order);
    }
}