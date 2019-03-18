<?php

namespace Savin\PCNTL;

use RuntimeException;

class PCNTL
{
    private $lastSigno;

    private $lastMessage = '';

    protected $handlers;

    public function create(array $signals, callable $function = null)
    {
        $class = get_class($this);
        return (new $class)->init($signals, $function);
    }

    protected function init(array $signals, callable $function = null)
    {
        foreach ($signals as $signal) {

            $this->handlers[$signal] = $function;
        }

        return $this;
    }

    public function dispatch()
    {
        if (!extension_loaded('pcntl')) {
            throw new RuntimeException('The PCNTL extension is not loaded');
        }

        pcntl_signal_dispatch();

        foreach ($this->handlers as $signo => $handler) {

            $callable = function ($signo) use ($handler) {
                $this->handler($signo);
                if (is_callable($handler)) $handler($signo);
            };

            pcntl_signal($signo, $callable, false);
        }

        return $this;
    }

    public function getMessage(int $signo)
    {
        $messages = [
            SIGINT => trans('savin::pcntl.sigint'),
            SIGTERM => trans('savin::pcntl.sigterm'),
            SIGHUP => trans('savin::pcntl.sighup'),
            SIGUSR1 => trans('savin::pcntl.sigusr1'),
            SIGSTOP => trans('savin::pcntl.sigstop'),
        ];

        return data_get($messages, $signo, trans('savin::pcntl.other'));
    }

    protected function handler($signo)
    {
        $this->lastSigno = $signo;
        $this->lastMessage = PHP_EOL . $this->getMessage($signo);
    }

    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    public function getLastSigno()
    {
        return $this->lastSigno;
    }
}