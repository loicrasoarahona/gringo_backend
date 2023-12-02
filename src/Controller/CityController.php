<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CityController extends AbstractController
{
    public $security;
    public $serializer;

    public function __construct(Security $security, SerializerInterface $serializer)
    {
        $this->security = $security;
        $this->serializer = $serializer;
    }

    #[Route('/api/cities', name: 'app_cities', methods: ['GET'])]
    public function getCities(EntityManagerInterface $entityManager){
        $cityRepository = $entityManager->getRepository(Ville::class);
        $cities = $cityRepository->findAll();
        $citiesArray = [];
        foreach ($cities as $city) {
            $citiesArray[] = [
                    'id' => $city->getId(),
                    'name' => $city->getNom()
            ];
        }
        return new JsonResponse($citiesArray);
    }
}