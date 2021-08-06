<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Item\Type;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Item implements Arrayable
{
    use ArrayableTrait, FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $sku;

    /**
     * @var string|string[]
     */
    private $name;

    /**
     * @var \Stellion\Primbg\Models\Item\Status|null
     */
    private $status;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Stellion\Primbg\Models\Item\Type|null
     */
    private $tp;

    /**
     * @var bool
     */
    private $income = false;

    /**
     * @var bool
     */
    private $expense = false;

    /**
     * @var \Stellion\Primbg\Models\Brand|null
     */
    private $brand;

    /**
     * @var \Stellion\Primbg\Models\Group|null
     */
    private $group;

    /**
     * @var string[]
     */
    protected array $objectConvertMap = [
        'brand' => Brand::class,
        'group' => Group::class,
        'tp' => Type::class
    ];

    protected array $castMap = [
        'code' => 'string'
    ];

    /**
     * Item constructor.
     * @param array $item
     */
    public function __construct(array $item = [])
    {
        $this->fromArray($item);
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
     * @return string|string[]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|string[] $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return \Stellion\Primbg\Models\Item\Status|null
     */
    public function getStatus(): ?Item\Status
    {
        return $this->status;
    }

    /**
     * @param \Stellion\Primbg\Models\Item\Status|null $status
     */
    public function setStatus(?Item\Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \Stellion\Primbg\Models\Item\Type|null
     */
    public function getTp(): ?Item\Type
    {
        return $this->tp;
    }

    /**
     * @param \Stellion\Primbg\Models\Item\Type|null $tp
     */
    public function setTp(?Item\Type $tp): void
    {
        $this->tp = $tp;
    }

    /**
     * @return bool
     */
    public function getIncome(): bool
    {
        return $this->income;
    }

    /**
     * @param bool $income
     */
    public function setIncome(bool $income): void
    {
        $this->income = $income;
    }

    /**
     * @return bool
     */
    public function getExpense(): bool
    {
        return $this->expense;
    }

    /**
     * @param bool $expense
     */
    public function setExpense(bool $expense): void
    {
        $this->expense = $expense;
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
}