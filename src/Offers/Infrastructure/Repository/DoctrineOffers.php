<?php


namespace App\Offers\Infrastructure\Repository;


use App\Offers\Domain\Offer;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineOffers implements Offers
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Offer
    {
        return $this->em->find(Offer::class, $id);
    }

    public function findByCompanyAndTitle(string $companyName, string $title): ?Offer
    {
        $offer = $this->em->getRepository(Offer::class)->findBy([
            'company_name' => $companyName,
            'title' => $title,
        ]);

        return !empty($offer) ? reset($offer) : NULL;
    }

    public function add(Offer $offer): void
    {
        $this->em->persist($offer);
    }

    public function search(string $title): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->addSelect('o')
            ->from(Offer::class, 'o')
            ->where('o.title = :title')
            ->setParameter('title', $title);
        return $qb->getQuery()->getResult();
    }

    public function getOfferIdsToAnonymization(): array
    {
        $today = new \DateTime();
        $interval = new \DateInterval('P30D');
        $lastEndDateToPerformAnonymization = $today->sub($interval);
        $qb = $this->em->createQueryBuilder();
        $qb->addSelect('o.id')
            ->from(Offer::class, 'o')
            ->where('o.end < :end')
            ->setParameter('end', $lastEndDateToPerformAnonymization);
        $ids = $qb->getQuery()->getArrayResult();
        return array_map(function($item) {return $item['id'];}, $ids);
    }
}