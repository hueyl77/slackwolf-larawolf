<?php
namespace App\Models\Slackwolf\Roles;

use App\Models\Slackwolf\Role;

class Beholder extends Role
{
	public function getName() {
		return Role::BEHOLDER;
	}

	public function getDescription() {
		return "A villager who learns who the Seer is on the first night.";
	}
}