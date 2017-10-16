<?php
declare(strict_types=1);

namespace Teamleader\Repository;

/**
 * Simple abstract wrapper for json files
 */
class AbstractRepository
{
    /**
     * @var string path to JSON file
     */
    protected $dataFile;

    /**
     * @var array Parsed data
     */
    protected $data;

    public function __construct()
    {
        foreach (json_decode(file_get_contents($this->dataFile)) as $item) {
            $this->data[$item->id] = $item;
        }

    }


}