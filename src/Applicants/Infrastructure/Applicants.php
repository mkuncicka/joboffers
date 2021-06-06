<?php


namespace App\Applicants\Infrastructure;


use App\Applicants\Domain\Applicant;

interface Applicants
{
    public function find(string $email, int $offerId): ?Applicant;
    public function findForOffer(int $offerId): array;
    public function add(Applicant $applicant): void;
    public function getForAnonymization(array $offerIds): array;
    public function flush();
}