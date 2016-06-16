<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class Bodyguard extends Role
{
	public function getName() {
		return Role::BODYGUARD;
	}

	public function getDescription() {
		return "A villager who may protect a player from being eliminated once each night, but not the same person two nights in a row.";
	}
}