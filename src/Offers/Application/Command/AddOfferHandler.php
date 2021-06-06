<?php


namespace App\Offers\Application\Command;


use App\Core\Application\CQRS\CommandHandlerInterface;
use App\Offers\Application\AlreadyExistingOfferException;
use App\Offers\Application\OfferFactory;
use App\Offers\Infrastructure\Repository\Offers;

class AddOfferHandler implements CommandHandlerInterface
{
    /**
     * @var Offers
     */
    private $offers;
    /**
     * @var OfferFactory
     */
    private $offerFactory;

    public function __construct(Offers $offers, OfferFactory $offerFactory)
    {
        $this->offers = $offers;
        $this->offerFactory = $offerFactory;
    }

    public function __invoke(AddOfferCommand $command): void
    {
        if ($this->offers->findByCompanyAndTitle($command->getCompanyName(), $command->getTitle())) {
            throw new AlreadyExistingOfferException();
        }

        $offer = $this->offerFactory->createFromCommand($command);
        $this->offers->add($offer);
    }
}