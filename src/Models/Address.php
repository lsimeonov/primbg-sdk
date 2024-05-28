<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\AllowNullIdInterface;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Traits\ArrayableTrait;
use Stellion\Primbg\Models\Traits\FromArrayTrait;

/**
 * Class Address
 * @package Stellion\Primbg\Models
 */
class Address implements Arrayable, AllowNullIdInterface
{
    use ArrayableTrait;
    use FromArrayTrait;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $country;

    /**
     * @var string|null
     */
    private $district;
    /**
     * @var string|null
     */
    private $settlement;

    /**
     * @var string|null
     */
    private $street;

    /**
     * @var string|null
     */
    private $nbh;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $num;

    /**
     * @var string|null
     */
    private $building;

    /**
     * @var string|null
     */
    private $buildingEntrance;

    /**
     * @var string|null
     */
    private $buildingFloor;

    /**
     * @var string|null
     */
    private $buildingApartment;

    /**
     * @var string|null
     */
    private $zip;

    /**
     * @var string|null
     */
    private $zipNum;

    /**
     * @var string|null
     */
    private $fullAddress;

    protected array $castMap = [
        'zip' => 'string',
        'building' => 'string',
        'num' => 'string',
        'zip_num' => 'string',
        'address' => 'string',
        'full_address' => 'string',
        'district' => 'string',
        'street' => 'string',
        'nbh' => 'string',
        'phone' => 'string',
        'settlement' => 'string'
    ];

    /**
     * DeliveryAddress constructor.
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
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @param string|null $district
     */
    public function setDistrict(?string $district): void
    {
        $this->district = $district;
    }

    /**
     * @return string|null
     */
    public function getSettlement(): ?string
    {
        return $this->settlement;
    }

    /**
     * @param string|null $settlement
     */
    public function setSettlement(?string $settlement): void
    {
        $this->settlement = $settlement;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string|null
     */
    public function getNbh(): ?string
    {
        return $this->nbh;
    }

    /**
     * @param string|null $nbh
     */
    public function setNbh(?string $nbh): void
    {
        $this->nbh = $nbh;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getNum(): ?string
    {
        return $this->num;
    }

    /**
     * @param string|null $num
     */
    public function setNum(?string $num): void
    {
        $this->num = $num;
    }

    /**
     * @return string|null
     */
    public function getBuilding(): ?string
    {
        return $this->building;
    }

    /**
     * @param string|null $building
     */
    public function setBuilding(?string $building): void
    {
        $this->building = $building;
    }

    /**
     * @return string|null
     */
    public function getBuildingEntrance(): ?string
    {
        return $this->buildingEntrance;
    }

    /**
     * @param string|null $buildingEntrance
     */
    public function setBuildingEntrance(?string $buildingEntrance): void
    {
        $this->buildingEntrance = $buildingEntrance;
    }

    /**
     * @return string|null
     */
    public function getBuildingFloor(): ?string
    {
        return $this->buildingFloor;
    }

    /**
     * @param string|null $buildingFloor
     */
    public function setBuildingFloor(?string $buildingFloor): void
    {
        $this->buildingFloor = $buildingFloor;
    }

    /**
     * @return string|null
     */
    public function getBuildingApartment(): ?string
    {
        return $this->buildingApartment;
    }

    /**
     * @param string|null $buildingApartment
     */
    public function setBuildingApartment(?string $buildingApartment): void
    {
        $this->buildingApartment = $buildingApartment;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     */
    public function setZip(?string $zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string|null
     */
    public function getZipNum(): ?string
    {
        return $this->zipNum;
    }

    /**
     * @param string|null $zipNum
     */
    public function setZipNum(?string $zipNum): void
    {
        $this->zipNum = $zipNum;
    }

    /**
     * @return string|null
     */
    public function getFullAddress(): ?string
    {
        return $this->fullAddress;
    }

    /**
     * @param string|null $fullAddress
     */
    public function setFullAddress(?string $fullAddress): void
    {
        $this->fullAddress = $fullAddress;
    }
}
