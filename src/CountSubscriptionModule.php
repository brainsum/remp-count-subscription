<?php

namespace Crm\CountSubscriptionModule;

use Crm\ApiModule\Api\ApiRoutersContainerInterface;
use Crm\ApiModule\Router\ApiIdentifier;
use Crm\ApiModule\Router\ApiRoute;
use Crm\ApplicationModule\Commands\CommandsContainerInterface;
use Crm\ApplicationModule\CrmModule;
use Crm\ApplicationModule\SeederManager;
use Crm\ApplicationModule\User\UserDataRegistrator;
use Crm\SubscriptionsModule\Repository\SubscriptionsRepository;
use Crm\CountSubscriptionModule\Seeders\ContentAccessSeeder;
use Crm\CountSubscriptionModule\Seeders\CountSubscriptionMethodSeeder;
use Kdyby\Translation\Translator;
use League\Event\Emitter;
use Nette\Application\Routers\Route;
use Nette\DI\Container;
use Tomaj\Hermes\Dispatcher;

class CountSubscriptionModule extends CrmModule
{
    private $subscriptionsRepository;

    public function __construct(Container $container, Translator $translator, SubscriptionsRepository $subscriptionsRepository)
    {
        parent::__construct($container, $translator);
        $this->subscriptionsRepository = $subscriptionsRepository;
    }

    public function registerEventHandlers(Emitter $emitter)
    {
    }

    public function registerHermesHandlers(Dispatcher $dispatcher)
    {
    }

    public function registerCommands(CommandsContainerInterface $commandsContainer)
    {
    }

    public function registerApiCalls(ApiRoutersContainerInterface $apiRoutersContainer)
    {
        $apiRoutersContainer->attachRouter(
            new ApiRoute(
                new ApiIdentifier('1', 'users', 'customsubscriptions'),
                \Crm\CountSubscriptionModule\Api\v1\UsersCustomSubscriptionsHandler::class,
                \Crm\UsersModule\Auth\UserTokenAuthorization::class
            )
        );

        $apiRoutersContainer->attachRouter(
            new ApiRoute(
                new ApiIdentifier('1', 'article', 'view'),
                \Crm\CountSubscriptionModule\Api\v1\SubsctiptionUpdateOnArticelViewHandler::class,
                \Crm\UsersModule\Auth\UserTokenAuthorization::class
            )
        );
    }

    public function registerUserData(UserDataRegistrator $dataRegistrator)
    {
    }

    public function registerSeeders(SeederManager $seederManager)
    {
        $seederManager->addSeeder($this->getInstance(CountSubscriptionMethodSeeder::class));
        $seederManager->addSeeder($this->getInstance(ContentAccessSeeder::class));
    }

}
