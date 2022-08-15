<?php

namespace LibProject\Model\Resource;

use LibProject\Model\Command;
use LibProject\Service\Config;
use LibProject\Exceptions\CliException;

abstract class AbstractDb
{
    /**
     * @var string
     */
    protected string $mainTable;

    /**
     * @var string
     */
    protected string $idFieldName;

    /**
     * @var string
     */
    protected string $dbPath;

    protected $items;

    /**
     * AbstractDb constructor.
     */
    public function __construct()
    {
        $this->loadData();
    }

    /**
     * @param string $mainTable
     * @param string $idFieldName
     */
    protected function init(string $mainTable, string $idFieldName)
    {
        $this->setMainTable($mainTable, $idFieldName);
    }

    /**
     * @param string $mainTable
     * @param string $idFieldName
     */
    protected function setMainTable(string $mainTable, string $idFieldName)
    {
        $this->mainTable = $mainTable;
        $this->idFieldName = $idFieldName;
    }

    /**
     * @return string
     */
    protected function getMainTable(): string
    {
        return $this->mainTable;
    }

    protected function loadData()
    {
        $data = $this->items;

        if ($data) {
            return;
        }

        $this->dbPath = Config::getDbPath();
        $rawData = file_get_contents($this->dbPath . $this->getMainTable());

        if (empty($rawData)) {
            return;
        }

        $rows = explode("\n", $rawData);

        $items = [];

        foreach ($rows as $row) {
            if (empty($row)) {
                continue;
            }

            $item = json_decode($row, true);
            $idFieldValue = $item[$this->idFieldName];
            $items[$idFieldValue] = $item;
        }

        $this->items = $items;

        return;
    }

    /**
     * @param \LibProject\Model\Command $command
     * @return $this
     */
    public function save(Command $command): self
    {
        file_put_contents($this->dbPath . $this->getMainTable(),$command->__toString() . "\n",FILE_APPEND);

        return $this;
    }

    /**
     * @param string $commandName
     * @return array|null
     */
    public function load(string $commandName): ?array
    {
        $items = $this->items;

        if (isset($items[$commandName])) {
            return $items[$commandName];
        }

        return null;
    }

    /**
     * @param string $commandName
     * @return $this
     */
    public function delete(string $commandName): self
    {
        $items = $this->items;

        if (isset($items[$commandName])) {
            unset($items[$commandName]);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function loadAll(): array
    {
        return $this->items;
    }
}