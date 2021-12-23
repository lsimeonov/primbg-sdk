<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;

use Carbon\Carbon;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;


class RelationalTransport implements Arrayable
{

    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @var int
     */
    private $relTransId;
    /**
     * @var int
     */
    private $transId;
    /**
     * @var string
     */
    private $num;
    /**
     * @var string
     */
    private $type;
    /**
     * @var \DateTimeInterface
     */
    private $forDate;

    protected $castMap = [
        'num' => 'string',
    ];

    public function __construct(array $attributes = [])
    {
        $this->fromArray($attributes);
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
     * @return string|null
     */
    public function getType(): ?string
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