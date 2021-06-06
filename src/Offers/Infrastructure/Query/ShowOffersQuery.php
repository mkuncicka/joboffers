<?php


namespace App\Offers\Infrastructure\Query;


use App\Core\Infrastructure\CQRS\QueryInterface;

class ShowOffersQuery implements QueryInterface
{
    /**
     * @var string
     */
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

}