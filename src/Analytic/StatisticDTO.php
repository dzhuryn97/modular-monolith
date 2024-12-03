<?php

namespace App\Analytic;

use Symfony\Component\Serializer\Attribute\SerializedName;

class StatisticDTO
{
    #[SerializedName('user_id')]
    public string $userId;

    #[SerializedName('user_name')]
    public string $userName;

    #[SerializedName('message_count')]
    public int $messageCount;
}
