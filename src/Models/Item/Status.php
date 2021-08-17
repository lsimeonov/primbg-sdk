<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Item;


use Stellion\Primbg\Exceptions\Models\Item\InvalidStatus;

class Status
{
    const STATUS_WORK = 'work';
    const STATUS_ARCHIVE = 'archive';

    /**
     * @var string[]
     */
    private $statuses = [
        self::STATUS_WORK,
        self::STATUS_ARCHIVE
    ];

    /**
     * Status constructor.
     * @param string $value
     * @throws \Stellion\Primbg\Exceptions\Models\Item\InvalidStatus
     */
    public function __construct(string $value)
    {
        if (!in_array($value, $this->statuses)) {
            throw new InvalidStatus($value);
        }

        $this->status = $value;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->status ?? '';
    }
}
