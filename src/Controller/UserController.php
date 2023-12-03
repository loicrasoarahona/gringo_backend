<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    public $security;
    public $serializer;

    public function __construct(Security $security, SerializerInterface $serializer)
    {
        $this->security = $security;
        $this->serializer = $serializer;
    }

    #[Route('/user_info', name: 'app_user_info', methods: ['GET'])]
    public function getUserInfo()
    {
        $user = $this->security->getUser();

        $normalizedUser = $this->serializer->normalize($user, null, ['groups' => 'user:collection']);


        return $this->json($normalizedUser);
    }

    #[Route('/api/users', name: 'app_users_post', methods: ['POST'])]
    public function postUser(
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        UserPasswordHasherInterface $passwordHasher
    ){
        $data = json_decode($request->getContent(), true);
        $entity = new Utilisateur();
        $entity->setNom($data["firstname"] . " " . $data["lastname"]);
        $entity->setTelephone($data['telephone']);
        $entity->setWhatsapp($data['whatsapp']);
        $entity->setEmail($data['email']);
        $entity->setLogo($data['logo']);
        $password = $passwordHasher->hashPassword($entity, $data['password']);
        $entity->setMdp($password);
        $entityManager->persist($entity);
        $entityManager->flush();
        $jsonEntity = $serializer->serialize($entity, 'json');
        return new JsonResponse($jsonEntity, Response::HTTP_CREATED, [], true);
    }
}
