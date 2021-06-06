<?php


namespace App\Offers\Infrastructure\Dto;

use App\Offers\Domain\Offer;
use JMS\Serializer\Annotation as Serializer;

class OfferDto
{
    /**
     * @Serializer\Type("integer")
     * @var int
     */
    private $id;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    private $company_name;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    private $title;

    /**
     * @Serializer\Type("string")
     * @var string
     */
    private $city;

    /**
     * @Serializer\Type("integer")
     * @var int
     */
    private $minSalary;

    /**
     * @Serializer\Type("integer")
     * @var int
     */
    private $maxSalary;

    /**
     * @Serializer\Type("DateTime")
     * @var \DateTime
     */
    private $start;

    /**
     * @Serializer\Type("DateTime")
     * @var \DateTime
     */
    private $end;
    /**
     * @var string
     */
    private $companyName;

    public function __construct(
        int $id,
        string $companyName,
        string $title,
        string $city,
        int $minSalary,
        int $maxSalary,
        \DateTime $start,
        \DateTime $end
    )
    {
        $this->id = $id;
        $this->companyName = $companyName;
        $this->title = $title;
        $this->city = $city;
        $this->minSalary = $minSalary;
        $this->maxSalary = $maxSalary;
        $this->start = $start;
        $this->end = $end;
    }

    public static function createFromOffer(Offer $offer)
    {
        return new self(
            $offer->getId(),
            $offer->getCompanyName(),
            $offer->getTitle(),
            $offer->getCity(),
            $offer->getMinSalary(),
            $offer->getMaxSalary(),
            $offer->getStart(),
            $offer->getEnd(),
        );
    }
}