<?php


namespace Stellion\Primbg;


use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Stellion\Primbg\Exceptions\ErrorResponseException;
use Stellion\Primbg\Exceptions\Http\HttpBadResponse;
use Stellion\Primbg\Exceptions\UnexpectedEntity;
use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Models\Brand;
use Stellion\Primbg\Models\EmptyGroup;
use Stellion\Primbg\Models\Group;
use Stellion\Primbg\Models\Item;
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
        $this->httpClient = new HttpClient([
            'base_uri' => $endpoint->getEndpoint() . '/api/',
            'timeout' => self::DEFAULT_TIMEOUT,
        ]);
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
        $payload = [
            'data' => [array_filter(Arr::only(
                $group->toArray(),
                [
                    'name',
                    'code',
                    'parent_name',
                    'id',
                    'tax_instance_name'
                ]))]];
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
        $payload = [
            'data' => [array_filter(Arr::only(
                $group->toArray(),
                [
                    'name',
                    'code',
                    'parent_name',
                    'tax_instance_name'
                ]))]];

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

        return new Group($body['data']['results'][0]);
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
     * @return array
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
        return ['data' => [array_filter($entity->toArray())]];
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