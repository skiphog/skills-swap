<?php

namespace System;

/**
 * Class Model
 *
 * @property int $id
 *
 * @package System
 */
abstract class Model
{
    protected $fillable = [];

    protected static $table;

    /**
     * Получает одну запись по id
     *
     * @param int $id
     *
     * @return mixed
     */
    public static function findById($id)
    {
        $sql = /** @lang text */
            'select * from ' . static::$table . ' where id = :id limit 1';
        $sth = db()->prepare($sql);
        $sth->execute(['id' => $id]);

        return $sth->fetchObject(static::class);
    }

    /**
     * @param $name
     * @param $value
     *
     * @return int
     */
    public function __set($name, $value)
    {
        $method = $this->generateMethod('set', $name);

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return $this->{$name} = $value;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->{$name});
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $method = $this->generateMethod('get', $name);

        return method_exists($this, $method) ? $this->$method($name) : null;
    }

    /**
     * Заполняет модель значениями
     *
     * @param array $data
     *
     * @return $this
     */
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (!\in_array($key, $this->fillable, true)) {
                continue;
            }

            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * Сохраняет запись
     *
     * @return bool
     */
    public function save(): bool
    {
        if ($this->isNew()) {
            return $this->insert();
        }

        return $this->update();
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->id);
    }

    /**
     * Добавляет запись
     *
     * @return bool
     */
    protected function insert(): bool
    {
        $vars = get_object_vars($this);
        unset($vars['fillable']);

        $sql = 'insert into ' . static::$table . ' (' . implode(',', array_keys($vars)) . ') 
            values 
        (' . ':' . implode(',:', array_keys($vars)) . ')';

        $db = db();
        if (true === $result = $db->prepare($sql)->execute($vars)) {
            $this->id = $db->lastInsertId();
        }

        return $result;
    }

    /**
     * Обновляет запись
     *
     * @return bool
     */
    protected function update(): bool
    {
        $vars = $attr = get_object_vars($this);
        unset($vars['id'], $vars['fillable'], $attr['fillable']);

        array_walk($vars, function (&$v, $k) {
            $v = $k . '=:' . $k;
        });

        $sql = 'update ' . static::$table . ' set ' . implode(',', $vars) . ' where id=:id';

        return db()->prepare($sql)->execute($attr);
    }

    /**
     * Генерирует метод
     *
     * @param string $particle
     * @param string $data
     *
     * @return string
     */
    protected function generateMethod($particle, $data): string
    {
        $method = array_map('ucfirst', explode('_', $data));

        return $particle . implode('', $method);
    }

    public function setId($value)
    {
        $this->id = (int)$value;
    }

    public function setCreatedAt($value)
    {
        try {
            $this->{'created_at'} = new SkillsDate($value);
        } catch (\Exception $e) {
            $this->{'created_at'} = (string)$value;
        }
    }
}
