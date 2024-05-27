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

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;
use CORS\Pimcore\WorkflowGUI\Installer\WorkflowGuiInstaller;

class WorkflowGuiBundle extends AbstractPimcoreBundle
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
        return $this->container->get(WorkflowGuiInstaller::class);
    }

    public function getJsPaths()
    {
        return [
            '/bundles/workflowgui/js/pimcore/startup.js',
            '/bundles/workflowgui/js/pimcore/workflow/panel.js',
            '/bundles/workflowgui/js/pimcore/workflow/item.js',
            '/bundles/workflowgui/js/pimcore/workflow/place.js',
            '/bundles/workflowgui/js/pimcore/workflow/place_permission.js',
            '/bundles/workflowgui/js/pimcore/workflow/transition.js',
            '/bundles/workflowgui/js/pimcore/workflow/transition_notification.js',
            '/bundles/workflowgui/js/pimcore/workflow/global_action.js',
            '/bundles/workflowgui/js/pimcore/workflow/additional_field.js',
            '/bundles/workflowgui/js/pimcore/workflow/support_strategy/abstract.js',
            '/bundles/workflowgui/js/pimcore/workflow/support_strategy/simple.js',
            '/bundles/workflowgui/js/pimcore/workflow/support_strategy/expression.js',
            '/bundles/workflowgui/js/pimcore/workflow/support_strategy/service.js',
        ];
    }

    public function getCssPaths()
    {
        return [
            '/bundles/workflowgui/css/workflow_gui.css',
        ];
    }
}
