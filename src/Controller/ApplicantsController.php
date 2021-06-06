<?php


namespace App\Controller;


use App\Applicants\Infrastructure\Query\ShowApplicantsQuery;
use App\Core\Application\CQRS\CommandBusInterface;
use App\Core\Infrastructure\CQRS\QueryBusInterface;
use App\Offers\Infrastructure\Query\ShowOffersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicantsController extends AbstractController
{
    /**
     * @var QueryBusInterface
     */
    private $queryBus;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    public function __construct(QueryBusInterface $queryBus, CommandBusInterface $commandBus)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/getApplicants/{offerId}", methods="GET")
     * @param Request $request
     * @return Response
     */
    public function getOffers(Request $request, int $offerId): Response
    {
        $query = new ShowApplicantsQuery($offerId);
        $response = $this->queryBus->handle($query);

        return new Response($response, Response::HTTP_OK);
    }

}