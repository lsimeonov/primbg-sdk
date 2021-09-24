<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Item\Status;
use Stellion\Primbg\Models\Item\Supplier;
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
     * @var string|array
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
     * @var \Stellion\Primbg\Models\Measure[]|null
     */
    private $measures;

    /**
     * @var \Stellion\Primbg\Models\Item\Supplier|null
     */
    private $supplier;

    /**
     * @var string[]
     */
    protected array $objectConvertMap = [
        'brand' => Brand::class,
        'group' => Group::class,
        'tp' => Type::class,
        'measures' => Measure::class,
        'status' => Status::class,
        'supplier' => Supplier::class
    ];

    protected array $castMap = [
        'code' => 'string',
        'expense' => 'bool',
        'income' => 'bool'
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
     * @return string|array
     */
    public function getDescription()
    {
        return $this->description ?? '';
    }

    /**
     * @param string|array $description
     */
    public function setDescription($description): void
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

    /**
     * @return \Stellion\Primbg\Models\Measure[]
     */
    public function getMeasures(): ?array
    {
        return $this->measures;
    }

    /**
     * @param \Stellion\Primbg\Models\Measure[] $measures
     */
    public function setMeasures(?array $measures): void
    {
        $this->measures = $measures;
    }

    /**
     * @return \Stellion\Primbg\Models\Item\Supplier|null
     */
    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    /**
     * @param \Stellion\Primbg\Models\Item\Supplier|null $supplier
     */
    public function setSupplier(?Supplier $supplier): void
    {
        $this->supplier = $supplier;
    }
}
