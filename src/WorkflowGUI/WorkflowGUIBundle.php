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

namespace CORS\Pimcore\WorkflowGUI;

use CORS\Pimcore\WorkflowGUI\Installer\WorkflowGUIInstaller;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;

class WorkflowGUIBundle extends AbstractPimcoreBundle
{
    use PackageVersionTrait;

    protected function getComposerPackageName(): string
    {
        return 'cors/workflow-gui';
    }

    public function getNiceName(): string
    {
        return 'Workflow GUI';
    }

    public function getDescription(): string
    {
        return 'Provides a Graphical User Interface to define Pimcore Workflows';
    }

    public function getInstaller(): ?\Pimcore\Extension\Bundle\Installer\InstallerInterface
    {
        return $this->container->get(WorkflowGUIInstaller::class);
    }
}
