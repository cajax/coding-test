<?php
declare(strict_types=1);

namespace Teamleader\Repository;

use stdClass;
use Teamleader\Document\Customer;

/**
 * Customer repository.
 * For simplicity of demo code this class does not convert parsed data but instead annotates it as Customer for code completion
 */
class CustomerRepository extends AbstractRepository
{
    protected $dataFile = __DIR__.'/../../data/customers.json';
    /**
     * @var Customer[]
     */
    protected $data;

    /**
     * Get customer by ID
     * @param $id
     * @return Customer|null
     */
    public function getCustomer($id):?StdClass
    {
        return $this->data[$id] ?? null;
    }
}