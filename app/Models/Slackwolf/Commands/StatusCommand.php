<?php
namespace App\Models\Slackwolf\Commands;

use Exception;
use Slack\Channel;
use Slack\ChannelInterface;

use App\Models\Slackwolf\Formatter\GameStatusFormatter;
use App\Models\Slackwolf\Game;

class StatusCommand extends Command
{

    /**
     * @var Game
     */
    private $game;

    public function init()
    {
        $this->game = $this->gameManager->getGame($this->channel);
    }

    public function fire()
    {
        $client = $this->client;

        if ( ! $this->gameManager->hasGame($this->channel)) {
            $client->getChannelGroupOrDMByID($this->channel)
               ->then(function (ChannelInterface $channel) use ($client) {
                   $client->send(":warning: Run command this in the game channel.", $channel);
               });
            return;
        }

        // get status formatter
        $statusMsg = GameStatusFormatter::format($this->game);
        $this->gameManager->sendMessageToChannel($this->game, $statusMsg);

    }
}