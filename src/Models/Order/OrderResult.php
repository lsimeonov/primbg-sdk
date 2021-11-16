<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Order;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\RelationalTransport;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class OrderResult implements Arrayable
{

    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $num;
    /**
     * @var string
     */
    private $typeAction;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $forDate;
    /**
     * @var string
     */
    private $forDateFormated;

    /**
     * @var \Stellion\Primbg\Models\RelationalTransport[]|null
     */
    private $relTrans;

    /**
     * @var string[]
     */
    protected $objectConvertMap = [
        'rel_trans' => RelationalTransport::class
    ];

    protected array $castMap = [
        'num' => 'string',
    ];

    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNum(): string
    {
        return $this->num;
    }

    /**
     * @param string $num
     */
    public function setNum(string $num): void
    {
        $this->num = $num;
    }

    /**
     * @return string
     */
    public function getTypeAction(): string
    {
        return $this->typeAction;
    }

    /**
     * @param string $typeAction
     */
    public function setTypeAction(string $typeAction): void
    {
        $this->typeAction = $typeAction;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getForDate(): string
    {
        return $this->forDate;
    }

    /**
     * @param string $forDate
     */
    public function setForDate(string $forDate): void
    {
        $this->forDate = $forDate;
    }

    /**
     * @return string
     */
    public function getForDateFormated(): string
    {
        return $this->forDateFormated;
    }

    /**
     * @param string $forDateFormated
     */
    public function setForDateFormated(string $forDateFormated): void
    {
        $this->forDateFormated = $forDateFormated;
    }

    /**
     * @return \Stellion\Primbg\Models\RelationalTransport[]|null
     */
    public function getRelTrans(): ?array
    {
        return $this->relTrans;
    }

    /**
     * @param \Stellion\Primbg\Models\RelationalTransport[] $relTrans
     */
    public function setRelTrans(array $relTrans): void
    {
        $this->relTrans = $relTrans;
    }
}