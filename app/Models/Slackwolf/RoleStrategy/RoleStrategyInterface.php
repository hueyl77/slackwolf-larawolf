<?php
namespace App\Models\Slackwolf\RoleStrategy;

interface RoleStrategyInterface
{
    /**
     * @param array \Slack\User[] $users
     * @param Slackwolf\Game\OptionManager $optionsManager
     *
     * @return \Slack\User[]
     */
    public function assign(array $users, $optionsManager);

    /**
     * @return string
     */
    public function getRoleListMsg();
}