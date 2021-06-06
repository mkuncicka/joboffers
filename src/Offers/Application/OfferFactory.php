<?php


namespace App\Offers\Application;

use App\Offers\Application\Command\AddOfferCommand;
use App\Offers\Domain\Offer;

class OfferFactory
{
    public function createFromCommand(AddOfferCommand $command)
    {
        return new Offer(
            $command->getCompanyName(),
            $command->getTitle(),
            $command->getCity(),
            $command->getMinSalary(),
            $command->getMaxSalary(),
            $command->getStart()
        );
    }
}