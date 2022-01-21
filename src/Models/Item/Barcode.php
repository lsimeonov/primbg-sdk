<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Item;

use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Barcode
{
    use FromArrayTrait;

    /**
     * @var string
     */
    private $barcode;

    /**
     * @var int|null
     */
    private $orderId;

    /**
     * @var string[]
     */
    protected $castMap = [
        'barcode' => 'string',
        'orderId' => 'int',
    ];

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        if (is_array($attributes)) {
            $this->fromArray($attributes);
        } elseif (is_scalar($attributes)) {
            $this->barcode = (string)$attributes;
        }
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode): void
    {
        $this->barcode = $barcode;
    }

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int|null $orderId
     */
    public function setOrderId(?int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function __toString(): string
    {
        return $this->barcode;
    }
}