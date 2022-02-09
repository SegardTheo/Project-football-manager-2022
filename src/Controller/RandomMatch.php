<?php


namespace App\Controller;


use App\Repository\PlayerRepository;
use App\Service\MatchService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;

/**
 * Class RandomMatch
 * @package App\Controller
 */
#[AsController]
class RandomMatch extends AbstractController
{
    private PlayerRepository $playerRepository;
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function __construct(PlayerRepository $playerRepository, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->playerRepository = $playerRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    /**
     * 11 joueurs par équipe soit 22 joueurs retournés
     */
    public function __invoke(): array
    {
        $query = $this->entityManager->getRepository(Player::class)
            ->createQueryBuilder('p')
            ->addSelect('RAND() as HIDDEN rand')->orderBy('rand()')
        ->setMaxResults(22);

        $results = $query->getQuery()->execute();

        $lenResults = count($results);

        $firstTeam = array_slice($results, 0, $lenResults / 2);
        $secondTeam = array_slice($results, $lenResults / 2);

        $matchService = new MatchService($firstTeam, $secondTeam);
        $matchService->calculScore();

        $resultMatch = [
            "firstTeam" =>
            [
                "score" => $matchService->getScoreFirstTeam(),
                "team" => $firstTeam
            ],
            "secondTeam" =>
                [
                    "score" => $matchService->getScoreSecondTeam(),
                    "team" => $secondTeam
                ]
        ];

        return $resultMatch;
    }
}
