<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;

use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Service implements Arrayable
{
    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $sku;
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var int|null
     */
    private $service;
    /**
     * @var string|null
     */
    private $tp;
    /**
     * @var array|null
     */
    private $bom_rows;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var string|null
     */
    private $controlType;
    /**
     * @var \Stellion\Primbg\Models\Brand|null
     */
    private $brand;
    /**
     * @var \Stellion\Primbg\Models\Group|null
     */
    private $group;
    /**
     * @var \Stellion\Primbg\Models\Measure[]|null
     */
    private $measures;
    /**
     * @var int|null
     */
    private $other;
    /**
     * @var int|null
     */
    private $item;
    /**
     * @var string|null
     */
    private $status;

    /**
     * @var array|string[]
     */
    protected array $castMap = [
        'sku' => 'string'
    ];
    /**
     * @var array|string[]
     */
    protected array $objectConvertMap = [
        'brand' => Brand::class,
        'group' => Group::class
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
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string|null $sku
     */
    public function setSku(?string $sku): void
    {
        $this->sku = $sku;
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
     * @return int|null
     */
    public function getService(): ?int
    {
        return $this->service;
    }

    /**
     * @param int|null $service
     */
    public function setService(?int $service): void
    {
        $this->service = $service;
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
     * @return array|null
     */
    public function getBomRows(): ?array
    {
        return $this->bom_rows;
    }

    /**
     * @param array|null $bom_rows
     */
    public function setBomRows(?array $bom_rows): void
    {
        $this->bom_rows = $bom_rows;
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
    public function getControlType(): ?string
    {
        return $this->controlType;
    }

    /**
     * @param string|null $controlType
     */
    public function setControlType(?string $controlType): void
    {
        $this->controlType = $controlType;
    }

    /**
     * @return \Stellion\Primbg\Models\Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    /**
     * @param \Stellion\Primbg\Models\Brand|null $brand
     */
    public function setBrand(?Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return \Stellion\Primbg\Models\Group|null
     */
    public function getGroup(): ?Group
    {
        return $this->group;
    }

    /**
     * @param \Stellion\Primbg\Models\Group|null $group
     */
    public function setGroup(?Group $group): void
    {
        $this->group = $group;
    }

    /**
     * @return \Stellion\Primbg\Models\Measure[]|null
     */
    public function getMeasures(): ?array
    {
        return $this->measures;
    }

    /**
     * @param \Stellion\Primbg\Models\Measure[]|null $measures
     */
    public function setMeasures(?array $measures): void
    {
        $this->measures = $measures;
    }

    /**
     * @return int|null
     */
    public function getOther(): ?int
    {
        return $this->other;
    }

    /**
     * @param int|null $other
     */
    public function setOther(?int $other): void
    {
        $this->other = $other;
    }

    /**
     * @return int|null
     */
    public function getItem(): ?int
    {
        return $this->item;
    }

    /**
     * @param int|null $item
     */
    public function setItem(?int $item): void
    {
        $this->item = $item;
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
}
