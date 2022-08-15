<?php

namespace LibProject\Service;

class Parser
{
    /**
     * @param array $rawParams
     * @return array
     */
    public static function parse(array $rawParams)
    {
        $data = [];
        $commandName = array_shift($rawParams);
        $params = [];
        $arguments = [];

        foreach ($rawParams as $rawParam) {
            preg_match('/^\[(.+)=(.+)]$/', $rawParam, $matches);
            if (!empty($matches)) {
                $paramName = $matches[1];
                $paramValue = $matches[2];

                if ($paramValue[0] === '{') {
                    $paramValue = preg_replace('/[{}]/', '', $paramValue);
                    $paramValueParts = explode(',', $paramValue);
                    $paramValue = $paramValueParts;
                }

                $params[$paramName][] = $paramValue;
                continue;
            }

            $argument = preg_replace('/[{}]/', '', $rawParam);
            $argumentParts = explode(',', $argument);
            foreach ($argumentParts as $argumentPart) {
                $arguments[] = $argumentPart;
            }
        }

        $data['name'] = $commandName;
        $data['options'] = $params;
        $data['arguments'] = $arguments;

        return $data;
    }
}