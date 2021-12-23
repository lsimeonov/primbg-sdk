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
                    if (is_array($value) && is_array(reset($value))) {
                        $value = array_filter(array_map(function ($item) use ($k) {
                            $newObject = new $this->objectConvertMap[$k]($item);
                            if (method_exists($newObject, 'getId')) {
                                if (!$newObject->getId()) {
                                    return null;
                                }
                            }
                            return $newObject;
                        }, $value));
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
}
