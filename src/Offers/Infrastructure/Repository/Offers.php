<?php


namespace App\Offers\Infrastructure\Repository;

use App\Offers\Domain\Offer;

interface Offers
{
    public function find(int $id): ?Offer;
    public function findByCompanyAndTitle(string $companyName, string $title): ?Offer;
    public function add(Offer $offer): void;
    public function search(string $title): array;
}