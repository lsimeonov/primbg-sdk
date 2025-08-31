<?php


namespace Stellion\Primbg;


use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Stellion\Primbg\Exceptions\ErrorResponseException;
use Stellion\Primbg\Exceptions\Http\HttpBadResponse;
use Stellion\Primbg\Exceptions\UnexpectedEntity;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Brand;
use Stellion\Primbg\Models\Delivery\DeliveryType;
use Stellion\Primbg\Models\EmptyGroup;
use Stellion\Primbg\Models\Group;
use Stellion\Primbg\Models\Item;
use Stellion\Primbg\Models\Order;
use Stellion\Primbg\Models\Order\OrderResult;
use Stellion\Primbg\Models\Partner;
use Stellion\Primbg\Models\PaymentType;
use Stellion\Primbg\Models\Pos;
use Stellion\Primbg\Models\Price;
use Stellion\Primbg\Models\PriceList;
use Stellion\Primbg\Models\SaleType;
use Stellion\Primbg\Models\Service;
use Stellion\Primbg\Models\Availability;
use Stellion\Primbg\Requests\SaleOrdersRequest;
use Stellion\Primbg\Requests\AvailabilitiesRequest;
use Stellion\Primbg\ValueObjects\Endpoint;
use Stellion\Primbg\ValueObjects\Token;

/**
 * Class PrimbgClient
 * @package Stellion\Primbg
 * @TODO: Interface
 */
class Client
{

    const DEFAULT_TIMEOUT = 60;

    /**
     * @var \Stellion\Primbg\ValueObjects\Token
     */
    private $token;
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * PrimbgClient constructor.
     *
     * @param \Stellion\Primbg\ValueObjects\Endpoint $endpoint
     * @param \Stellion\Primbg\ValueObjects\Token $token
     */
    public function __construct(Endpoint $endpoint, Token $token)
    {
        $this->token = $token;
        $this->httpClient = new HttpClient(
            [
                'base_uri' => $endpoint->getEndpoint() . '/api/',
                'timeout' => self::DEFAULT_TIMEOUT,
            ]
        );
    }


    /**
     * @param string $code
     *
     * @return \Stellion\Primbg\Models\Group
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getSingleGroup(string $code): Group
    {
        $body = $this->request('RPC.common.RestApi.getOneGroup', [
            'json' => [
                'code' => $code,
            ],
        ]);

        if (empty($body['data'])) {
            return new EmptyGroup();
        }

        return new Group($body['data']);
    }

    /**
     * @param \Stellion\Primbg\Models\Group $group
     *
     * @return \Stellion\Primbg\Models\Group
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     * @throws \Stellion\Primbg\Exceptions\UnexpectedEntity
     */
    public function updateGroup(Group $group): Group
    {
        if (!$group->getId()) {
            throw new UnexpectedEntity('Group id is missing');
        }
        $payload = $this->prepareEntityForPayload($group);

        $body = $this->request('RPC.common.Api.Groups.set', [
            'json' => $payload,
        ]);

        return new Group($body['data']['result'][0]);
    }

    /**
     * @param \Stellion\Primbg\Models\Group $group
     *
     * @return \Stellion\Primbg\Models\Group
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     * @throws \Stellion\Primbg\Exceptions\UnexpectedEntity
     */
    public function createGroup(Group $group): Group
    {
        if ($group->getId()) {
            throw new UnexpectedEntity('Group id is loaded');
        }
        $payload = $this->prepareEntityForPayload($group);

        $body = $this->request('RPC.common.Api.Groups.set', [
            'json' => $payload,
        ]);

        return new Group($body['data']['result'][0]);
    }

