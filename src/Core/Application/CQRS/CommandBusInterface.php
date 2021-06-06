<?php


namespace App\Core\Application\CQRS;


interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}