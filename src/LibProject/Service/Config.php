<?php

namespace LibProject\Service;

class Config
{
    /**
     * @return string
     */
    public static function getDbPath()
    {
        return __DIR__ . '/../../../db/';
    }
}