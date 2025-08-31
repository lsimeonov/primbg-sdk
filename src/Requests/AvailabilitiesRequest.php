<?php
declare(strict_types=1);

namespace Stellion\Primbg\Requests;

class AvailabilitiesRequest implements RequestInterface
{
    /**
     * @var string[]
     */
    private $storeNames;

    /**
     * @var string[]
     */
    private $skuCodes;

    /**
     * @param string[] $storeNames
     * @param string[] $skuCodes
     */
    public function __construct(array $storeNames = [], array $skuCodes = [])
    {
        $this->storeNames = $storeNames;
        $this->skuCodes = $skuCodes;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        $data = [];

        foreach ($this->storeNames as $storeName) {
            $data[] = ['stores_names' => $storeName];
        }

        foreach ($this->skuCodes as $skuCode) {
            $data[] = ['skus_codes' => $skuCode];
        }

        return $data;
    }

    /**
     * Add a store name to the request
     *
     * @param string $storeName
     * @return AvailabilitiesRequest
     */
    public function addStoreName(string $storeName): AvailabilitiesRequest
    {
        $this->storeNames[] = $storeName;
        return $this;
    }

    /**
     * Add a SKU code to the request
     *
     * @param string $skuCode
     * @return AvailabilitiesRequest
     */
    public function addSkuCode(string $skuCode): AvailabilitiesRequest
    {
        $this->skuCodes[] = $skuCode;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getStoreNames(): array
    {
        return $this->storeNames;
    }

    /**
     * @param string[] $storeNames
     * @return AvailabilitiesRequest
     */
    public function setStoreNames(array $storeNames): AvailabilitiesRequest
    {
        $this->storeNames = $storeNames;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getSkuCodes(): array
    {
        return $this->skuCodes;
    }

    /**
     * @param string[] $skuCodes
     * @return AvailabilitiesRequest
     */
    public function setSkuCodes(array $skuCodes): AvailabilitiesRequest
    {
        $this->skuCodes = $skuCodes;
        return $this;
    }
}
