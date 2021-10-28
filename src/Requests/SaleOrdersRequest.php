<?php
declare(strict_types=1);

namespace Stellion\Primbg\Requests;

use Stellion\Primbg\Models\Order;

class SaleOrdersRequest implements RequestInterface
{


    private ?int $id;
    private ?string $number;

    /**
     * @param int|null $id
     * @param string|null $number
     */
    public function __construct(Order ...$orders)
    {
        $this->orders = $orders;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        $mapped = array_map(fn(Order $order) => array_filter(['id' => $order->getId(), 'num' => $order->getNum()],
            fn($v) => !empty($v)), $this->orders);

        return array_filter(
            $mapped,
            fn($a) => isset($a['id']) || isset($a['num'])
        );
    }
}