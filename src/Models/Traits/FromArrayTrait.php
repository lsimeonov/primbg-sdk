<?php
declare(strict_types=1);

namespace Stellion\Primbg\Models\Traits;


use Illuminate\Support\Str;

trait FromArrayTrait
{
    /**
     * @param array $array
     */
    protected function fromArray(array $array = [])
    {
        foreach ($array as $k => $v) {
            $setter = 'set' . ucfirst(Str::camel($k));
            if($v === '__NULL__'){
                $v = null;
            }
            if (method_exists($this, $setter)) {
                $value = $v;
                if (isset($this->objectConvertMap[$k])) {
                    $value = new $this->objectConvertMap[$k]($v);
                }
                if (isset($this->castMap[$k])) {
                    settype($value, $this->castMap[$k]);
                }

                $this->$setter($value);
            }
        }
    }
}
