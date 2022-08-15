<?php

namespace LibProject\Service;

use LibProject\Model\Command;

class BeautifulOutput
{
    /**
     * @param \LibProject\Model\Command $command
     */
    public static function output(Command $command)
    {
        echo "---------------------------------------------------\n";
        echo "\nCalled command: " . $command->getName() . "\n\n";

        echo "Arguments:\n";
        foreach ($command->getArguments() as $argument) {
            echo "\t-" . $argument . "\n";
        }

        echo "Options:\n";
        foreach ($command->getOptions() as $optionName => $optionValues) {
            echo "\t-" . $optionName . "\n";
            foreach ($optionValues as $optionValue) {
                echo "\t\t-" . $optionValue . "\n";
            }
        }
    }
}