<?php

namespace App\DTO\Common;


use Illuminate\Support\Str;

class BaseDTO
{
    static function fillAttributes(iterable $properties): static
    {
        static::prepareProperties($properties);
        static::clearNotReflectionParameters($properties);
        return new static(...$properties);
    }

    private static function prepareProperties(&$properties): void
    {

    }

    public function toArray(?\Closure $keyCreateCallback = null): array
    {
        $result = [];

        foreach ($this->getAttributesList() as $attribute) {
            if ($this->$attribute instanceof BaseDTO) {
                $value = $this->$attribute->toArray($keyCreateCallback);
            } else {
                $value = $this->$attribute;
            }

            $key = $keyCreateCallback ? $keyCreateCallback($attribute) : $attribute;
            $result[$key] = $value;
        }

        return $result;
    }

    public function toArrayAsSnakeCase(): array
    {
        return $this->toArray(function ($key) {
            return Str::snake($key);
        });
    }

    public static function clearNotReflectionParameters(&$parameters): void
    {
        $reflectionClass = new \ReflectionClass(static::class);
        $reflectionParameters = array_column($reflectionClass->getConstructor()->getParameters(), 'name', 'name');

        $newParameters = [];
        foreach ($reflectionParameters as $keyReflectionParameter => $reflectionParameter) {
            if (array_key_exists($keyReflectionParameter, $parameters)) {
                $newParameters[$keyReflectionParameter] = $parameters[$keyReflectionParameter];
            }
        }

        $parameters = $newParameters;
    }

    protected function getAttributesList(): array
    {
        return array_keys(get_object_vars($this));
    }
}
