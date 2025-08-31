<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Availability implements Arrayable
{
    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
    }

    /**
     * @var string|null
     */
    private $storeName;

    /**
     * @var int|null
     */
    private $itemId;

    /**
     * @var string|null
     */
    private $quantity;

    /**
     * @var string|null
     */
    private $itemName;

    /**
     * @var string|null
     */
    private $quantityOnStock;

    /**
     * @var string|null
     */
    private $sku;

    /**
     * @var int|null
     */
    private $storeId;

    /**
     * @var string|null
     */
    private $quantityBlocked;

    /**
     * @return string|null
     */
    public function getStoreName(): ?string
    {
        return $this->storeName;
    }

    /**
     * @param string|null $storeName
     * @return Availability
     */
    public function setStoreName(?string $storeName): Availability
    {
        $this->storeName = $storeName;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @param int|string|null $itemId
     * @return Availability
     */
    public function setItemId($itemId): Availability
    {
        $this->itemId = $itemId ? (int)$itemId : null;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    /**
     * @param string|null $quantity
     * @return Availability
     */
    public function setQuantity(?string $quantity): Availability
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    /**
     * @param string|null $itemName
     * @return Availability
     */
    public function setItemName(?string $itemName): Availability
    {
        $this->itemName = $itemName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuantityOnStock(): ?string
    {
        return $this->quantityOnStock;
    }

    /**
     * @param string|null $quantityOnStock
     * @return Availability
     */
    public function setQuantityOnStock(?string $quantityOnStock): Availability
    {
        $this->quantityOnStock = $quantityOnStock;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|int|null $sku
     * @return Availability
     */
    public function setSku($sku): Availability
    {
        $this->sku = (string)$sku;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int|string|null $storeId
     * @return Availability
     */
    public function setStoreId($storeId): Availability
    {
        $this->storeId = $storeId ? (int)$storeId : null;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuantityBlocked(): ?string
    {
        return $this->quantityBlocked;
    }

    /**
     * @param string|null $quantityBlocked
     * @return Availability
     */
    public function setQuantityBlocked(?string $quantityBlocked): Availability
    {
        $this->quantityBlocked = $quantityBlocked;
        return $this;
    }

    /**
     * Get the total available quantity (quantity_on_stock - quantity_blocked)
     * 
     * @return float
     */
    public function getAvailableQuantity(): float
    {
        $onStock = (float)($this->quantityOnStock ?? 0);
        $blocked = (float)($this->quantityBlocked ?? 0);
        return max(0, $onStock - $blocked);
    }
}
