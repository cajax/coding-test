<?php
declare(strict_types=1);

namespace Teamleader\Document;

/**
 * Order Item definition
 */
class OrderItem
{
    /**
     * @var string
     */
    public $product_id;

    /**
     * @var string
     */
    public $quantity;

    /**
     * @var string
     */
    public $unitprice;

    /**
     * @var string
     */
    public $total;

}