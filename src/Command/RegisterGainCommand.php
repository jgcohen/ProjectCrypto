<?php

namespace App\Command;

use App\Entity\Gains;
use App\Entity\Purchase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;

class RegisterGainCommand extends Command
{
    protected static $defaultName = 'app:registerGain';
    protected static $defaultDescription = 'Allow to add the gain of the day';
    public function __construct(HttpClientInterface $client,EntityManagerInterface $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }
    public function getData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
            ['headers' => [
                'Accepts: application/json',
                'X-CMC_PRO_API_KEY: 2e36d0ab-fd40-4059-9b49-97ab20b4bc3c'
            ]]
        );
        return $response->toArray();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = $this->getData()['data'];
        $gain =  new Gains();
        $gains=[];
        $purchases = $this->entityManager->getRepository(Purchase::class)->findAll();
        foreach ($data as $value) {
            foreach ($purchases as $purchase) {
                if ($value['name'] == $purchase->getCurrency()) {

                    array_push($gains, ((($value['quote']['USD']['price'] - $purchase->getPrice()) * $purchase->getQuantity())));
                }
            }
        }
        $total = 0;
        foreach ($gains as $totalGain) $total += $totalGain;
        
        $gain->setCreatedAt(new DateTimeImmutable());
        $gain->setValue($total);
        $this->entityManager->persist($gain);
        $this->entityManager->flush();
        return Command::SUCCESS;
    }
}
