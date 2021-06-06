<?php


namespace App\Applicants\Infrastructure\Dto;

use App\Applicants\Domain\Applicant;
use JMS\Serializer\Annotation as Serializer;


class ApplicantListDto
{
    /**
     * @Serializer\Type("array")
     * @var array
     */
    private $items;

    /**
     * @Serializer\Type("integer")
     * @var int
     */
    private $totalCount;

    public function __construct(array $applicants)
    {
        $this->items = $applicants;
        $this->totalCount = count($applicants);
    }

    public static function createFromApplicantsArray(array $offers)
    {
        $applicantsDto = [];
        /** @var Applicant $applicant */
        foreach ($offers as $applicant) {
            $applicantsDto[] = ApplicantDto::createFromApplicant($applicant);
        }

        return new self($applicantsDto);
    }
}