<?php

namespace App\Command;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;

#[AsCommand(
    name: 'app:run-scrapper',
    description: 'Run scrapper',
)]
class RunScrapperCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Environment $twig
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $customers = $this->entityManager->getRepository(Customer::class)->findAll();

        /** @var Customer $customer */
        foreach ($customers as $customer) {
            $pythonContents = $this->twig->render('scrapper.py.twig', [
                'clientAPI' => $_ENV['CLIENT_API'],
                'customer' => $customer,
            ]);

            $fileName = "scrapper-". $customer->getId() .".py";

            file_put_contents(__DIR__ . '/../../python/' . $fileName, $pythonContents);

            shell_exec('cd ' . __DIR__ . '/../../python/ && pipenv run python3 ' . $fileName);
        }

        return Command::SUCCESS;
    }
}
