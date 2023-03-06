<?php

namespace App\Controller;

use App\Entity\Note;
use App\Factory\NoteFactory;
use App\Repository\CategoryRepository;
use App\Repository\NoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api", name: "api_")]
class NotesController extends AbstractController
{
    public function __construct(
        private NoteRepository $noteRepository,
        private CategoryRepository $categoryRepository
    ) {
    }

    #[Route('/notes', name: 'notes_list', methods: ['GET'])]
    public function index(): Response
    {
        $notes = $this->noteRepository->findBy(['user' => $this->getUser(), 'deleted_at' => null]);
        $data = [];

        foreach ($notes as $note) {
            $data[] =  [
                'id' => $note->getId(),
                'title' => $note->getTitle(),
                'text' => $note->getText(),
                'user_id' => $note->getUser()->getId(),
                'category' => $note->getCategory()->getName(),
            ];
        }

        return $this->json([
            'notes' => $data,
        ]);
    }

    #[Route('/notes/{id}', name: 'notes', methods: ['GET'])]
    public function item(int $id): Response
    {
        $note = $this->noteRepository->findOneBy(
            ['user' => $this->getUser(), 'id' => $id, 'deleted_at' => null]
        );

        if (!($note instanceof Note)) {
            return $this->json([
                'message' => 'Заметка не найдена!',
            ], 404);
        }

        if ($note) {
            $data =  [
                'id' => $note->getId(),
                'title' => $note->getTitle(),
                'text' => $note->getText(),
                'user_id' => $note->getUser()->getId(),
                'category' => $note->getCategory()->getName(),
            ];

            return $this->json($data);
        }

        return $this->json(["error" => "Заметка не найдена!"], 404);
    }

    #[Route('/notes', name: 'notes_create', methods: ['POST'])]
    public function create(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $em = $doctrine->getManager();
        $decoded = json_decode($request->getContent());

        $user = $this->getUser();
        $category = $this->categoryRepository->find($decoded->category_id);

        $entity = NoteFactory::create(
            $decoded->title,
            $decoded->text,
            $user,
            $category
        );

        $em->persist($entity);
        $em->flush();

        return $this->json([
            'message' => 'Заметка создана!',
        ]);
    }

    #[Route('/notes/{id}', name: 'notes_update', methods: ['PUT'])]
    public function update(
        int $id,
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $em = $doctrine->getManager();

        $note = $this->noteRepository->findOneBy(['user' => $this->getUser(), 'id' => $id, 'deleted_at' => null]);

        if (!($note instanceof Note)) {
            return $this->json([
                'message' => 'Заметка не найдена!',
            ], 404);
        }

        $decoded = json_decode($request->getContent(), 1);

        if (array_key_exists('category_id', $decoded)) {
            $category = $this->categoryRepository->find($decoded['category_id']);
        } else {
            $category = $note->getCategory();
        }

        $title = array_key_exists('title', $decoded) ? $decoded['title'] : $note->getTitle();
        $text = array_key_exists('text', $decoded) ? $decoded['text'] : $note->getText();

        $note->setTitle($title);
        $note->setText($text);
        $note->setCategory($category);

        $em->persist($note);
        $em->flush();

        return $this->json([
            'message' => 'Заметка обновлена!',
        ]);
    }

    #[Route('/notes/{id}', name: 'notes_delete', methods: ['DELETE'])]
    public function delete(
        int $id,
        ManagerRegistry $doctrine
    ): Response
    {
        $em = $doctrine->getManager();

        $note = $this->noteRepository->findOneBy(
            ['user' => $this->getUser(), 'id' => $id, 'deleted_at' => null]
        );

        if (!($note instanceof Note)) {
            return $this->json([
                'message' => 'Заметка не найдена!',
            ], 404);
        }

        $note->setDeletedAt(new \DateTimeImmutable('now'));

        $em->persist($note);
        $em->flush();

        return $this->json([
            'message' => 'Заметка удалена!',
        ]);
    }
}