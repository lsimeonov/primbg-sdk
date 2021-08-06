<?php

namespace Stellion\Primbg\Models;


class EmptyGroup extends Group
{

    public function toArray(): array
    {
        return [];
    }
}
