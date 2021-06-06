<?php


namespace App\Applicants\Infrastructure\Query;


use App\Core\Infrastructure\CQRS\QueryInterface;

class ShowApplicantsQuery implements QueryInterface
{
    /**
     * @var int
     */
    private $offer_id;

    public function __construct(int $offerId)
    {
        $this->offer_id = $offerId;
    }

    /**
     * @return int
     */
    public function getOfferId(): int
    {
        return $this->offer_id;
    }

}