<?php


namespace App\Applicants\Domain;

use App\Offers\Domain\Offer;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Class Applicant
 * @Entity
 * @Table(name="Applicant")
 */
class Applicant
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", unique=TRUE)
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Id()
     * @ManyToOne(targetEntity="App\Offers\Domain\Offer")
     * @JoinColumn(name="offer_id", referencedColumnName="id")
     * @var Offer
     */
    private $offer;

    /**
     * Applicant constructor.
     * @param string $email
     * @param string $name
     */
    public function __construct(string $email, string $name, Offer $offer)
    {
        $this->email = $email;
        $this->name = $name;
        $this->offer = $offer;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}