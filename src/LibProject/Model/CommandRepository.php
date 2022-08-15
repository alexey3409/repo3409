<?php

namespace LibProject\Model;

use LibProject\Model\Command;
use LibProject\Model\Resource\Command as CommandResource;

class CommandRepository
{
    /**
     * @var \LibProject\Model\Resource\Command
     */
    protected CommandResource $resource;

    /**
     * CommandRepository constructor.
     */
    public function __construct()
    {
        $this->resource = new CommandResource();
    }

    /**
     * @param \LibProject\Model\Command $command
     * @return $this
     */
    public function save(Command $command): self
    {
        $this->resource->save($command);

        return $this;
    }

    /**
     * @param string $commandName
     * @return \LibProject\Model\Command|null
     */
    public function get(string $commandName): ?Command
    {
        $command = new Command();

        $commandData = $this->resource->load($commandName);

        if (!$commandData) {
            return null;
        }

        $command->setData($commandData);

        return $command;
    }

    /**
     * @param string $commandName
     * @return $this
     */
    public function delete(string $commandName): self
    {
        $this->resource->delete($commandName);

        return $this;
    }

    /**
     * @return array
     */
    public function loadAll(): array
    {
        return $this->resource->loadAll();
    }
}