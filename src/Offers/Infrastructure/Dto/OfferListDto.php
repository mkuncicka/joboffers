<?php


namespace App\Offers\Infrastructure\Dto;

use App\Offers\Domain\Offer;
use JMS\Serializer\Annotation as Serializer;

class OfferListDto
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

    public function __construct(array $offers)
    {
        $this->items = $offers;
        $this->totalCount = count($offers);
    }

    public static function createFromOffersArray(array $offers)
    {
        $offersDto = [];
        /** @var Offer $offer */
        foreach ($offers as $offer) {
            $offersDto[] = OfferDto::createFromOffer($offer);
        }

        return new self($offersDto);
    }
}