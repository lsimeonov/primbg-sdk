<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Order;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Transaction implements Arrayable
{

    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @var int
     */
    private $transId;
    /**
     * @var int
     */
    private $relTransId;
    /**
     * @var string
     */
    private $forDate;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $num;

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
     * @return int
     */
    public function getTransId(): int
    {
        return $this->transId;
    }

    /**
     * @param int $transId
     */
    public function setTransId(int $transId): void
    {
        $this->transId = $transId;
    }

    /**
     * @return int
     */
    public function getRelTransId(): int
    {
        return $this->relTransId;
    }

    /**
     * @param int $relTransId
     */
    public function setRelTransId(int $relTransId): void
    {
        $this->relTransId = $relTransId;
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
}