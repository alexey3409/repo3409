<?php

namespace LibProject\Model;

abstract class AbstractModel
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getData(string $key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return null;
    }

    /**
     * @param array|string $key
     * @param null $value
     * @return $this
     */
    public function setData($key, $value = null)
    {
        if ($key === (array)$key) {
            $this->data = $key;
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }
}