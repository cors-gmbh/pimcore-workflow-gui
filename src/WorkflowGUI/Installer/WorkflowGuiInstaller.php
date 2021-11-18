<?php
/**
 * CORS GmbH.
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CORS GmbH (https://www.cors.gmbh)
 * @license    https://www.cors.gmbh/license     GPLv3 and PCL
 */

namespace CORS\Bundle\WorkflowGUI\Installer;

use Pimcore\Db;
use Pimcore\Extension\Bundle\Installer\SettingsStoreAwareInstaller;
use Pimcore\Model\User\Permission;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

final class WorkflowGuiInstaller extends SettingsStoreAwareInstaller
{
    const WORKFLOW_GUI = 'workflow_gui';

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
        $state = Db::get()->prepare("DELETE FROM `users_permission_definitions` WHERE `key` = :key");
        $state->bindValue("key", self::WORKFLOW_GUI);
        $state->execute();
    }
}
