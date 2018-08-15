<?php

namespace System\Validate;

abstract class Validator
{
    /**
     * @var array
     */
    protected $messages;

    /**
     * @var string
     */
    protected $field;

    /**
     * @var string|null
     */
    protected $params;

    /**
     * Required constructor.
     *
     * @param array       $messages
     * @param string      $field
     * @param string|null $params
     */
    public function __construct($messages, $field, $params = null)
    {
        $this->messages = $messages;
        $this->field = $field;
        $this->params = $params;
    }

    public function process($value)
    {
        if (null === $value || '' === $value) {
            return '';
        }

        return $this->validate($value);
    }

    abstract public function validate($value);

    /**
     * @param string $text
     *
     * @return string
     */
    protected function getMessage($text)
    {
        $field = $this->field . '.' . lcfirst((new \ReflectionClass($this))->getShortName());

        return $this->messages[$field] ?? $text;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function __invoke($value)
    {
        return $this->process($value);
    }
}
