<?php

namespace zbowl\FoodDataCentralApi\Support;

use ArrayAccess;
use ArrayIterator;
use Carbon\Carbon;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Str;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;
use Serializable;

abstract class Model implements
    ArrayAccess,
    Arrayable,
    Countable,
    IteratorAggregate,
    Jsonable,
    JsonSerializable,
    Serializable
{
    protected $casts = [];

    public function __construct(
        protected array $attributes = [],
    ) {
        $this->fill($attributes);
    }

    public function __call($method, $arguments)
    {
        // Call existing method
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $arguments);
        }

        /*// Look to see if the property has a relationship to call
        if ($this->client && ($this->{$method}->_info ?? null)) {
            foreach ($this->{$method}['_info'] as $k => $v) {
                if (Str::startsWith($v, $this->client->getUrl())) {
                    // Cache so that other request will not trigger additional calls
                    $this->setAttribute($method, $this->client->get($v));

                    return $this->{$method};
                }
            }
        }*/

        trigger_error('Call to undefined method ' . __CLASS__ . '::' . $method . '()', E_USER_ERROR);
    }

    public function __debugInfo(): ?array
    {
        return $this->attributes;
    }

    /**
     * Allow for dynamic property access
     *
     * @param  mixed  $attribute
     *
     * @return mixed
     */
    public function __get(mixed $attribute): mixed
    {
        return $this->getAttribute($attribute);
    }

    public function __isset($attribute): bool
    {
        return array_key_exists($attribute, $this->attributes);
    }

    public function __set($attribute, $value): void
    {
        $this->setAttribute($attribute, $value);
    }

    public function __ToString(): string
    {
        return $this->toJson();
    }

    public function __unset($attribute): void
    {
        unset($this->attributes[$attribute]);
    }

    public function castTo($value, $cast)
    {
        $cast_types = [
            'array',
            'bool',
            'boolean',
            'double',
            'float',
            'int',
            'integer',
            'null',
            'object',
            'string',
        ];

        return match (true) {
            is_null($value), is_object($value) => $value,
            Carbon::class === $cast => Carbon::parse($value),
            class_exists($cast) => new $cast((array) $value),
            strcasecmp('json', $cast) == 0 => json_decode($value, true),
            strcasecmp('collection', $cast) == 0 => new Collection((array) $value),
            in_array($cast, ['bool', 'boolean']) => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            !in_array($cast,
                $cast_types) => throw new InvalidArgumentException(sprintf("Attributes cannot be casted to [%s] type.",
                $cast)),
            settype($value, $cast) => $value,
        };
    }

    public function count(): int
    {
        return count($this->attributes);
    }

    public function fill(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    public function hasGetter($attribute): bool
    {
        return method_exists($this, $this->getterMethodName($attribute));
    }

    public function hasSetter($attribute): bool
    {
        return method_exists($this, $this->setterMethodName($attribute));
    }

    public function hasCast($attribute): bool
    {
        $cast = $this->getCasts($attribute);

        return !empty($cast) && is_string($cast);
    }

    public function getAttribute($attribute)
    {
        return match (true) {
            !$attribute => null,
            $this->hasGetter($attribute) => $this->{$this->getterMethodName($attribute)}(),
            isset($this->{$attribute}) => $this->attributes[$attribute],
            default => trigger_error('Undefined property:' . __CLASS__ . '::$' . $attribute),
        };
    }

    public function getCasts(mixed $attribute = null): mixed
    {
        return match (true) {
            array_key_exists($attribute, $this->casts) => $this->casts[$attribute],
            default => $this->casts,
        };
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->attributes);
    }

    public function getterMethodName(string $attribute): string
    {
        return 'get' . Str::studly($attribute) . 'Attribute';
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function offsetExists($attribute): bool
    {
        return isset($this->{$attribute});
    }

    public function offsetGet($attribute): mixed
    {
        return $this->{$attribute};
    }

    public function offsetSet($attribute, $value): void
    {
        $this->{$attribute} = $value;
    }

    public function offsetUnset($attribute)
    {
        unset($this->{$attribute});
    }

    public function serialize(): ?string
    {
        return serialize($this->attributes);
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttribute($attribute, $value): static
    {

        $this->attributes[$attribute] = match (true) {
            $this->hasSetter($attribute) => $this->{$this->setterMethodName($attribute)}($value),
            $this->hasCast($attribute) => $this->castTo($value, $this->getCasts($attribute)),
            default => $value,
        };

        return $this;
    }

    protected function setterMethodName($attribute): string
    {
        return 'set' . Str::studly($attribute) . 'Attribute';
    }

    public function toArray(): array
    {
        // TODO: Need to actually roll through the attributes & make sure that nested objects are converted
        return $this->attributes;
    }

    public function toJson($options = 0): bool|string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function unserialize($serialized)
    {
        $this->attributes = unserialize($serialized);
    }

}
