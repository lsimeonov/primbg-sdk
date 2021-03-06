<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Order;

use Carbon\Carbon;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Partner;
use Stellion\Primbg\Models\RelationalTransport;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class PurchaseOrder implements Arrayable
{
    use FromArrayTrait;
    use ArrayableTrait;

    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $num;
    /**
     * @var string|null
     */
    private $status;
    /**
     * @var \Stellion\Primbg\Models\RelationalTransport[]|null
     */
    private $relTrans;
    /**
     * @var \DateTimeInterface|null
     */
    private $forDate;
    /**
     * @var string|null
     */
    private $fromNm;
    /**
     * @var string|null
     */
    private $receiverNm;
    /**
     * @var string|null
     */
    private $actionName;
    /**
     * @var string|null
     */
    private $taxDealNm;
    /**
     * @var string|null
     */
    private $toNm;
    /**
     * @var string|null
     */
    private $currency;
    /**
     * @var string|null
     */
    private $senderNm;
    /**
     * @var string|null
     */
    private $traderNm;
    /**
     * @var string|null
     */
    private $payTypeNm;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var string|null
     */
    private $internalDescription;
    /**
     * @var \Stellion\Primbg\Models\Partner|null
     */
    private $partners;//single?
    /**
     * @var \Stellion\Primbg\Models\Order\Row[]
     */
    private $rows;

    /**
     * @var string[]
     */
    protected $objectConvertMap = [
        'rel_trans' => RelationalTransport::class,
        'rows' => Row::class,
        'partners' => Partner::class
    ];

    protected array $castMap = [
        'num' => 'string',
    ];

    /**
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
     * @return string|null
     */
    public function getNum(): ?string
    {
        return $this->num;
    }

    /**
     * @param string|null $num
     */
    public function setNum(?string $num): void
    {
        $this->num = $num;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \Stellion\Primbg\Models\RelationalTransport[]|null
     */
    public function getRelTrans(): ?array
    {
        return $this->relTrans;
    }

    /**
     * @param \Stellion\Primbg\Models\RelationalTransport[]|\Stellion\Primbg\Models\RelationalTransport|null $relTrans
     */
    public function setRelTrans($relTrans): void
    {
        if($relTrans instanceof RelationalTransport){
            $relTrans = [$relTrans];
        }
        $this->relTrans = $relTrans;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getForDate(): ?\DateTimeInterface
    {
        return $this->forDate;
    }

    /**
     * @param string|null $forDate
     */
    public function setForDate(?string $forDate): void
    {
        $this->forDate = Carbon::parse($forDate);
    }

    /**
     * @return string|null
     */
    public function getFromNm(): ?string
    {
        return $this->fromNm;
    }

    /**
     * @param string|null $fromNm
     */
    public function setFromNm(?string $fromNm): void
    {
        $this->fromNm = $fromNm;
    }

    /**
     * @return string|null
     */
    public function getReceiverNm(): ?string
    {
        return $this->receiverNm;
    }

    /**
     * @param string|null $receiverNm
     */
    public function setReceiverNm(?string $receiverNm): void
    {
        $this->receiverNm = $receiverNm;
    }

    /**
     * @return string|null
     */
    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    /**
     * @param string|null $actionName
     */
    public function setActionName(?string $actionName): void
    {
        $this->actionName = $actionName;
    }

    /**
     * @return string|null
     */
    public function getTaxDealNm(): ?string
    {
        return $this->taxDealNm;
    }

    /**
     * @param string|null $taxDealNm
     */
    public function setTaxDealNm(?string $taxDealNm): void
    {
        $this->taxDealNm = $taxDealNm;
    }

    /**
     * @return string|null
     */
    public function getToNm(): ?string
    {
        return $this->toNm;
    }

    /**
     * @param string|null $toNm
     */
    public function setToNm(?string $toNm): void
    {
        $this->toNm = $toNm;
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
    public function getSenderNm(): ?string
    {
        return $this->senderNm;
    }

    /**
     * @param string|null $senderNm
     */
    public function setSenderNm(?string $senderNm): void
    {
        $this->senderNm = $senderNm;
    }

    /**
     * @return string|null
     */
    public function getTraderNm(): ?string
    {
        return $this->traderNm;
    }

    /**
     * @param string|null $traderNm
     */
    public function setTraderNm(?string $traderNm): void
    {
        $this->traderNm = $traderNm;
    }

    /**
     * @return string|null
     */
    public function getPayTypeNm(): ?string
    {
        return $this->payTypeNm;
    }

    /**
     * @param string|null $payTypeNm
     */
    public function setPayTypeNm(?string $payTypeNm): void
    {
        $this->payTypeNm = $payTypeNm;
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
     * @return \Stellion\Primbg\Models\Partner|null
     */
    public function getPartners(): ?Partner
    {
        return $this->partners;
    }

    /**
     * @param \Stellion\Primbg\Models\Partner|null $partners
     */
    public function setPartners(?Partner $partners): void
    {
        $this->partners = $partners;
    }

    /**
     * @return \Stellion\Primbg\Models\Order\Row[]
     */
    public function getRows(): array
    {
        return $this->rows ?? [];
    }

    /**
     * @param \Stellion\Primbg\Models\Order\Row[] $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }
}