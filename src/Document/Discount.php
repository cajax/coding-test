<?php
declare(strict_types=1);

namespace Teamleader\Document;

/**
 * Discount definition
 */
class Discount
{
    /**
     * @var string
     */
    public $discount;

    /**
     * @var string
     */
    public $reason;
    /**
     * @var int
     */
    public $priority;

    /**
     * Discount constructor.
     * @param string $discount
     * @param string $reason
     * @param int $priority
     */
    public function __construct(string $discount, string $reason, int $priority)
    {
        $this->discount = $discount;
        $this->reason = $reason;

        $this->priority = $priority;
    }


}