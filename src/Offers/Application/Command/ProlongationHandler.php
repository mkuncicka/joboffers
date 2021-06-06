<?php


namespace App\Offers\Application\Command;


use App\Core\Application\CQRS\CommandHandlerInterface;
use App\Offers\Application\OfferNotFoundException;
use App\Offers\Domain\Offer;
use App\Offers\Infrastructure\Repository\Offers;

class ProlongationHandler implements CommandHandlerInterface
{
    /**
     * @var Offers
     */
    private $offers;


    public function __construct(Offers $offers)
    {
        $this->offers = $offers;
    }

    public function __invoke(ProlongationCommand $command): void
    {
        /** @var Offer $offer */
        $offer = $this->offers->find($command->getOfferId());
        if (!$offer) {
            throw new OfferNotFoundException();
        }
        if ($offer->hasEnded()) {
            $offer->prolongation();
        }
    }
}