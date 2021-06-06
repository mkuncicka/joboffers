<?php


namespace App\Offers\Application\Command;


use App\Core\Application\CQRS\CommandInterface;

class AddOfferCommand implements CommandInterface
{

    /**
     * @var string
     */
    private $companyName;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $city;
    /**
     * @var int
     */
    private $minSalary;
    /**
     * @var int
     */
    private $maxSalary;
    /**
     * @var \DateTime
     */
    private $start;

    public function __construct(
        string $companyName,
        string $title,
        string $city,
        int $minSalary,
        int $maxSalary,
        \DateTime $start
    ) {
        $this->companyName = $companyName;
        $this->title = $title;
        $this->city = $city;
        $this->minSalary = $minSalary;
        $this->maxSalary = $maxSalary;
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
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
}