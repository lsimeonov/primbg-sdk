<?php

namespace Stellion\Primbg\Models;


use Illuminate\Support\Str;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Traits\ArrayableTrait;

class Group implements Arrayable
{
    use ArrayableTrait;

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
     * @var string|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $parentName;
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $taxInstanceName;

    /**
     * Group constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        foreach ($attributes as $k => $v) {
            $setter = 'set' . ucfirst(Str::camel($k));
            if (method_exists($this, $setter)) {
                $this->$setter($v);
            }
        }
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
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getTaxInstanceName(): string
    {
        return $this->taxInstanceName;
    }

    /**
     * @param string $taxInstanceName
     */
    public function setTaxInstanceName(string $taxInstanceName): void
    {
        $this->taxInstanceName = $taxInstanceName;
    }
}