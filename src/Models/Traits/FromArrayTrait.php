<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Traits;


use Illuminate\Support\Str;
use Stellion\Primbg\Interfaces\AllowNullIdInterface;

trait FromArrayTrait
{
    /**
     * @param array $array
     */
    protected function fromArray(array $array = [])
    {
        foreach ($array as $k => $v) {
            $setter = 'set' . ucfirst(Str::camel($k));
            if ($v === '__NULL__') {
                $v = null;
            }
            if (method_exists($this, $setter)) {
                $value = $v;
                if (isset($this->objectConvertMap[$k])) {
                    // Value is array of objects to be converted
                    if (is_array($value) && $this->isArrayOfObjects($value)) {
                        $value = array_filter(array_map(function ($item) use ($k) {
                            $newObject = new $this->objectConvertMap[$k]($item);
                            if (method_exists($newObject, 'getId')) {
                                if (!$newObject->getId()) {
                                    return null;
                                }
                            }
                            return $newObject;
                        }, $value));
                        // Value is array of objects with scalar values and this is allowed
                    } elseif (isset($this->allowFlatArray) && in_array($k, $this->allowFlatArray) && is_array($value)) {
                        $value = array_map(function ($item) use ($k) {
                            return new $this->objectConvertMap[$k]($item);
                        }, $value);
                        // Value is a single object
                    } else {
                        $value = new $this->objectConvertMap[$k]($v ?? []);
                        if (!$value instanceof AllowNullIdInterface && method_exists($value, 'getId')) {
                            if (!$value->getId()) {
                                continue;
                            }
                        }
                    }
                }
                if (isset($this->castMap[$k])) {
                    settype($value, $this->castMap[$k]);
                }

                $this->$setter($value);
            }
        }
    }

    private function isArrayOfObjects(array $arr): bool
    {
        if (count($arr) == 0) {
            return false;
        }

        foreach ($arr as $item) {
            if (!is_array($item)) {
                return false;
            }
        }
        return true;
    }
}
