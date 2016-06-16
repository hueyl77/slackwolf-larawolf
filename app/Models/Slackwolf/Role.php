<?php
namespace App\Models\Slackwolf;

use App\Models\Slackwolf\Roles\Beholder;
use App\Models\Slackwolf\Roles\Bodyguard;
use App\Models\Slackwolf\Roles\Hunter;
use App\Models\Slackwolf\Roles\Lycan;
use App\Models\Slackwolf\Roles\Seer;
use App\Models\Slackwolf\Roles\Tanner;
use App\Models\Slackwolf\Roles\Witch;
use App\Models\Slackwolf\Roles\WolfMan;


class Role
{
    public function appearsAsWerewolf() {
        return false;
    }

    public function isWerewolfTeam() {
        return false;
    }

    public function getName() {
        return null;
    }

    public function getDescription() {
        return null;
    }

    public function isRole($roleName) {
        return $roleName == $this->getName();
    }

    const VILLAGER = "Villager";
    const SEER = "Seer";
    const WEREWOLF = "Werewolf";

    const BEHOLDER = "Beholder";
    const BODYGUARD = "Bodyguard";
    const HUNTER = "Hunter";
    const LYCAN = "Lycan";
    const TANNER = "Tanner";
    const WITCH = "Witch";
    const WOLFMAN = "Wolf Man";

    public static function getSpecialRoles() {
        return [
            new Beholder(),
            new Bodyguard(),
            new Hunter(),
            new Lycan(),
            new Seer(),
            new Tanner(),
            new Witch(),
            new WolfMan()
        ];
    }
}