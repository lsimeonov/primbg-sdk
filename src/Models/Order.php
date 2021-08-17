<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Order implements Arrayable
{
    use ArrayableTrait,
        FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var \DateTimeInterface|null
     */
    private $forDate;

    /**
     * @var int|string|null
     */
    private $saleType;

    /**
     * @var string|int|null
     */
    private $num;

    /**
     * @var string|null
     */
    private $trader;

    /**
     * @var string|null
     */
    private $posCode;

    /**
     * @var string|null
     */
    private $taxDealCode;

    /**
     * @var string|null
     */
    private $storeCode;

    /**
     * @var string|null
     */
    private $currency;

    /**
     * @todo Type
     * @var string|null
     */
    private $finType;

    /**
     * @TODO
     * @var string|null
     */
    private $payType;
    /**
     * @TODO
     * @var string|null
     */
    private $storeType;

    /**
     * @TODO
     * @var string|null
     */
    private $deliveryCode;

    /**
     * @var string|null
     */
    private $description;
    /**
     * @var string|null
     */
    private $internalDescription;
    /**
     * @var bool|null
     */
    private $payNow;
    /**
     * @var bool|null
     */
    private $invoiceNow;
    /**
     * @var int|null
     */
    private $discount;
    /**
     * @var int|null
     */
    private $promoCard;

    /**
     * @var \Stellion\Primbg\Models\Partner|null
     */
    private $partner;

    /**
     * @var \Stellion\Primbg\Models\Address
     */
    private $deliveryAddress;

    /**
     * @var \Stellion\Primbg\Models\Order\Row[]
     */
    private $rows;

    /**
     * @todo
     */
    private $integrations;

    /**
     * @var string[]
     */
    protected $objectConvertMap = [
        'deliveryAddress' => Address::class
    ];

    /**
     * @var string[]
     */
    protected $castMap = [
        'invoiceNow' => 'bool',
        'buyNow' => 'bool'
    ];

    /**
     * Order constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getForDate(): ?\DateTimeInterface
    {
        return $this->forDate;
    }

    /**
     * @param \DateTimeInterface|null $forDate
     */
    public function setForDate(?\DateTimeInterface $forDate): void
    {
        $this->forDate = $forDate;
    }

    /**
     * @return int|string|null
     */
    public function getSaleType()
    {
        return $this->saleType;
    }

    /**
     * @param int|string|null $saleType
     */
    public function setSaleType($saleType): void
    {
        $this->saleType = $saleType;
    }

    /**
     * @return int|string|null
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param int|string|null $num
     */
    public function setNum($num): void
    {
        $this->num = $num;
    }

    /**
     * @return string|null
     */
    public function getTrader(): ?string
    {
        return $this->trader;
    }

    /**
     * @param string|null $trader
     */
    public function setTrader(?string $trader): void
    {
        $this->trader = $trader;
    }

    /**
     * @return string|null
     */
    public function getPosCode(): ?string
    {
        return $this->posCode;
    }

    /**
     * @param string|null $posCode
     */
    public function setPosCode(?string $posCode): void
    {
        $this->posCode = $posCode;
    }

    /**
     * @return string|null
     */
    public function getTaxDealCode(): ?string
    {
        return $this->taxDealCode;
    }

    /**
     * @param string|null $taxDealCode
     */
    public function setTaxDealCode(?string $taxDealCode): void
    {
        $this->taxDealCode = $taxDealCode;
    }

    /**
     * @return string|null
     */
    public function getStoreCode(): ?string
    {
        return $this->storeCode;
    }

    /**
     * @param string|null $storeCode
     */
    public function setStoreCode(?string $storeCode): void
    {
        $this->storeCode = $storeCode;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string|null
     */
    public function getFinType(): ?string
    {
        return $this->finType;
    }

    /**
     * @param string|null $finType
     */
    public function setFinType(?string $finType): void
    {
        $this->finType = $finType;
    }

    /**
     * @return string|null
     */
    public function getPayType(): ?string
    {
        return $this->payType;
    }

    /**
     * @param string|null $payType
     */
    public function setPayType(?string $payType): void
    {
        $this->payType = $payType;
    }

    /**
     * @return string|null
     */
    public function getStoreType(): ?string
    {
        return $this->storeType;
    }

    /**
     * @param string|null $storeType
     */
    public function setStoreType(?string $storeType): void
    {
        $this->storeType = $storeType;
    }

    /**
     * @return string|null
     */
    public function getDeliveryCode(): ?string
    {
        return $this->deliveryCode;
    }

    /**
     * @param string|null $deliveryCode
     */
    public function setDeliveryCode(?string $deliveryCode): void
    {
        $this->deliveryCode = $deliveryCode;
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
     * @return string|null
     */
    public function getInternalDescription(): ?string
    {
        return $this->internalDescription;
    }

    /**
     * @param string|null $internalDescription
     */
    public function setInternalDescription(?string $internalDescription): void
    {
        $this->internalDescription = $internalDescription;
    }

    /**
     * @return bool|null
     */
    public function getPayNow(): ?bool
    {
        return $this->payNow;
    }

    /**
     * @param bool|null $payNow
     */
    public function setPayNow(?bool $payNow): void
    {
        $this->payNow = $payNow;
    }

    /**
     * @return bool|null
     */
    public function getInvoiceNow(): ?bool
    {
        return $this->invoiceNow;
    }

    /**
     * @param bool|null $invoiceNow
     */
    public function setInvoiceNow(?bool $invoiceNow): void
    {
        $this->invoiceNow = $invoiceNow;
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
     * @return int|null
     */
    public function getPromoCard(): ?int
    {
        return $this->promoCard;
    }

    /**
     * @param int|null $promoCard
     */
    public function setPromoCard(?int $promoCard): void
    {
        $this->promoCard = $promoCard;
    }

    /**
     * @return \Stellion\Primbg\Models\Partner|null
     */
    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    /**
     * @param \Stellion\Primbg\Models\Partner|null $partner
     */
    public function setPartner(?Partner $partner): void
    {
        $this->partner = $partner;
    }

    /**
     * @return \Stellion\Primbg\Models\Address
     */
    public function getDeliveryAddress(): Address
    {
        return $this->deliveryAddress;
    }

    /**
     * @param \Stellion\Primbg\Models\Address $deliveryAddress
     */
    public function setDeliveryAddress(Address $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return \Stellion\Primbg\Models\Order\Row[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param \Stellion\Primbg\Models\Order\Row[] $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return mixed
     */
    public function getIntegrations()
    {
        return $this->integrations;
    }

    /**
     * @param mixed $integrations
     */
    public function setIntegrations($integrations): void
    {
        $this->integrations = $integrations;
    }
}
