<?php


namespace App\Applicants\Application\Service;


interface AnonymizerInterface
{
    public function anonymize(): bool;
}