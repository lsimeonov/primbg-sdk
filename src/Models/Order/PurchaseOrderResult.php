<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Order;

use Carbon\Carbon;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\RelationalTransport;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class PurchaseOrderResult implements Arrayable
{
    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @var string|null
     */
    private $num;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var \Stellion\Primbg\Models\RelationalTransport[]
     */
    private $relTrans;

    /**
     * @var \DateTimeInterface
     */
    private $forDate;

    /**
     * @var string[]
     */
    protected $castMap = [
        'num' => 'string',
        'type' => 'string'
    ];
    /**
     * @var string[]
     */
    protected $objectConvertMap = [
        'rel_trans' => RelationalTransport::class
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return \Stellion\Primbg\Models\RelationalTransport[]
     */
    public function getRelTrans(): array
    {
        return $this->relTrans ?? [];
    }

    /**
     * @param \Stellion\Primbg\Models\RelationalTransport[] $relTrans
     */
    public function setRelTrans(array $relTrans): void
    {
        $this->relTrans = $relTrans;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getForDate(): \DateTimeInterface
    {
        return $this->forDate;
    }

    /**
     * @param string $forDate
     */
    public function setForDate($forDate): void
    {
        $this->forDate = Carbon::parse($forDate);
    }


}