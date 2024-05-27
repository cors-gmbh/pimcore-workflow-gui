<?php

declare(strict_types=1);

/*
 * CORS GmbH
 *
 * This software is available under the GNU General Public License version 3 (GPLv3).
 *
 * @copyright  Copyright (c) CORS GmbH (https://www.cors.gmbh)
 * @license    https://www.cors.gmbh/license GPLv3
 */

namespace CORS\Pimcore\WorkflowGui\Installer;

use Pimcore\Db;
use Pimcore\Extension\Bundle\Installer\SettingsStoreAwareInstaller;
use Pimcore\Model\User\Permission;

final class WorkflowGuiInstaller extends SettingsStoreAwareInstaller
{
    public const WORKFLOW_GUI = 'workflow_gui';

    public function install(): void
    {
        $this->addPermissionToPanel();
        $this->markInstalled();
    }

    public function uninstall(): void
    {
        $this->removePermissionFromPanel();
        $this->markUninstalled();
    }

    private function addPermissionToPanel(): void
    {
        $permissionDefinition = new Permission\Definition();
        $permissionDefinition->setKey(self::WORKFLOW_GUI);
        $permissionDefinition->save();
    }

    private function removePermissionFromPanel(): void
    {
        $state = Db::get()->prepare('DELETE FROM `users_permission_definitions` WHERE `key` = :key');
        $state->bindValue('key', self::WORKFLOW_GUI);
        $state->execute();
    }
}
