<?php


namespace App\Controller;


use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
class StartMatch extends AbstractController
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

    public function __invoke(Player $data): array
    {
        $ezfez = $this->entityManager->getRepository(Player::class)
            ->createQueryBuilder('p')
            ->addSelect('RAND() as HIDDEN rand')->orderBy('rand()')
            ->setMaxResults(4);

        $results = $ezfez->getQuery()->execute();

        return [$data];
    }
}
