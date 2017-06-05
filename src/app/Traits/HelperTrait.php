<?php

namespace app\Traits;

use app\Constants\Command;

/**
 * Trait HelperTrait
 * @package app\Traits
 */
trait HelperTrait
{
    /**
     * @return array
     */
    protected function help()
    {
        return [
            [
                'command' => Command::REQUEST,
                'description' => 'Show request do in service'
            ],
            [
                'command' => Command::NO_CALL,
                'description' => 'No call web service, by default always make it'
            ],
            [
                'command' => Command::LINK,
                'description' => 'Creating a link in response'
            ],
            [
                'command' => Command::SAVE,
                'description' => 'Create or Update requestId'
            ],
            [
                'command' => Command::REDIRECT,
                'description' => 'Redirection to application, only when exist property redirectTo in response'
            ],
            [
                'command' => Command::SOAP,
                'description' => 'Do request with SOAP method'
            ],
            [
                'command' => Command::REST,
                'description' => 'Do request with RestFul method, this value is by default'
            ],
        ];
    }

    /**
     * @return array
     */
    protected function commandHelp()
    {
        return $this->pluck('command', $this->help());
    }

    /**
     * @return string
     */
    protected function showHelp()
    {
        $help = '';
        array_map(function ($item) use (&$help) {
            $help .= sprintf("- %s:\t\t%s", $item['command'], $item['description']) . breakLine();
        }, $this->help());

        return $help;
    }

    /**
     * @param $key
     * @param array $array
     * @return array
     */
    protected function pluck($key, array $array = [])
    {
        return array_map(function ($item) use ($key) {
            return $item[$key];
        }, $array);
    }

    /**
     * @param $xml
     * @return string
     */
    protected function formatXml($xml)
    {
        $lines = explode("\n", str_replace('><', ">\n<", $xml));
        $formatXml = '';
        $spaces = 0;
        $isInitXML = true;
        $isElementOpen = [];
        $addContent = false;
        $tagElement = null;
        $lastCallWasCloseElement = true;

        foreach ($lines as $line) {
            preg_match('#>[\s\S]*?<#', $line, $matches);
            $hasContent = count($matches) > 0;
            $isOpenTag = substr($line, 0, 2) != '</';
            $isCloseTag = strpos($line, '</') !== false;

            if ($isInitXML) {
                $isInitXML = false;
            } elseif (!isset($isElementOpen[$line]) && $isOpenTag && !$hasContent) {
                $tagElement = $line;
                $isElementOpen[$tagElement] = $tagElement;
                if (!$lastCallWasCloseElement && !$addContent) {
                    $spaces += 4;
                } elseif ($addContent) {
                    $addContent = false;
                }
                $lastCallWasCloseElement = false;
            } elseif (isset($isElementOpen[$tagElement]) && $hasContent && !$addContent && !$lastCallWasCloseElement) {
                $spaces += 4;
                $addContent = true;
            } elseif (isset($isElementOpen[$tagElement]) && $isCloseTag && !$hasContent) {
                $spaces -= 4;
                unset($isElementOpen[$tagElement]);
                $tagElement = end($isElementOpen);
                $lastCallWasCloseElement = true;
                $addContent = false;
            } elseif ($addContent) {
                $spaces -= 0;
            }

            $formatXml .= str_repeat(' ', $spaces) . $line . breakLine();
        }

        return $formatXml;
    }
}
