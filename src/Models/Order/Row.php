<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Order;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;


class Row implements Arrayable
{
    use ArrayableTrait;
    use FromArrayTrait;

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
    private $totalPrice;
    /**
     * @var float|null
     */
    private $totalPriceWithTaxes;
    /**
     * @var float|null
     */
    private $singlePriceBeforeDiscounts;
    /**
     * @var float|null
     */
    private $taxes;
    /**
     * @var float|null
     */
    private $discount;
    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $categoryName;
    /**
     * @var string[]
     */
    protected array $castMap = [
        'sku' => 'string',
        'taxes' => 'float',
        'total_price' => 'float',
        'total_price_with_taxes' => 'float',
        'single_price_before_discounts' => 'float',
        'discount' => 'float',
        'quantity' => 'float'
    ];

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
    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    /**
     * @param float|null $totalPrice
     */
    public function setTotalPrice(?float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @return float|null
     */
    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    /**
     * @param float|null $discount
     */
    public function setDiscount(?float $discount): void
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

    /**
     * @return float|null
     */
    public function getTaxes(): ?float
    {
        return $this->taxes;
    }

    /**
     * @param float|null $taxes
     */
    public function setTaxes(?float $taxes): void
    {
        $this->taxes = $taxes;
    }

    /**
     * @return float|null
     */
    public function getTotalPriceWithTaxes(): ?float
    {
        return $this->totalPriceWithTaxes;
    }

    /**
     * @param float|null $totalPriceWithTaxes
     */
    public function setTotalPriceWithTaxes(?float $totalPriceWithTaxes): void
    {
        $this->totalPriceWithTaxes = $totalPriceWithTaxes;
    }

    /**
     * @return float|null
     */
    public function getSinglePriceBeforeDiscounts(): ?float
    {
        return $this->singlePriceBeforeDiscounts;
    }

    /**
     * @param float|null $singlePriceBeforeDiscounts
     */
    public function setSinglePriceBeforeDiscounts(?float $singlePriceBeforeDiscounts): void
    {
        $this->singlePriceBeforeDiscounts = $singlePriceBeforeDiscounts;
    }

    /**
     * @return string|null
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    /**
     * @param string|null $categoryName
     */
    public function setCategoryName(?string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

}
