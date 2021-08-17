<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Pos implements Arrayable
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
    private $companyId;

    /**
     * @var string|null
     */
    private $name;
    /**
     * @var int|null
     */
    private $shopId;

    /**
     * @var int|null
     */
    private $officeId;

    /**
     * @var string|null
     */
    private $shopName;

    /**
     * @var int|null
     */
    private $accountId;

    /**
     * @var int|null
     */
    private $storeId;

    /**
     * @var string|null
     */
    private $officeName;

    /**
     * @var string|null
     */
    private $code;
    /**
     * Pos constructor.
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
    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    /**
     * @param int|null $companyId
     */
    public function setCompanyId(?int $companyId): void
    {
        $this->companyId = $companyId;
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
    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    /**
     * @param int|null $shopId
     */
    public function setShopId(?int $shopId): void
    {
        $this->shopId = $shopId;
    }

    /**
     * @return int|null
     */
    public function getOfficeId(): ?int
    {
        return $this->officeId;
    }

    /**
     * @param int|null $officeId
     */
    public function setOfficeId(?int $officeId): void
    {
        $this->officeId = $officeId;
    }

    /**
     * @return string|null
     */
    public function getShopName(): ?string
    {
        return $this->shopName;
    }

    /**
     * @param string|null $shopName
     */
    public function setShopName(?string $shopName): void
    {
        $this->shopName = $shopName;
    }

    /**
     * @return int|null
     */
    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    /**
     * @param int|null $accountId
     */
    public function setAccountId(?int $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @param int|null $storeId
     */
    public function setStoreId(?int $storeId): void
    {
        $this->storeId = $storeId;
    }

    /**
     * @return string|null
     */
    public function getOfficeName(): ?string
    {
        return $this->officeName;
    }

    /**
     * @param string|null $officeName
     */
    public function setOfficeName(?string $officeName): void
    {
        $this->officeName = $officeName;
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
}
