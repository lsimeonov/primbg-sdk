<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Order;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Row implements Arrayable
{
    use ArrayableTrait,
        FromArrayTrait;

    /**
     * @var string|null
     */
    private $sku;
    /**
     * @var float|null
     */
    private $quantity;

    /**
     * @var string|null
     */
    private $measureCode;

    /**
     * @var string|null
     */
    private $bomIdent;

    /**
     * @var string|null
     */
    private $bomPosition;

    /**
     * @var string|null
     */
    private $bomIter;

    /**
     * @var float|null
     */
    private $price;

    /**
     * @var int|null
     */
    private $discount;
    /**
     * @var string|null
     */
    private $description;

    /**
     * Row constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
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
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    /**
     * @param float|null $quantity
     */
    public function setQuantity(?float $quantity): void
    {
        $this->quantity = $quantity;
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

    /**
     * @return string|null
     */
    public function getBomIdent(): ?string
    {
        return $this->bomIdent;
    }

    /**
     * @param string|null $bomIdent
     */
    public function setBomIdent(?string $bomIdent): void
    {
        $this->bomIdent = $bomIdent;
    }

    /**
     * @return string|null
     */
    public function getBomPosition(): ?string
    {
        return $this->bomPosition;
    }

    /**
     * @param string|null $bomPosition
     */
    public function setBomPosition(?string $bomPosition): void
    {
        $this->bomPosition = $bomPosition;
    }

    /**
     * @return string|null
     */
    public function getBomIter(): ?string
    {
        return $this->bomIter;
    }

    /**
     * @param string|null $bomIter
     */
    public function setBomIter(?string $bomIter): void
    {
        $this->bomIter = $bomIter;
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
     * @return int|null
     */
    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    /**
     * @param int|null $discount
     */
    public function setDiscount(?int $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
