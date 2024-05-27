pimcore.registerNS('pimcore.plugin.WorkflowGuiBundle.startup');

pimcore.plugin.WorkflowGuiBundle.startup = {
    addMenuItem: function () {
        var user = pimcore.globalmanager.get('user');
        var perspectiveCfg = pimcore.globalmanager.get('perspective');

        if (user.isAllowed('workflow_gui') && perspectiveCfg.inToolbar('settings.workflow_gui')) {
            var settingsMenu = new Ext.Action({
                text: t('workflows'),
                icon: '/bundles/pimcoreadmin/img/flat-white-icons/workflow.svg',
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
};

document.addEventListener(pimcore.events.pimcoreReady, function () {
    pimcore.plugin.WorkflowGuiBundle.startup.addMenuItem();
});

