<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Price implements Arrayable
{

    use ArrayableTrait,
        FromArrayTrait;

    /**
     * @var float|null
     */
    private $price;

    /**
     * @var string|null
     */
    private $pricelistCode;

    /**
     * @var string|null
     */
    private $sku;

    /**
     * @var string|null
     */
    private $measureCode;

    /**
     * @var string[]
     */
    private $castMap = [
        'price' => 'float'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getPricelistCode(): ?string
    {
        return $this->pricelistCode;
    }

    /**
     * @param string|null $pricelistCode
     */
    public function setPricelistCode(?string $pricelistCode): void
    {
        $this->pricelistCode = $pricelistCode;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     */
    public function setSku(?string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return string|null
     */
    public function getMeasureCode(): ?string
    {
        return $this->measureCode;
    }

    /**
     * @param string|null $measureCode
     */
    public function setMeasureCode(?string $measureCode): void
    {
        $this->measureCode = $measureCode;
    }
}

