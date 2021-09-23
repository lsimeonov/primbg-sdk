<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class PriceList implements Arrayable
{

    use ArrayableTrait,
        FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $tp;

    /**
     * @var int|null
     */
    private $status;

    /**
     * @var string[]
     */
    private $castMap = [
        'code' => 'string'
    ];

    /**
     * DeliveryType constructor.
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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getTp(): ?string
    {
        return $this->tp;
    }

    /**
     * @param string|null $tp
     */
    public function setTp(?string $tp): void
    {
        $this->tp = $tp;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }
}
