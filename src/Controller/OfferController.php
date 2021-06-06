<?php


namespace App\Controller;


use App\Core\Application\CQRS\CommandBusInterface;
use App\Core\Infrastructure\CQRS\QueryBusInterface;
use App\Offers\Application\Command\AddOfferCommand;
use App\Offers\Application\Command\ApplyToOfferCommand;
use App\Offers\Application\Command\ProlongationCommand;
use App\Offers\Infrastructure\Query\ShowOffersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
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
     * @Route("/addOffer", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function addOffer(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), TRUE);
        $companyName = $content['company_name'];
        $title = $content['title'];
        $city = $content['city'];
        $minSalary = $content['min_salary'];
        $maxSalary = $content['max_salary'];
        $start = isset($content['start']) ? new \DateTime($content['start']) : new \DateTime();

        if (empty($companyName) || empty($title) || empty($city) || empty($minSalary) || empty($maxSalary)) {
            return new JsonResponse([
                'error' => 'Some values are missing.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $command = new AddOfferCommand($companyName, $title, $city, $minSalary, $maxSalary, $start);
        $this->commandBus->dispatch($command);

        return new JsonResponse([
            'status' => 'Offer created.',
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/applyToOffer", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function applyToOffer(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), TRUE);
        $email = $content['email'];
        $name = $content['name'];
        $offerId = $content['offer_id'];
        $command = new ApplyToOfferCommand($email, $name, $offerId);
        $this->commandBus->dispatch($command);

        return new JsonResponse([
            'status' => 'Application received.',
        ], JsonResponse::HTTP_OK);
    }
    /**
     * @Route("/getOffers", methods="GET")
     * @param Request $request
     * @return JsonResponse
     */
    public function getOffers(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), TRUE);
        $title = $content['title'];
        $query = new ShowOffersQuery($title);
        $response = $this->queryBus->handle($query);

        return new JsonResponse(json_decode($response), JsonResponse::HTTP_OK);
    }



    /**
     * @Route("/prolongation", methods="POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function prolongation(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), TRUE);

        $offerId = $content['offer_id'];
        $command = new ProlongationCommand($offerId);
        $this->commandBus->dispatch($command);

        return new JsonResponse([
            'status' => 'Prolongation performed.',
        ], JsonResponse::HTTP_OK);
    }

}