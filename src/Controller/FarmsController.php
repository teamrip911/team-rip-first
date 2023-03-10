<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\AnimalGroup;
use App\Entity\Farm;
use App\Entity\FarmAnimal;
use App\Entity\FarmAnimalGroup;
use App\Factory\AnimalGroupFactory;
use App\Factory\FarmAnimalFactory;
use App\Factory\FarmFactory;
use App\Repository\AnimalGroupRepository;
use App\Repository\AnimalRepository;
use App\Repository\FarmAnimalRepository;
use App\Repository\FarmRepository;
use App\Request\AddAnimalGroupRequest;
use App\Request\AddAnimalIntoGroupRequest;
use App\Request\AddAnimalRequest;
use App\Request\AddFarmRequest;
use App\Request\UpdateFarmRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class FarmsController extends AbstractController
{
    public function __construct(
        private FarmRepository $farmRepository,
        private AnimalRepository $animalRepository
    ) {
    }

    #[Route('/farms/me', name: 'farms', methods: ['GET'])]
    public function farm(): Response
    {
        $farm = $this->farmRepository->findOneBy(
            ['user' => $this->getUser()]
        );

        if (!($farm instanceof Farm)) {
            return $this->json([
                'message' => 'Ферма не найдена!',
            ], 404);
        }

        $data = [
            'id' => $farm->getId(),
            'title' => $farm->getTitle(),
            'description' => $farm->getDescription(),
            'address' => $farm->getAddress(),
        ];

        return $this->json($data);
    }

    #[Route('/farms/animals', name: 'farm_animal_create', methods: ['POST'])]
    public function addAnimal(
        AddAnimalRequest $request,
        ManagerRegistry $doctrine
    ): Response {
        $request->validate();
        $em = $doctrine->getManager();

        $farm = $this->farmRepository->findOneBy(
            ['user' => $this->getUser()]
        );

        if (!($farm instanceof Farm)) {
            return $this->json([
                'message' => 'Ферма не найдена!',
            ], 404);
        }

        $animal = $this->animalRepository->findOneBy(
            ['id' => $request->get('animal_id')]
        );

        if (!($animal instanceof Animal)) {
            return $this->json([
                'message' => 'Животное не найдено!',
            ], 404);
        }

        $entity = FarmAnimalFactory::create(
            $request->get('nickname'),
            $request->get('description'),
            new \DateTime($request->get('date_of_birth')),
            $farm,
            $animal
        );

        $em->persist($entity);
        $em->flush();

        return $this->json([
            'message' => 'Животное добавлено!',
        ]);
    }

    #[Route('/farms/groups', name: 'animal_group_create', methods: ['POST'])]
    public function addAnimalGroup(
        AddAnimalGroupRequest $request,
        ManagerRegistry $doctrine
    ): Response {
        $request->validate();
        $em = $doctrine->getManager();

        $farm = $this->farmRepository->findOneBy(
            ['user' => $this->getUser()]
        );

        if (!($farm instanceof Farm)) {
            return $this->json([
                'message' => 'Ферма не найдена!',
            ], 404);
        }

        $animal = $this->animalRepository->findOneBy(
            ['id' => $request->get('animal_id')]
        );

        if (!($animal instanceof Animal)) {
            return $this->json([
                'message' => 'Животное не найдено!',
            ], 404);
        }

        $entity = AnimalGroupFactory::create(
            $request->get('count'),
            $request->get('description'),
            $farm,
            $animal
        );

        $em->persist($entity);
        $em->flush();

        return $this->json([
            'message' => 'Группа добавлена!',
        ]);
    }

    #[Route('/farms/groups/animals', name: 'add_animal_in_group', methods: ['POST'])]
    public function addAnimalIntoGroup(
        AddAnimalIntoGroupRequest $request,
        ManagerRegistry $doctrine,
        FarmAnimalRepository $farmAnimalRepository,
        AnimalGroupRepository $animalGroupRepository
    ): Response {
        $request->validate();

        $em = $doctrine->getManager();

        $farmAnimal = $farmAnimalRepository->findOneBy(
            ['id' => $request->get('farm_animal_id')]
        );

        if (!($farmAnimal instanceof FarmAnimal)) {
            return $this->json([
                'message' => 'Животное не найдено!',
            ], 404);
        }

        $animalGroup = $animalGroupRepository->findOneBy(
            ['id' => $request->get('animal_group_id')]
        );

        if (!($animalGroup instanceof AnimalGroup)) {
            return $this->json([
                'message' => 'Стадо не найдено!',
            ], 404);
        }

        $entity = new FarmAnimalGroup();
        $entity->setFarmAnimal($farmAnimal);
        $entity->setAnimalGroup($animalGroup);

        $em->persist($entity);
        $em->flush();

        return $this->json([
            'message' => 'Животное добавлено в группу!',
        ]);
    }

    #[Route('/farms', name: 'farms_create', methods: ['POST'])]
    public function create(
        AddFarmRequest $request,
        ManagerRegistry $doctrine
    ): Response {
        $request->validate();
        $em = $doctrine->getManager();

        $entity = FarmFactory::create(
            $request->get('title'),
            $request->get('description'),
            $request->get('address'),
            /* @phpstan-ignore-next-line */
            $this->getUser()
        );

        $em->persist($entity);
        $em->flush();

        return $this->json([
            'message' => 'Ферма создана!',
        ]);
    }

    #[Route('/farms', name: 'farm_update', methods: ['PUT'])]
    public function update(
        UpdateFarmRequest $request,
        ManagerRegistry $doctrine
    ): Response {
        $request->validate();

        $em = $doctrine->getManager();

        $farm = $this->farmRepository->findOneBy(
            ['user' => $this->getUser()]
        );

        if (!($farm instanceof Farm)) {
            return $this->json([
                'message' => 'Ферма не найдена!',
            ], 404);
        }

        $farm->setTitle($request->get('title', $farm->getTitle()));
        $farm->setDescription($request->get('description', $farm->getDescription()));
        $farm->setAddress($request->get('address', $farm->getAddress()));

        $em->persist($farm);
        $em->flush();

        return $this->json([
            'message' => 'Ферма обновлена!',
        ]);
    }
}
