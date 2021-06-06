<?php


namespace App\Applicants\Infrastructure;


use App\Applicants\Domain\Applicant;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineApplicants implements Applicants
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function find(string $email, int $offerId): ?Applicant
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('a')
            ->from(Applicant::class, 'a')
            ->where('a.email = :email')
            ->andWhere('a.offer = :offer_id')
            ->setParameter('email', $email)
            ->setParameter('offer_id', $offerId)
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findForOffer(int $offerId): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->addSelect('a')
            ->from(Applicant::class, 'a')
            ->where('a.offer = :offer_id')
            ->setParameter('offer_id', $offerId);

        return $qb->getQuery()->getResult();
    }

    public function add(Applicant $applicant): void
    {
        $this->em->persist($applicant);
    }
}