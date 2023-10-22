<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Message\ValidEmail;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Process\Process;

class CronController extends AbstractController
{
    #[Route('/cron', name: 'cron')]
    public function index(KernelInterface $kernel): Response
    {
       if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
          $this->redirectToRoute('app_home');
       }

       $command = ['php', 'bin/console', 'messenger:consume', 'async', '--limit=3'];

       $process = new Process($command);
       $process->setWorkingDirectory($kernel->getProjectDir());

       $process->run();
       $process->wait();

       if (!$process->isSuccessful()) {
          throw new ProcessFailedException($process);
       }
       $output = $process->getOutput();

       return new Response($output);


//         $process = new Process(['php bin/console messenger:consume async']);
//         $process->setWorkingDirectory($kernel->getProjectDir());
//         $process->run();
//         $process->wait();
//         if ($process->isSuccessful()) {
//            return new Response('Reussi');
//         } else {
//            return new Response('Raté');
//         }

//        $application = new Application($kernel);
//        $application->setAutoExit(false);
//
//        $input = new ArrayInput([
//           'command' => 'messenger:consume',
//           'async',
//           '--limit' => 3
//        ]);
//
//        $output = new BufferedOutput();
//        $application->run($input, $output);
//
//        $content = $output->fetch();
//
//        return new Response($content);




       //   #[Route('/cron', name: 'cron')]
       //   public function index(KernelInterface $kernel): Response
       //   {
       //      $lockFile = 'lockfile.lock';
       //
       //      if (file_exists($lockFile)) {
       //         return new Response('Le worker est déjà en cours d\'exécution.');
       //      }
       //
       //      touch($lockFile);
       //
       //      $command = 'php bin/console messenger:consume async --limit=3';
       //
       //      exec($command . ' > /dev/null 2>&1 &');
       //
       //      return new Response('Le worker a été lancé en arrière-plan.');
       //   }
       //
       //   #[Route('/cronstop', name: 'stop_worker')]
       //   public function stopWorker(Request $request): Response
       //   {
       //      $lockFile = 'lockfile.lock';
       //
       //      // Vérifiez si le fichier de verrouillage existe.
       //      if (file_exists($lockFile)) {
       //         // Supprimez le fichier de verrouillage pour arrêter le worker.
       //         unlink($lockFile);
       //         return new Response('Le worker a été arrêté.');
       //      }
       //
       //      return new Response('Le worker n\'est pas en cours d\'exécution.');
       //   }

    }

}