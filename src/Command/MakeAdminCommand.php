<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
   name: 'app:make-admin', description: 'Make an user Admin', hidden: false
)]
class MakeAdminCommand extends Command
{
   public function __construct (private readonly UserRepository $repository, private readonly EntityManagerInterface $manager) {
      parent ::__construct();
   }

   protected function configure(): void
   {
      $this
         ->addArgument('arg1', InputArgument::OPTIONAL, 'mail to make admin');
   }

   protected function execute(InputInterface $input, OutputInterface $output): int
   {
      $io = new SymfonyStyle($input, $output);
      $arg1 = $input->getArgument('arg1');

      $user = $this->repository->findOneBy(['email' => $arg1]);

      if (!$user) {
         $io->note(sprintf('Email "%s" introuvable', $arg1));
         return Command::INVALID;
      }

      try {
         $user->addRole('ROLE_ADMIN');
         $this->manager->persist($user);
         $this->manager->flush();
         $io->success($arg1 . ' est maintenant admin');
         return Command::SUCCESS;
      } catch (\Exception $exception) {
         $io->error($exception->getMessage());
         return Command::FAILURE;
      }
   }
}
