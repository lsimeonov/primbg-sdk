<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Measure implements Arrayable
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
    private $tp;

    /**
     * @var string|null
     */
    private $second;

    /**
     * @var boolean|null
     */
    private $isWeight;

    /**
     * @var int|null
     */
    private $formula;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var int|null
     */
    private $base;

    /**
     * @var string|null
     */
    private $siLabel;

    /**
     * @var string[]
     */
    protected $castMap = [
        'is_weight' => 'bool'
    ];

    /**
     * Measure constructor.
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
     * @return string|null
     */
    public function getSecond(): ?string
    {
        return $this->second;
    }

    /**
     * @param string|null $second
     */
    public function setSecond(?string $second): void
    {
        $this->second = $second;
    }

    /**
     * @return bool|null
     */
    public function getIsWeight(): ?bool
    {
        return $this->isWeight;
    }

    /**
     * @param bool|null $isWeight
     */
    public function setIsWeight(?bool $isWeight): void
    {
        $this->isWeight = $isWeight;
    }

    /**
     * @return int|null
     */
    public function getFormula(): ?int
    {
        return $this->formula;
    }

    /**
     * @param int|null $formula
     */
    public function setFormula(?int $formula): void
    {
        $this->formula = $formula;
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
     * @return int|null
     */
    public function getBase(): ?int
    {
        return $this->base;
    }

    /**
     * @param int|null $base
     */
    public function setBase(?int $base): void
    {
        $this->base = $base;
    }

    /**
     * @return string|null
     */
    public function getSiLabel(): ?string
    {
        return $this->siLabel;
    }

    /**
     * @param string|null $siLabel
     */
    public function setSiLabel(?string $siLabel): void
    {
        $this->siLabel = $siLabel;
    }
}
