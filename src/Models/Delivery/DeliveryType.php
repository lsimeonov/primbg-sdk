<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Delivery;


use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

/**
 * Class DeliveryType
 * @package Stellion\Primbg\Models
 */
class DeliveryType
{

    use ArrayableTrait,
        FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int|null
     */
    private $integrationSystemId;
    /**
     * @var string|null
     */
    private $code;
    /**
     * @var string|null
     */
    private $name;

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
     * @return int|null
     */
    public function getIntegrationSystemId(): ?int
    {
        return $this->integrationSystemId;
    }

    /**
     * @param int|null $integrationSystemId
     */
    public function setIntegrationSystemId(?int $integrationSystemId): void
    {
        $this->integrationSystemId = $integrationSystemId;
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
}
