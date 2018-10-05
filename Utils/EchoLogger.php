<?php

namespace Megawilddaddy\Linode\Utils;

class EchoLogger implements \Psr\Log\LoggerInterface
{
    public function emergency($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function alert($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function critical($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function error($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function warning($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function notice($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function info($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function debug($message, array $context = array())
    {
        echo "\n $message \n";
    }

    public function log($level, $message, array $context = array())
    {
        echo "\n $message \n";
    }
}