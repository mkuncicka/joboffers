<?php


namespace App\Applicants\Infrastructure\Dto;


use App\Applicants\Domain\Applicant;

class ApplicantDto
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;


    /**
     * @param string $email
     * @param string $name
     */
    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public static function createFromApplicant(Applicant $applicant)
    {
        return new self($applicant->getEmail(), $applicant->getName());
    }
}