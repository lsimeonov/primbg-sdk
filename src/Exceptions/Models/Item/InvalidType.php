<?php
declare(strict_types=1);

namespace Stellion\Primbg\Exceptions\Models\Item;


use Stellion\Primbg\Exceptions\PrimbgClientException;
use Throwable;

class InvalidType extends PrimbgClientException
{
    /**
     * InvalidType constructor.
     * @param string $type
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $type, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('Incorrect item type %s', $type), $code, $previous);
    }
}
