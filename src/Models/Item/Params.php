<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Item;

use Stellion\Primbg\Interfaces\Arrayable;

class Params implements Arrayable
{

    private array $params;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addParam(string $key, string $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter($this->params);
    }
}
