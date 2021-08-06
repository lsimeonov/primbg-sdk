<?php
declare(strict_types=1);

namespace Stellion\Primbg\Exceptions\Models\Item;


use Stellion\Primbg\Exceptions\PrimbgClientException;
use Throwable;

class InvalidStatus extends PrimbgClientException
{
    /**
     * InvalidStatus constructor.
     * @param $status
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($status, $code = 0, Throwable $previous = null)
    {
        $message = sprintf("Incorrect status: %s", $status);
        parent::__construct($message, $code, $previous);
    }
}
