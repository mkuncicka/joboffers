<?php


namespace App\Offers\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Offer
 * @Entity
 * @ORM\Table(name="Offer", uniqueConstraints={
 *        @UniqueConstraint(name="offervideo_unique",
 *            columns={"company_name", "title"})
 * })
 */
class Offer
{
    PRIVATE CONST EMISSION_TIME = 30;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $company_name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $minSalary;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $maxSalary;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $end;

    public function __construct(
        string $companyName,
        string $title,
        string $city,
        int $minSalary,
        int $maxSalary,
        \DateTime $start
    ) {
        $this->company_name = $companyName;
        $this->title = $title;
        $this->city = $city;
        $this->minSalary = $minSalary;
        $this->maxSalary = $maxSalary;
        $this->start = $start;

        $end = clone $start;
        $this->end = $end->add(new \DateInterval('P' . self::EMISSION_TIME . 'D'));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->company_name;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return int
     */
    public function getMinSalary(): int
    {
        return $this->minSalary;
    }

    /**
     * @return int
     */
    public function getMaxSalary(): int
    {
        return $this->maxSalary;
    }

    /**
     * @return \DateTime
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    public function getEnd(): \DateTime {
        return $this->end;
    }

    public function prolongation() {
        $end = clone $this->end;
        $end->add(new \DateInterval('P'.self::EMISSION_TIME.'D'));
        $this->end = $end;
    }

    public function hasEnded()
    {
        $dateFormat = 'Y-m-d';
        $date = clone $this->end;
        $date->add(new \DateInterval('P'.self::EMISSION_TIME.'D'));
        $today = new \DateTime();
        return $date->format($dateFormat) <= $today->format($dateFormat);
    }

}