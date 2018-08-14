<?php

namespace System\Http;

use System\Exceptions\RuleException;
use System\Exceptions\MultiException;
use System\Exceptions\ValidateException;
use System\Exceptions\ForbiddenException;

/**
 * Class FormRequest
 *
 * @mixin Request
 * @package App\Component
 */
abstract class FormRequest implements \IteratorAggregate
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var MultiException
     */
    protected $multi;

    /**
     * @var array
     */
    protected static $rules = [];

    /**
     * @var array
     */
    protected static $casting = [];

    /**
     * @var array
     */
    protected static $messages = [];


    protected $validated_fields = [];

    /**
     * FormRequest constructor.
     */
    public function __construct()
    {
        $this->request = request();
        $this->multi = new MultiException();
        $this->process();
    }

    /**
     * @return bool
     */
    public function access()
    {
        return true;
    }

    public function process()
    {
        if (!$this->access()) {
            throw new ForbiddenException('Доступ запрещен');
        }

        $this->run();
    }

    /**
     * @throws MultiException
     */
    protected function run()
    {
        $data = $this->request->all();

        foreach (static::$rules as $key => $rules) {
            $value = isset($data[$key]) ? trim($data[$key]) : null;
            foreach (explode('|', $rules) as $rule) {
                $args = null;
                if (false !== strpos($rule, ':')) {
                    if (substr_count($rule, ':') > 1) {
                        throw new RuleException("Ошибка правила валидации [:] в {$rules}");
                    }

                    [$rule, $args] = explode(':', $rule);
                }

                $validator = 'System\\Validate\\' . ucfirst($rule);

                if (!class_exists($validator)) {
                    throw new RuleException("Ошибка правила валидации [{$rule}] в {$rules}");
                }

                try {
                    $value = (new $validator(static::$messages, $key, $args))($value);
                } catch (ValidateException $e) {
                    $this->multi->add($key, $e);
                    break;
                }
            }
            null !== $value && $this->validated_fields[$key] = $value;
        }

        if ($this->multi->hasErrors()) {
            throw $this->multi;
        }

        //  если что, то здесь casting

        $this->request->setAttributes($this->validated_fields);
    }

    public function trowIfEmpty($value, $field)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("Поле {$field} обязателено к заполнению");
        }
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->request->{$name}(...$arguments);
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->request->all());
    }
}
