<?php

namespace App\Command;

use App\Entity\Animal;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fill:animals',
    description: 'Наполняет животных в БД',
)]
class FillAnimalsCommand extends Command
{
    private ObjectManager $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $animals = [
            'Кошка',
            'Собака',
            'Овца',
            'Корова',
            'Кролик',
            'Утка',
            'Курица',
            'Гусь',
            'Цесарка',
            'Перепёлка',
            'Фазан',
            'Страус',
            'Свинья',
            'Коза',
            'Лошадь',
            'Нутрия',
            'Пчёлы(семья)',
        ];

        foreach ($animals as $animal) {
            $animalEntity = new Animal();
            $animalEntity->setName($animal);
            $this->em->persist($animalEntity);
        }

        try {
            $this->em->flush();
        } catch (\Throwable $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success('Животные наполнены в БД!');

        return Command::SUCCESS;
    }
}
