<?php


namespace App\Offers\Application\Command;


use App\Core\Application\CQRS\CommandInterface;

class ApplyToOfferCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $offer_id;

    public function __construct(string $email, string $name, int $offer_id)
    {
        $this->email = $email;
        $this->name = $name;
        $this->offer_id = $offer_id;
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

    /**
     * @return int
     */
    public function getOfferId(): int
    {
        return $this->offer_id;
    }
}