    /**
     * @param \Stellion\Primbg\Models\Group $group
     * @return \Stellion\Primbg\Models\Group
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function findGroup(Group $group): Group
    {
        $payload = $this->prepareEntityForPayload($group);

        try {
            $body = $this->request('RPC.common.Api.Groups.get', [
                'json' => $payload
            ]);
        } catch (ErrorResponseException $e) {
            return new EmptyGroup();
        }

        return new Group($body['data']['result'][0]);
    }

    /**
     * @return Group[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getGroups(int $offset = 0, int $limit = 200): array
    {
        $payload = [
            'get_all' => true,
            'limit' => $limit,
            'offset' => $offset
        ];

        $body = $this->request('RPC.common.Api.Groups.get', [
            'json' => $payload
        ]);

        return array_map(function ($response) {
            $response['code'] = (string)$response['code'];
            return new Group($response);
        }, $body['data']['result']);
    }

    /**
     * @return array
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getTaxInstances(): array
    {
        $payload = [
            'get_all' => true
        ];

        $body = $this->request('RPC.common.Api.TaxInstances.get', [
            'json' => $payload
        ]);

        return $body['result'] ?? [];
    }

    /**
     * @param \Stellion\Primbg\Models\Brand $brand
     * @return \Stellion\Primbg\Models\Brand
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     * @throws \Stellion\Primbg\Exceptions\UnexpectedEntity
     */
    public function createBrand(Brand $brand): Brand
    {
        if ($brand->getId()) {
            throw new UnexpectedEntity('ID not expected.');
        }

        $payload = $this->prepareEntityForPayload($brand);

        $body = $this->request('RPC.common.Api.Brands.set', [
            'json' => $payload
        ]);

        return new Brand($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Brand $brand
     * @return \Stellion\Primbg\Models\Brand|null
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function findBrand(Brand $brand): ?Brand
    {
        $payload = $this->prepareEntityForPayload($brand);

        try {
            $body = $this->request('RPC.common.Api.Brands.get', [
                'json' => $payload,
            ]);
        } catch (ErrorResponseException $e) {
            return new Brand();
        }

        return new Brand($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Item $item
     * @return \Stellion\Primbg\Models\Item
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function findItem(Item $item): Item
    {
        $payload = $this->prepareEntityForPayload($item);

        try {
            $body = $this->request('RPC.common.Api.Items.get', [
                'json' => $payload
            ]);
        } catch (ErrorResponseException $e) {
            return new Item();
        }

        return new Item($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Item $item
     * @return \Stellion\Primbg\Models\Item
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function createItem(Item $item): Item
    {
        $payload = $this->prepareEntityForPayload($item);

        $body = $this->request('RPC.common.Api.Items.set', [
            'json' => $payload
        ]);

        return new Item($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Item $item
     * @return \Stellion\Primbg\Models\Item
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     * @throws \Stellion\Primbg\Exceptions\UnexpectedEntity
     */
    public function updateItem(Item $item): Item
    {
        if (!$item->getId()) {
            throw new UnexpectedEntity('Item id is missing');
        }
        $payload = $this->prepareEntityForPayload($item);

        $body = $this->request('RPC.common.Api.Items.set', [
            'json' => $payload
        ]);

        return new Item($body['data']['result'][0] ?? []);
    }

    /**
     * @return \Stellion\Primbg\Models\Pos[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function allPOS()
    {
        $body = $this->request('RPC.common.Api.Pos.get', [
            'json' => ['get_all' => '1']
        ]);

        return array_map(function ($response) {
            return new Pos($response);
        }, $body['data']['result']);
    }

    /**
     * @param \Stellion\Primbg\Models\Partner $partner
     * @return \Stellion\Primbg\Models\Partner|null
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function findPartner(Partner $partner): ?Partner
    {
        $payload = $this->prepareEntityForPayload($partner);

        try {
            $body = $this->request('RPC.common.Api.Partners.get', [
                'json' => $payload,
            ]);
        } catch (ErrorResponseException $e) {
            return new Partner();
        }

        return new Partner($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Item $item
     * @return \Stellion\Primbg\Models\Item
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function createPartner(Partner $item): Partner
    {
        $payload = $this->prepareEntityForPayload($item);

        $body = $this->request('RPC.common.Api.Partners.set', [
            'json' => $payload
        ]);

        return new Partner($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Partner $partner
     * @return \Stellion\Primbg\Models\Partner
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     * @throws \Stellion\Primbg\Exceptions\UnexpectedEntity
     */
    public function updatePartner(Partner $partner)
    {
        if (!$partner->getId()) {
            throw new UnexpectedEntity('Partner id is missing');
        }
        $payload = $this->prepareEntityForPayload($partner);

        $body = $this->request('RPC.common.Api.Partners.set', [
            'json' => $payload
        ]);

        return new Partner($body['data']['result'][0] ?? []);
    }

    /**
     * @return \Stellion\Primbg\Models\SaleType[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function allSaleTypes(): array
    {
        $body = $this->request('RPC.common.Api.SoOrderTypes.get', [
            'json' => ['get_all' => '1']
        ]);

        return array_map(function ($response) {
            return new SaleType($response);
        }, $body['data']['result']);
    }

    /**
     * @param \Stellion\Primbg\Models\Order $order
     * @return \Stellion\Primbg\Models\Order
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function createSaleOrder(Order $order): Order
    {
        $payload = $this->prepareEntityForPayload($order);

        $body = $this->request('RPC.common.Api.So.set', [
            'json' => $payload
        ]);

        return new Order($body['data']['result'][0] ?? []);
    }

    /**
     * @param \DateTimeInterface[] $dateTimes
     * @return \Stellion\Primbg\Models\Order\OrderResult[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getSaleOrders(array $dateTimes): array
    {
        $payload['data'] = [];

        foreach ($dateTimes as $dateTime) {
            $payload['data'][] = [
                'for_date' => $dateTime->format('Y-m-d')
            ];
        }

        $body = $this->request('RPC.common.Api.So.get', [
            'json' => $payload
        ]);

        return array_map(function ($response) {
            return new OrderResult($response);
        }, $body['data']['result']);
    }

    /**
     * @param \Stellion\Primbg\Models\Order $order
     * @return \Stellion\Primbg\Models\Order
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function findSaleOrder(Order $order): Order
    {
        $payload = $this->prepareEntityForPayload($order);

        try {
            $body = $this->request('RPC.common.Api.So.getOneData', [
                'json' => $payload,
            ]);
        } catch (ErrorResponseException $e) {
            return new Order();
        }

        return new Order($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Requests\SaleOrdersRequest $request
     * @return \Stellion\Primbg\Models\Order[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getSingleSaleOrdersCollection(SaleOrdersRequest $request): array
    {
        $orders = [];
        $payloads = $request->getPayload();

        foreach ($payloads as $payload) {
            $body = $this->request('RPC.common.Api.So.getOneData', [
                'json' => [
                    'data' => [$payload]
                ]
            ]);
            if (isset($body['data']['result'][0])) {
                $orders[] = new Order($body['data']['result'][0] ?? []);
            }
        }

        return $orders;
    }

    /**
     * @param \Stellion\Primbg\Models\Order $order
     * @param string $description
     * @return array
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function completeCancelSaleOrder(Order $order, string $description = 'none'): array
    {
        if ($order->getNum()) {
            return $this->request('RPC.common.Api.So.fullAnnulSo', [
                'json' => [
                    'data' => [[
                        'num' => $order->getNum(),
                        'annul_description' => $description
                    ]]
                ]
            ]);
        }

        return [];
    }

    /**
     * @param \Stellion\Primbg\Models\Order\PurchaseOrder $purchaseOrder
     * @return \Stellion\Primbg\Models\Order\PurchaseOrder
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function findPurchaseOrder(Order\PurchaseOrder $purchaseOrder): Order\PurchaseOrder
    {
        $payload = $this->prepareEntityForPayload($purchaseOrder);

        try {
            $body = $this->request('RPC.common.Api.Po.getOneData', [
                'json' => $payload,
            ]);
        } catch (ErrorResponseException $e) {
            return new Order\PurchaseOrder();
        }

        return new Order\PurchaseOrder($body['data']['result'][0] ?? []);
    }

    /**
     * @param \DateTimeInterface[] $dateTimes
     * @return \Stellion\Primbg\Models\Order\OrderResult[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getPurchaseOrders(array $dateTimes): array
    {
        $payload['data'] = [];

        foreach ($dateTimes as $dateTime) {
            $payload['data'][] = [
                'for_date' => $dateTime->format('Y-m-d')
            ];
        }

        $body = $this->request('RPC.common.Api.Po.get', [
            'json' => $payload
        ]);

        return array_map(function ($response) {
            return new Order\PurchaseOrderResult($response);
        }, $body['data']['result']);
    }

    /**
     * @param array $dateTimes
     * @return \Stellion\Primbg\Models\Order\OrderResult[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     * @deprecated User getPurchaseOrders instead
     */
    public function getPlacedOrders(array $dateTimes): array{
        return $this->getPurchaseOrders($dateTimes);
    }

    /**
     * @return \Stellion\Primbg\Models\Delivery\DeliveryType[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getDeliveryTypes(): array
    {
        $body = $this->request('RPC.common.Api.DeliveryTypes.get', [
            'json' => ['get_all' => '1']
        ]);

        return array_map(function ($response) {
            return new DeliveryType($response);
        }, $body['data']['result']);
    }

    /**
     * @return \Stellion\Primbg\Models\PaymentType[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getPaymentTypes(): array
    {
        $body = $this->request('RPC.common.Api.PayTypes.get', [
            'json' => ['get_all' => '1']
        ]);

        return array_map(function ($response) {
            return new PaymentType($response);
        }, $body['data']['result']);
    }

    /**
     * @return PriceList[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getPriceLists(): array
    {
        $body = $this->request('RPC.common.Api.PricesLists.get', [
            'json' => ['get_all' => '1']
        ]);

        return array_map(function ($response) {
            return new PriceList($response);
        }, $body['data']['result']);
    }

    /**
     * @param \Stellion\Primbg\Models\Price $price
     * @return \Stellion\Primbg\Models\Price
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse|\Stellion\Primbg\Exceptions\UnexpectedEntity
     */
    public function findPrice(Price $price): Price
    {
        if (!$price->getPricelistCode()) {
            throw new UnexpectedEntity('Missing price list code for getPrice request');
        }

        $payload = $this->prepareEntityForPayload($price);

        $body = $this->request('RPC.common.Api.Prices.get', [
            'json' => $payload
        ]);

        return new Price($body['data']['result'][0] ?? []);
    }

    /**
     * @param \Stellion\Primbg\Models\Price $price
     * @return \Stellion\Primbg\Models\Price
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function createOrUpdatePrice(Price $price): Price
    {
        try {
            $oldPrice = $this->findPrice($price);
        } catch (ErrorResponseException $e) {
            $oldPrice = new Price();
        }

        if ($oldPrice->getPrice() === $price->getPrice()) {
            return $oldPrice;
        }

        $payload = $this->prepareEntityForPayload($price);

        $body = $this->request('RPC.common.Api.Prices.set', [
            'json' => $payload
        ]);

        return new Price($body['data']['result'][0] ?? []);
    }

    /**
     * @return \Stellion\Primbg\Models\Service[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getServices(): array
    {
        $body = $this->request('RPC.common.Api.Services.get', [
            'json' => ['get_all' => '1']
        ]);

        return array_map(function ($response) {
            return new Service($response);
        }, $body['data']['result']);
    }

    /**
     * Fetch availabilities using a request object.
     *
     * @param \Stellion\Primbg\Requests\AvailabilitiesRequest $request
     * @return \Stellion\Primbg\Models\Availability[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getAvailabilities(AvailabilitiesRequest $request): array
    {
        $payload = ['data' => $request->getPayload()];

        $body = $this->request('RPC.common.Api.Availabilities.get', [
            'json' => $payload
        ]);

        // Extract the result array
        $result = [];
        if (isset($body['data']['result']) && is_array($body['data']['result'])) {
            $result = $body['data']['result'];
        } elseif (isset($body['result']) && is_array($body['result'])) {
            $result = $body['result'];
        } elseif (isset($body['data']) && is_array($body['data'])) {
            $result = $body['data'];
        }

        // Convert to Availability objects
        return array_map(function ($data) {
            return new Availability($data);
        }, $result);
    }

    /**
     * Fetch availabilities for the provided store names (convenience method).
     *
     * @param string[] $storeNames
     * @return \Stellion\Primbg\Models\Availability[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getAvailabilitiesForStores(array $storeNames): array
    {
        $request = new AvailabilitiesRequest($storeNames);
        return $this->getAvailabilities($request);
    }

    /**
     * Debug method to get raw response for availabilities
     *
     * @param string[] $storeNames
     * @return array Raw response from API
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getAvailabilitiesRawResponse(array $storeNames): array
    {
        $request = new AvailabilitiesRequest($storeNames);
        $payload = ['data' => $request->getPayload()];

        $body = $this->request('RPC.common.Api.Availabilities.get', [
            'json' => $payload
        ]);

        return $body;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    public function extractBody(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $body
     *
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     */
    private function catchErrorResponse(array $body)
    {
        if ($body['status'] != 'ok') {
            throw new ErrorResponseException(reset($body['data']));
        }
    }

    /**
     * @param \Stellion\Primbg\Interfaces\Arrayable $entity
     * @return array[]
     */
    private function prepareEntityForPayload(Arrayable $entity): array
    {
        return ['data' => [array_filter($entity->toArray(), function ($item) {
            return $item !== null;
        })]];
    }

    /**
     * @param array $options
     *
     * @return array
     * @return array
     */
    private function prepareOptions(array $options): array
    {
        $default = [
            'query' => ['token' => $this->token->getToken()],
            // @see https://stackoverflow.com/questions/29470839/guzzle-http-request-transforms-from-post-to-get
            'allow_redirects' => ['strict' => true]
        ];

        return array_merge($default, $options);
    }

    /**
     * @param string $endpoint
     * @param array $options
     * @param string $method
     *
     * @return array
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    private function request(string $endpoint, array $options = [], string $method = 'POST'): array
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, $this->prepareOptions($options));
        } catch (GuzzleException $e) {
            throw new HttpBadResponse('There was an error in the request', 0, $e);
        }

        $body = $this->extractBody($response);
        $this->catchErrorResponse($body);

        return $body;
    }
}
