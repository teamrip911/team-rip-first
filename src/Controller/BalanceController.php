<?php

namespace App\Controller;

use App\Entity\Balance;
use App\Entity\Farm;
use App\Factory\BalanceFactory;
use App\Repository\BalanceRepository;
use App\Repository\FarmRepository;
use App\Request\AddBalanceRequest;
use App\Request\UpdateBalanceRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class BalanceController extends AbstractController
{
    public function __construct(private BalanceRepository $balanceRepository)
    {
    }

    #[Route('/balance', name: 'balance', methods: ['GET'])]
    public function farm(): Response
    {
        $records = $this->balanceRepository->findBy(['user' => $this->getUser()]);
        $result = [];

        /** @var Balance $record */
        foreach ($records as $record) {
            $result[] = [
                'id' => $record->getId(),
                'record_date' => $record->getRecordDate(),
                'amount' => $record->getAmount(),
                'type' => $record->getType(),
            ];
        }

        return $this->json($result);
    }

    #[Route('/balance', name: 'balance_create', methods: ['POST'])]
    public function addRecord(
        AddBalanceRequest $request,
        ManagerRegistry $doctrine,
        FarmRepository $farmRepository
    ): Response {
        $request->validate();
        $em = $doctrine->getManager();

        $farm = $farmRepository->findOneBy(
            ['user' => $this->getUser()]
        );

        if (!($farm instanceof Farm)) {
            return $this->json([
                'message' => 'Ферма не найдена!',
            ], 404);
        }

        $entity = BalanceFactory::create(
            new \DateTime($request->getRecordDate()),
            $request->getAmount(),
            $request->getType(),
            $farm,
            /* @phpstan-ignore-next-line */
            $this->getUser()
        );

        $em->persist($entity);
        $em->flush();

        return $this->json([
            'message' => 'Запись добавлена!',
        ]);
    }

    #[Route('/balance/{id}', name: 'balance_update', methods: ['PUT'])]
    public function update(
        int $id,
        UpdateBalanceRequest $request,
        ManagerRegistry $doctrine
    ): Response {
        $request->validate();

        $em = $doctrine->getManager();

        $record = $this->balanceRepository->findOneBy(
            ['id' => $id]
        );

        if (!($record instanceof Balance)) {
            return $this->json([
                'message' => 'Запись не найдена!',
            ], 404);
        }

        if (null !== $request->get('record_date')) {
            $recordDate = new \DateTime($request->get('record_date'));
        } else {
            $recordDate = $record->getRecordDate();
        }

        $record->setRecordDate($recordDate);
        $record->setAmount($request->get('amount', $record->getAmount()));
        $record->setType($request->get('type', $record->getType()));

        $em->persist($record);
        $em->flush();

        return $this->json([
            'message' => 'Запись обновлена!',
        ]);
    }
}
