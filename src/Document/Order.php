<?php
declare(strict_types=1);

namespace Teamleader\Document;

/**
 * Order definition
 */
class Order
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $customer_id;

    /**
     * @var OrderItem[]
     */
    public $items;

    /**
     * @var string
     */
    public $total;
}