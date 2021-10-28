<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

class Partner implements Arrayable
{
    use ArrayableTrait,
        FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var bool|null
     */
    private $isCompany;
    /**
     * @var string|null
     */
    private $partnerType;
    /**
     * @var string|null
     */
    private $name;
    /**
     * @var string|null
     */
    private $eik;

    /**
     * @var string|null
     */
    private $ddsNum;
    /**
     * @var string|null
     */
    private $egn;
    /**
     * @var string|null
     */
    private $email;
    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $fax;

    /**
     * @var string|null
     */
    private $note;

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var string|null
     */
    private $trader;

    /**
     * @var bool|null
     */
    private $isClient;

    /**
     * @var string|null
     */
    private $clientType;

    /**
     * @var bool|null
     */
    private $isVendor;

    /**
     * @var string|null
     */
    private $vendorType;

    /**
     * @var bool|null
     */
    private $isForeign;

    /**
     * @var bool|null
     */
    private $archive;

    /**
     * @var string[]
     */
    private $castMap = [
        'is_client' => 'bool',
        'is_vendor' => 'bool',
        'is_company' => 'bool',
        'is_foreign' => 'bool',
        'archive' => 'bool',
        'dds_num' => 'string',
        'phone' => 'string',
        'eik' => 'string'
    ];

    /**
     * Partner constructor.
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
     * @return bool|null
     */
    public function getIsCompany(): ?bool
    {
        return $this->isCompany;
    }

    /**
     * @param bool|null $isCompany
     */
    public function setIsCompany(?bool $isCompany): void
    {
        $this->isCompany = $isCompany;
    }

    /**
     * @return string|null
     */
    public function getPartnerType(): ?string
    {
        return $this->partnerType;
    }

    /**
     * @param string|null $partnerType
     */
    public function setPartnerType(?string $partnerType): void
    {
        $this->partnerType = $partnerType;
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
     * @param string|null $name
     */
    public function setNm(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEik(): ?string
    {
        return $this->eik;
    }

    /**
     * @param string|null $eik
     */
    public function setEik(?string $eik): void
    {
        $this->eik = $eik;
    }

    /**
     * @return string|null
     */
    public function getDdsNum(): ?string
    {
        return $this->ddsNum;
    }

    /**
     * @param string|null $ddsNum
     */
    public function setDdsNum(?string $ddsNum): void
    {
        $this->ddsNum = $ddsNum;
    }

    /**
     * @return string|null
     */
    public function getEgn(): ?string
    {
        return $this->egn;
    }

    /**
     * @param string|null $egn
     */
    public function setEgn(?string $egn): void
    {
        $this->egn = $egn;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setMail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string|null $fax
     */
    public function setFax(?string $fax): void
    {
        $this->fax = $fax;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     */
    public function setNote(?string $note): void
    {
        $this->note = $note;
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

    /**
     * @return string|null
     */
    public function getTrader(): ?string
    {
        return $this->trader;
    }

    /**
     * @param string|null $trader
     */
    public function setTrader(?string $trader): void
    {
        $this->trader = $trader;
    }

    /**
     * @return bool|null
     */
    public function getIsClient(): ?bool
    {
        return $this->isClient;
    }

    /**
     * @param bool|null $isClient
     */
    public function setIsClient(?bool $isClient): void
    {
        $this->isClient = $isClient;
    }

    /**
     * @return string|null
     */
    public function getClientType(): ?string
    {
        return $this->clientType;
    }

    /**
     * @param string|null $clientType
     */
    public function setClientType(?string $clientType): void
    {
        $this->clientType = $clientType;
    }

    /**
     * @return bool|null
     */
    public function getIsVendor(): ?bool
    {
        return $this->isVendor;
    }

    /**
     * @param bool|null $isVendor
     */
    public function setIsVendor(?bool $isVendor): void
    {
        $this->isVendor = $isVendor;
    }

    /**
     * @return string|null
     */
    public function getVendorType(): ?string
    {
        return $this->vendorType;
    }

    /**
     * @param string|null $vendorType
     */
    public function setVendorType(?string $vendorType): void
    {
        $this->vendorType = $vendorType;
    }

    /**
     * @return bool|null
     */
    public function getIsForeign(): ?bool
    {
        return $this->isForeign;
    }

    /**
     * @param bool|null $isForeign
     */
    public function setIsForeign(?bool $isForeign): void
    {
        $this->isForeign = $isForeign;
    }

    /**
     * @return bool|null
     * @deprecated  in favor of isArchived
     */
    public function getArchive(): ?bool
    {
        return $this->isArchived();
    }

    /**
     * @return bool|null
     */
    public function isArchived()
    {
        return $this->archive;
    }

    /**
     * @param bool|null $archive
     */
    public function setArchive(?bool $archive): void
    {
        $this->archive = $archive;
    }
}
