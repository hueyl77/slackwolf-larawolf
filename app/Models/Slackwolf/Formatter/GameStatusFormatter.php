<?php
namespace App\Models\Slackwolf\Formatter;

use App\Models\Slackwolf\GameState;
use App\Models\Slackwolf\Role;
use App\Models\Slackwolf\Formatter\VoteSummaryFormatter;

class GameStatusFormatter
{
    public static function format(Game $game)
    {
        $msg = ":memo: Game Status\r\n- - - - - - - - - - - - - - - - - - - - - - - -\r\n";

        if ($game->hunterNeedsToShoot) {
            $msg .= "_...waiting on the_ :bow_and_arrow: Hunter";
            $msg .= "\r\n- - - - - - - - - - - - - - - - - - - - - - - -\r\n";
            return $msg;
        }

        switch($game->state) {

            case GameState::DAY:
                $voteMsg = VoteSummaryFormatter::format($game);

                $msg .= ":sun_small_cloud:  It is now Day.  Please vote!\r\n";
                $msg .= $voteMsg . "\r\n";
                break;

            case GameState::FIRST_NIGHT:
            case GameState::NIGHT:
                $msg .= ":moon:  The night lingers on ... \r\n \r\n";

                $numSeer = $game->getNumRole(Role::SEER);
                $numBodyguard = $game->getNumRole(Role::BODYGUARD);
                $numWitch = $game->getNumRole(Role::WITCH);

                if ($numSeer > 0 && !$game->seerSeen) {
                    $msg .= "_...waiting on the_ :crystal_ball: *Seer*\r\n";
                }

                if ($game->state == GameState::NIGHT) {
                    if (!$game->wolvesVoted) {
                        $msg .= "_...waiting on the_ :wolf:  *Wolves*\r\n";
                    }

                    if ($numWitch > 0 && (!$game->witchPoisoned || !$game->witchHealed)) {
                        $msg .= "_...waiting on the_ :older_woman::skin-tone-3: *Witch*\r\n";
                    }

                    if ($numBodyguard > 0 && !$game->getGuardedUserId()) {
                        $msg .= "_...waiting on the_ :shield: *Bodyguard*\r\n";
                    }
                }
                break;

            default:
                $msg .= "No Game Running\n";
        }

        return $msg;
    }
}