<?php
namespace App\Models\Slackwolf;

use React\EventLoop\Factory;
use Slack\ConnectionException;
use Slack\RealTimeClient;

use App\Models\Slackwolf\Commands\AliveCommand;
use App\Models\Slackwolf\Commands\DeadCommand;
use App\Models\Slackwolf\Commands\EndCommand;
use App\Models\Slackwolf\Commands\GuardCommand;
use App\Models\Slackwolf\Commands\HealCommand;
use App\Models\Slackwolf\Commands\HelpCommand;
use App\Models\Slackwolf\Commands\KillCommand;
use App\Models\Slackwolf\Commands\PoisonCommand;
use App\Models\Slackwolf\Commands\SeeCommand;
use App\Models\Slackwolf\Commands\ShootCommand;
use App\Models\Slackwolf\Commands\NewCommand;
use App\Models\Slackwolf\Commands\JoinCommand;
use App\Models\Slackwolf\Commands\LeaveCommand;
use App\Models\Slackwolf\Commands\StartCommand;
use App\Models\Slackwolf\Commands\VoteCommand;
use App\Models\Slackwolf\Commands\SetOptionCommand;
use App\Models\Slackwolf\Commands\StatusCommand;
use App\Models\Slackwolf\GameManager;
use App\Models\Slackwolf\Message;

class Slackwolf
{
    public function __construct()
    {

    }

    public function run()
    {
        /*
         * Create the event loop
         */
        $eventLoop = Factory::create();

        /*
         * Create our Slack client
         */
        $client = new SlackRTMClient($eventLoop);
        $client->setToken(env('BOT_TOKEN'));

        /*
         * Setup command bindings
         */
        $commandBindings = [
            'help'      => HelpCommand::class,
            'option'    => SetOptionCommand::class,
            'new'       => NewCommand::class,
            'join'      => JoinCommand::class,
            'leave'     => LeaveCommand::class,
            'start'     => StartCommand::class,
            'end'       => EndCommand::class,
            'see'       => SeeCommand::class,
            'vote'      => VoteCommand::class,
            'kill'      => KillCommand::class,
            'poison'    => PoisonCommand::class,
            'guard'     => GuardCommand::class,
            'heal'      => HealCommand::class,
            'shoot'     => ShootCommand::class,
            'alive'     => AliveCommand::class,
            'dead'      => DeadCommand::class,
            'status'    => StatusCommand::class,
        ];

        /*
         * Create the game manager
         */
        $gameManager = new GameManager($client, $commandBindings);

        /*
         * Route incoming Slack messages
         */
        $client->on('message', function ($data) use ($client, $gameManager) {
            $message = new Message($data);

            if ($message->getSubType() == 'channel_join') {
                $client->refreshChannel($message->getChannel());
            } else if ($message->getSubType() == 'channel_leave') {
                $client->refreshChannel($message->getChannel());
            } else {
                $gameManager->input($message);
            }
        });

        /*
         * Connect to Slack
         */
        echo "Connecting...\r\n";
        $client->connect()->then(function() {
            echo "Connected.\n";
        }, function(ConnectionException $e) {
            echo $e->getMessage();
            exit();
        });

        /*
         * Start the event loop
         */
        $eventLoop->run();
    }
}