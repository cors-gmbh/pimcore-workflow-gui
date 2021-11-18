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

pimcore.registerNS('pimcore.plugin.WorkflowGuiBundle');

pimcore.plugin.WorkflowGuiBundle = Class.create(pimcore.plugin.admin, {
    getClassName: function () {
        return 'pimcore.plugin.WorkflowGuiBundle';
    },

    initialize: function () {
        pimcore.plugin.broker.registerPlugin(this);
    },

    pimcoreReady: function (params,broker) {
        var user = pimcore.globalmanager.get('user');
        var perspectiveCfg = pimcore.globalmanager.get('perspective');

        if(user.isAllowed('workflow_gui') && perspectiveCfg.inToolbar('settings.workflow_gui')) {
            var settingsMenu = new Ext.Action({
                text: t('workflows'),
                iconCls: 'worklfow_gui_nav_icon_workflow',
                handler : this.showWorkflows
            });

            layoutToolbar.settingsMenu.add(settingsMenu);
        }
    },

    showWorkflows: function () {
        try {
            pimcore.globalmanager.get('workflows').activate();
        }
        catch (e) {
            pimcore.globalmanager.add('workflows', new pimcore.plugin.workflow.panel());
        }
    },
});

var WorkflowGuiBundlePlugin = new pimcore.plugin.WorkflowGuiBundle();
