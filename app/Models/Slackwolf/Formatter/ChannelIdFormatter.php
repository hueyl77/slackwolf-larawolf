<?php
namespace App\Models\Slackwolf\Formatter;

class ChannelIdFormatter
{
    public static function format($userId)
    {
        $trimmed = trim($userId, "<>#\t\n\r\x0B");

        if (strpos($trimmed, '|') !== false) {
            $trimmed = substr($trimmed, 0, strpos($trimmed,'|'));
        }

        return $trimmed;
    }
}