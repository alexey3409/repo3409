<?php

namespace LibProject\Service;

use LibProject\Exceptions\CliException;
use LibProject\Model\Command;
use LibProject\Model\CommandRepository;
use LibProject\Service\BeautifulOutput;

class CommandRegister
{
    /**
     * @var \LibProject\Model\CommandRepository
     */
    protected CommandRepository $commandRepository;

    /**
     * CommandRegister constructor.
     * @param \LibProject\Model\CommandRepository $commandRepository
     */
    public function __construct(
        CommandRepository $commandRepository
    ) {
        $this->commandRepository = $commandRepository;
    }

    /**
     * @param Command $command
     * @throws CliException
     */
    public function register(Command $command)
    {
        if ($this->commandRepository->get($command->getName())) {
            throw new CliException('Command with name "' . $command->getName() . '" has already been added earlier!');
        }

        $this->commandRepository->save($command);

        BeautifulOutput::output($command);
    }
}