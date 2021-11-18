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

namespace CORS\Bundle\WorkflowGUI;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;
use CORS\Bundle\WorkflowGUI\Installer\WorkflowGuiInstaller;

class WorkflowGUIBundle extends AbstractPimcoreBundle
{
    use PackageVersionTrait;

    protected function getComposerPackageName(): string
    {
        return 'cors/workflow-gui';
    }

    public function getNiceName()
    {
        return 'Workflow GUI';
    }

    public function getDescription()
    {
        return 'Provides a Graphical User Interface to define Pimcore Workflows';
    }

    public function getInstaller()
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
            '/bundles/workflowgui/css/workflow_gui.css'
        ];
    }
}
