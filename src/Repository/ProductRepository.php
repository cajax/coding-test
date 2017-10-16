<?php
declare(strict_types=1);

namespace Teamleader\Repository;

use stdClass;
use Teamleader\Document\Product;

/**
 * Product repository.
 * For simplicity of demo code this class does not convert parsed data but instead annotates it as Product for code completion
 */
class ProductRepository extends AbstractRepository
{

    protected $dataFile = __DIR__ . '/../../data/products.json';
    /**
     * @var Product[]
     */
    protected $data;

    /**
     * Get product by ID
     * @param $id
     * @return Product|null
     */
    public function getProduct($id):?StdClass
    {
        return $this->data[$id] ?? null;
    }
}