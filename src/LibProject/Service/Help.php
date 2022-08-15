<?php

namespace LibProject\Service;

use LibProject\Model\CommandRepository;
use LibProject\Service\BeautifulOutput;
use LibProject\Model\Command;

class Help
{
    /**
     * @var \LibProject\Model\CommandRepository
     */
    protected $commandRepository;

    /**
     * Help constructor.
     * @param CommandRepository $commandRepository
     */
    public function __construct(
        CommandRepository $commandRepository
    ) {
        $this->commandRepository = $commandRepository;
    }

    public function execute()
    {
        $command = new Command();

        $commandsData = $this->commandRepository->loadAll();
        foreach ($commandsData as $commandData) {
            $command->setData($commandData);
            BeautifulOutput::output($command);
        }
    }
}