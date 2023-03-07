<?php

namespace App\Command;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fill:categories',
    description: 'Наполняет категории в БД для модуля Заметки',
)]
class FillCategoriesCommand extends Command
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

        $categories = [
            'Разное',
            'Козоводство',
            'Овцеводство',
            'КРС',
            'Кролиководство',
            'Птицеводство',
            'Экзотические животные',
            'Свиноводство',
            'Наблюдения',
            'Экономика',
            'Управление фермой',
            'Полезные советы',
        ];

        foreach ($categories as $category) {
            $categoryEntity = new Category();
            $categoryEntity->setName($category);
            $this->em->persist($categoryEntity);
        }

        try {
            $this->em->flush();
        } catch (\Throwable $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
