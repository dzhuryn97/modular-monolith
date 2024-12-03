<?php

namespace App\Shared\Console;

use App\User\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    public function __construct(
        private readonly UserService $userService,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:user:create');
        $this->addArgument('email');
        $this->addArgument('password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->userService->createUser(
            $input->getArgument('email'),
            $input->getArgument('password'),
        );

        return Command::SUCCESS;
    }
}
