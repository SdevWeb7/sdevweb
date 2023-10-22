<?php

use App\Kernel;
use Symfony\Component\Process\Process;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$kernel = new Kernel();

$command = [
   'php',
   'bin/console',
   'messenger:consume',
   'async',
   '--limit=3'
];
$process = new Process($command);
$process->setWorkingDirectory($kernel->getProjectDir());
$process->start();