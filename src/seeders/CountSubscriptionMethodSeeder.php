<?php

namespace Crm\CountSubscriptionModule\Seeders;

use Crm\ApplicationModule\Seeders\ISeeder;
use Crm\SubscriptionsModule\Repository\SubscriptionLengthMethodsRepository;
use Symfony\Component\Console\Output\OutputInterface;

class CountSubscriptionMethodSeeder implements ISeeder
{
    private $subscriptionLengthMethodsRepository;

    public function __construct(SubscriptionLengthMethodsRepository $subscriptionLengthMethodsRepository)
    {
        $this->subscriptionLengthMethodsRepository = $subscriptionLengthMethodsRepository;
    }

    public function seed(OutputInterface $output)
    {
        $method = 'article_count';
        if (!$this->subscriptionLengthMethodsRepository->exists($method)) {
            $this->subscriptionLengthMethodsRepository->add(
                $method,
                'Article count',
                'Calculate subscription length based on number of articles viewed.',
                200
            );
            $output->writeln("  <comment>* subscription extension method <info>{$method}</info> created</comment>");
        } else {
            $output->writeln("  * subscription extension method <info>{$method}</info> exists");
        }
    }
}
