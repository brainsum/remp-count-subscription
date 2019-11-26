<?php

namespace Crm\CountSubscriptionModule\Length;

use DateTime;
use Nette\Database\Table\IRow;
use Crm\SubscriptionsModule\Length\Length;
use Crm\SubscriptionsModule\Length\LengthMethodInterface;

class ArticleCountLengthMethod implements LengthMethodInterface
{
    public function getEndTime(DateTime $startTime, IRow $user, IRow $subscriptionType, bool $isExtending = false): Length
    {
        $length = 999999;
        if ($isExtending && $subscriptionType->extending_length) {
            $length = $subscriptionType->extending_length;
        }
        $interval = new \DateInterval("P{$length}D");
        $end = (clone $startTime)->add($interval);

        if ($subscriptionType->fixed_end) {
            $end = $subscriptionType->fixed_end;
        }

        return new Length($end, $length);
    }
}
