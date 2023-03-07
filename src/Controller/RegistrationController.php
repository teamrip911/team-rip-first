<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function index(ManagerRegistry $doctrine, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $em = $doctrine->getManager();
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $plaintextPassword = $decoded->password;

        if ($em->getRepository(User::class)->findOneBy(['email' => $email])) {
            return $this->json(['message' => 'User with that email already exist'], 422);
        }

        $user = new User();
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setPassword($hashedPassword);
        $user->setEmail($email);
        $user->setUsername($email);
        $em->persist($user);
        try {
            $em->flush();
        } catch (\Throwable $e) {
            return $this->json(['message' => $e->getMessage()], 500);
        }

        return $this->json(['message' => 'Registered Successfully']);
    }
}
