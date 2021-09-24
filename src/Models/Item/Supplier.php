<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Item;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

/**
 *
 */
class Supplier implements Arrayable
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
    private $type;
    /**
     * @var string|null
     */
    private $measure;


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
     * @return string|null
     */
    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    /**
     * @param string|null $measure
     */
    public function setMeasure(?string $measure): void
    {
        $this->measure = $measure;
    }

}
