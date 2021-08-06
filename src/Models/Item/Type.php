<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Item;


use Stellion\Primbg\Exceptions\Models\Item\InvalidType;

class Type
{
    const TYPE_ARTIKUL = 'articul';
    const TYPE_MATERIAL = 'material';
    const TYPE_PRODUCT = 'product';
    const TYPE_BOM = 'bom';
    const TYPE_ITEM = 'item';

    private $types = [
        self::TYPE_ARTIKUL,
        self::TYPE_MATERIAL,
        self::TYPE_PRODUCT,
        self::TYPE_BOM,
        self::TYPE_ITEM
    ];

    /**
     * @var string
     */
    private $type;

    public function __construct(string $value)
    {
        if (!in_array($value, $this->types)) {
            throw new InvalidType($value);
        }

        $this->type = $value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
