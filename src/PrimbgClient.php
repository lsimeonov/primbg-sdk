<?php


namespace Stellion\Primbg;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Stellion\Primbg\Exceptions\ErrorResponseException;
use Stellion\Primbg\Exceptions\Http\HttpBadResponse;
use Stellion\Primbg\Exceptions\UnexpectedEntity;
use Stellion\Primbg\Models\EmptyGroup;
use Stellion\Primbg\Models\Group;
use Stellion\Primbg\ValueObjects\Endpoint;
use Stellion\Primbg\ValueObjects\Token;

/**
 * Class PrimbgClient
 * @package Stellion\Primbg
 */
class PrimbgClient
{
    const DEFAULT_TIMEOUT = 60;

    const DEFAULT_TAX_INSTANCE_NAME = 'Стандартна';

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
        $this->httpClient = new Client([
                                           'base_uri' => $endpoint->getEndpoint() . '/api/',
                                           'timeout' => self::DEFAULT_TIMEOUT,
                                       ]);
    }

    /**
     * @param int $limit
     * @param int $offset
     *
     * @return Group[]
     * @throws \Stellion\Primbg\Exceptions\ErrorResponseException
     * @throws \Stellion\Primbg\Exceptions\Http\HttpBadResponse
     */
    public function getGroups(int $offset = 0, int $limit = 200): array
    {
        $body = $this->request('RPC.common.RestApi.getGroups', [
            'json' => [
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);

        return array_map(function ($item) {
            return new Group($item);
        }, $body['data']);
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
        $payload = array_filter(Arr::only(
            $group->toArray(),
            [
                'name',
                'code',
                'parent_name',
                'id',
                'tax_instance_name'
            ]));
        $body = $this->request('RPC.common.RestApi.editGroup', [
            'json' => $payload,
        ]);

        $newGroup = clone $group;
        $newGroup->setId($body['data']['group_id']);

        return $newGroup;

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
        $payload = array_filter(Arr::only(
            $group->toArray(),
            [
                'name',
                'code',
                'parent_name',
                'tax_instance_name'
            ]));

        $body = $this->request('RPC.common.RestApi.createGroup', [
            'json' => $payload,
        ]);

        $newGroup = clone $group;
        $newGroup->setId($body['data']['group_id']);

        return $newGroup;
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
     * @param array $options
     *
     * @return array
     * @return array
     */
    private function prepareOptions(array $options): array
    {
        $default = ['query' => ['token' => $this->token->getToken()]];

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