<?php


namespace App\Applicants\Application\Service;


use App\Applicants\Domain\Applicant;
use App\Applicants\Infrastructure\Applicants;
use App\Offers\Infrastructure\Repository\Offers;

class Anonymizer implements AnonymizerInterface
{

    /**
     * @var Offers
     */
    private $offers;
    /**
     * @var Applicants
     */
    private $applicants;
    /**
     * @var GeneratorInterface
     */
    private $emailGenerator;
    /**
     * @var GeneratorInterface
     */
    private $nameGenerator;

    public function __construct(Offers $offers, Applicants $applicants, GeneratorInterface $emailGenerator, GeneratorInterface $nameGenerator)
    {
        $this->offers = $offers;
        $this->applicants = $applicants;
        $this->emailGenerator = $emailGenerator;
        $this->nameGenerator = $nameGenerator;
    }

    public function anonymize(): bool
    {
        $offerIds = $this->offers->getOfferIdsToAnonymization();
        $applicants = $this->applicants->getForAnonymization($offerIds);
        /** @var Applicant $applicant */
        foreach ($applicants as $applicant) {
            $fakeEmail = $this->emailGenerator->generate();
            $fakeName = $this->nameGenerator->generate();
            $applicant->anonymize($fakeEmail, $fakeName);
        }
        $this->applicants->flush();
        return true;
    }
}