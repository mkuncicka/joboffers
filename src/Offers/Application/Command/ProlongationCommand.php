<?php


namespace App\Offers\Application\Command;


use App\Core\Application\CQRS\CommandInterface;

class ProlongationCommand implements CommandInterface
{
    private $offerId;

    public function __construct($offerId)
    {
        $this->offerId = $offerId;
    }

    /**
     * @return mixed
     */
    public function getOfferId()
    {
        return $this->offerId;
    }
}