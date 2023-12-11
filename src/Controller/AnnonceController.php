<?php

namespace App\Controller;

use App\Entity\Annonce;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AnnonceController extends AbstractController
{
    public $security;
    public $serializer;

    public function __construct(Security $security, SerializerInterface $serializer, private EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->serializer = $serializer;
    }

    public function metaInfos()
    {
    }

    #[Route('/api/posts', methods: ['GET'])]
    public function getPosts(Request $request)
    {
        $repository = $this->em->getRepository(Annonce::class);

        $offset = $request->query->get('offset', 0);
        $limit = $request->query->get('limit', 10);

        $qb = $repository->createQueryBuilder('annonce')->select()
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        $result = $qb->getQuery()->getResult();

        $normalizedData = $this->serializer->normalize($result, null, ['groups' => ['annonce:collection', 'annoncePhoto:collection']]);

        return new JsonResponse($normalizedData, 200);
    }

    #[Route('/api/posts/metaInfo', methods: ['GET'])]
    public function postsMetaInfo(Request $request)
    {
        $repository = $this->em->getRepository(Annonce::class);


        $qb = $repository->createQueryBuilder('annonce')->select();

        $result = $qb->getQuery()->getResult();

        $count = count($result);
        $output = [
            'count' => $count
        ];
        return new JsonResponse($output, 200);
    }
}
