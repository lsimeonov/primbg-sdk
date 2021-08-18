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
     * @var float|null
     */
    private $H;
    /**
     * @var float|null
     */
    private $W;
    /**
     * @var float|null
     */
    private $L;
    /**
     * @var float|null
     */
    private $weight;
    /**
     * @var float|null
     */
    private $gross;

    /**
     * @var string[]
     */
    protected $castMap = [
        'is_weight' => 'bool',
        'H' => 'float',
        'W' => 'float',
        'L' => 'float',
        'weight' => 'float',
        'gross' => 'float'
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

    /**
     * @return float|null
     */
    public function getH(): ?float
    {
        return $this->H;
    }

    /**
     * @param float|null $H
     */
    public function setH(?float $H): void
    {
        $this->H = $H;
    }

    /**
     * @return float|null
     */
    public function getW(): ?float
    {
        return $this->W;
    }

    /**
     * @param float|null $W
     */
    public function setW(?float $W): void
    {
        $this->W = $W;
    }

    /**
     * @return float|null
     */
    public function getL(): ?float
    {
        return $this->L;
    }

    /**
     * @param float|null $L
     */
    public function setL(?float $L): void
    {
        $this->L = $L;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     */
    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return float|null
     */
    public function getGross(): ?float
    {
        return $this->gross;
    }

    /**
     * @param float|null $gross
     */
    public function setGross(?float $gross): void
    {
        $this->gross = $gross;
    }
}
