<?php


namespace App\Applicants\Infrastructure\Query;

use App\Applicants\Infrastructure\Applicants;
use App\Applicants\Infrastructure\Dto\ApplicantListDto;
use App\Core\Infrastructure\CQRS\QueryHandlerInterface;
use JMS\Serializer\SerializerInterface;

class ShowApplicantsQueryHandler implements QueryHandlerInterface
{
    /**
     * @var Applicants
     */
    private $applicants;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(Applicants $applicants, SerializerInterface $serializer)
    {
        $this->applicants = $applicants;
        $this->serializer = $serializer;
    }

    public function __invoke(ShowApplicantsQuery $query): string
    {
        $applicants = $this->applicants->findForOffer($query->getOfferId());
        return $this->serializer->serialize(ApplicantListDto::createFromApplicantsArray($applicants), 'json');
    }
}