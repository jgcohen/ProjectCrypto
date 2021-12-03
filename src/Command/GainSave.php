<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;
class CreateGain extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-gain';

    public function __construct(Environment $twig)
    {
        // Inject it in the constructor and update the value on the class
        $this->twig = $twig;

        parent::__construct();
    }
    protected function configure(): void
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user


        // return this if there was no problem running the command
        return Command::SUCCESS;
    }
}