<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Brand implements Arrayable
{
    use ArrayableTrait, FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var string|array|null
     */
    private $name;

    /**
     * Brand constructor.
     * @param array $brand
     */
    public function __construct(array $brand = [])
    {
        $this->fromArray($brand);
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
     * @return string|array|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|array|null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}
