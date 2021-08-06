<?php

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Group implements Arrayable
{
    use ArrayableTrait, FromArrayTrait;

    /**
     * @var int|null
     */
    private $haveChilds;
    /**
     * @var int|null
     */
    private $parentId;
    /**
     * @var string|string[]
     */
    private $name;
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $parentName;
    /**
     * @var string|null
     */
    private $code;
    /**
     * @var string
     */
    private $taxInstanceName;

    /**
     * @var array|string[]
     */
    private $castMap = [
        'code' => 'string'
    ];

    /**
     * Group constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
       $this->fromArray($attributes);
    }

    /**
     * @return int|null
     */
    public function getHaveChilds(): ?int
    {
        return $this->haveChilds;
    }

    /**
     * @param int|null $haveChilds
     */
    public function setHaveChilds(?int $haveChilds): void
    {
        $this->haveChilds = $haveChilds;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @param int|null $parentId
     */
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
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
    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    /**
     * @param string|null $parentName
     */
    public function setParentName(?string $parentName): void
    {
        $this->parentName = $parentName;
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
    public function getTaxInstanceName(): ?string
    {
        return $this->taxInstanceName;
    }

    /**
     * @param string|null $taxInstanceName
     */
    public function setTaxInstanceName(?string $taxInstanceName): void
    {
        $this->taxInstanceName = $taxInstanceName;
    }
}
