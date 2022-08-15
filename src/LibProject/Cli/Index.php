<?php

namespace LibProject\Cli;

use LibProject\Exceptions\CliException;
use LibProject\Service\Parser;
use LibProject\Service\Help;
use LibProject\Model\Command;
use LibProject\Model\CommandRepository;
use LibProject\Service\CommandRegister;
use LibProject\Service\BeautifulOutput;

class Index
{
    protected const HELP_COMMAND = 'help';

    /** @var array */
    protected $rawParams;

    /**
     * @var \LibProject\Model\CommandRepository
     */
    protected $commandRepository;

    /**
     * @var \LibProject\Service\Help
     */
    protected Help $help;

    /**
     * @var \LibProject\Service\CommandRegister
     */
    protected CommandRegister $commandRegister;

    /**
     * Index constructor.
     * @param array $rawParams
     */
    public function __construct(
        array $rawParams
    ) {
        $this->rawParams = $rawParams;
        $this->init();
    }

    protected function init()
    {
        $this->commandRepository = new CommandRepository();
        $this->help = new Help($this->commandRepository);
        $this->commandRegister = new CommandRegister($this->commandRepository);
    }

    /**
     * @return void
     * @throws CliException
     */
    public function execute()
    {
        $commandData = Parser::parse($this->rawParams);
        $command = new Command();
        $command->setData($commandData);

        if (empty($command->getName())) {
            $this->help->execute();
            return;
        }

        $arguments = $command->getArguments();
        if (count($arguments) === 1 && $arguments[0] === self::HELP_COMMAND && empty($command->getOptions())) {
            $commandName = $command->getName();
            $command = $this->commandRepository->get($commandName);

            if (!$command) {
                throw new CliException('Command with name "' . $commandName . '" not found!');
            }

            BeautifulOutput::output($command);
            return;
        }

        $this->commandRegister->register($command);
    }
}