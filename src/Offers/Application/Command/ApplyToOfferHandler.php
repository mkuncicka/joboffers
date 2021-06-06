<?php


namespace App\Offers\Application\Command;


use App\Applicants\Domain\Applicant;
use App\Applicants\Infrastructure\Applicants;
use App\Core\Application\CQRS\CommandHandlerInterface;
use App\Offers\Application\OfferNotFoundException;
use App\Offers\Domain\Offer;
use App\Offers\Infrastructure\Repository\Offers;

class ApplyToOfferHandler implements CommandHandlerInterface
{
    /**
     * @var Offers
     */
    private $offers;
    /**
     * @var Applicants
     */
    private $applicants;


    public function __construct(Offers $offers, Applicants $applicants)
    {
        $this->offers = $offers;
        $this->applicants = $applicants;
    }

    public function __invoke(ApplyToOfferCommand $command): void
    {
        /** @var Offer $offer */
        $offer = $this->offers->find($command->getOfferId());
        if (!$offer) {
            throw new OfferNotFoundException();
        }

        $applicant = $this->applicants->find($command->getEmail(), $command->getOfferId());

        if (!$applicant) {
            $applicant = new Applicant($command->getEmail(), $command->getName(), $offer);
            $this->applicants->add($applicant);
        }

    }
}