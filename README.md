REMP Count Subscription Module
==

This module adds a new type of subscription that is not only limited by time period, but the number of articles a user can view.

Installation
--

Install module via composer by adding the repositories to your composer.json file

```
    ...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/brainsum/remp-count-subscription"
        }
    ...
```

Then require it via composer:

```
composer require brainsum/remp-count-subscription
```

Extend your `app/config/config.neon` file with the following:

```
extensions:
    #...
    - Crm\CountSubscriptionModule\DI\CountSubscriptionModuleExtension
    - Nepada\Bridges\PresenterMappingDI\PresenterMappingExtension
#...
application:
    #...
    mapping:
        #...
        'Subscriptions:SubscriptionsAdmin': Crm\CountSubscriptionModule\Presenters\SubscriptionsAdminPresenter

```

Apply migration to add necessary fields:

```
php bin/command.php phinx:migrate
```

Seed the database with the new subsciprion type:

```
php bin/command.php application:seed
```

Maintainers
--

This module has been creaded and maintained by:

* Levente Besenyei (l-besenyei) - https://github.com/l-besenyei

This module was created and sponsored by Brainsum, a Drupal development company
in Budapest, Hungary.

 * Brainsum - https://www.brainsum.hu/
