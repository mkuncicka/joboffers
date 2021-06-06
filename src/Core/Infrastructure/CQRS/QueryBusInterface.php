<?php


namespace App\Core\Infrastructure\CQRS;


interface QueryBusInterface
{
    /** @return mixed */
    public function handle(QueryInterface $query);
}