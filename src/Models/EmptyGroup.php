<?php

namespace Stellion\Primbg\Models;


use Stellion\Primbg\Interfaces\Arrayable;
use Stellion\Primbg\Traits\ArrayableTrait;

class EmptyGroup extends Group
{

    public function toArray(): array
    {
        return [];
    }
}