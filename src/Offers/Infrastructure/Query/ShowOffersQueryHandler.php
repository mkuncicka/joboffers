<?php


namespace App\Offers\Infrastructure\Query;

use App\Core\Infrastructure\CQRS\QueryHandlerInterface;
use App\Offers\Infrastructure\Dto\OfferListDto;
use App\Offers\Infrastructure\Repository\Offers;
use JMS\Serializer\SerializerInterface;

class ShowOffersQueryHandler implements QueryHandlerInterface
{
    /**
     * @var Offers
     */
    private $offers;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(Offers $offers, SerializerInterface $serializer)
    {
        $this->offers = $offers;
        $this->serializer = $serializer;
    }

    public function __invoke(ShowOffersQuery $query): string
    {
        $offers = $this->offers->search($query->getTitle());
        return $this->serializer->serialize(OfferListDto::createFromOffersArray($offers), 'json');
    }
}