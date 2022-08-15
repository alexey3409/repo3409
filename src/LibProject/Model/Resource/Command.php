<?php

namespace LibProject\Model\Resource;

class Command extends AbstractDb
{
    public const MAIN_TABLE = 'ComandsTable.csv';
    public const ID_FIELD_NAME = 'name';

    /**
     * Command constructor.
     */
    public function __construct()
    {
        $this->init(self::MAIN_TABLE, self::ID_FIELD_NAME);

        parent::__construct();
    }
}