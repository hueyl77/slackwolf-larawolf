<?php
namespace App\Models\Slackwolf\Commands;

use Exception;
use Slack\Channel;
use Slack\ChannelInterface;
use App\Models\Slackwolf\Formatter\PlayerListFormatter;
use App\Models\Slackwolf\Game;

class DeadCommand extends Command
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
                   $client->send(":warning: No game in progress.", $channel);
               });
            return;
        }

        // build list of players
        $playersList = PlayerListFormatter::format($this->game->getDeadPlayers());
        if (empty($playersList))
        {
            $this->gameManager->sendMessageToChannel($this->game, "No one has died yet.");
        }
        else
        {
            $this->gameManager->sendMessageToChannel($this->game, ":angel: Players who have died: ".$playersList);
        }
    }
}