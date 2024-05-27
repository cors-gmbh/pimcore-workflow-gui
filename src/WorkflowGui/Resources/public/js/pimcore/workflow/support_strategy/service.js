pimcore.registerNS('pimcore.plugin.workflow.support_strategy.service');
pimcore.plugin.workflow.support_strategy.service = Class.create(pimcore.plugin.workflow.support_strategy.abstract, {
    getSettingsItems: function (id, data) {
        return [{
            xtype: 'textfield',
            fieldLabel: t('workflow_support_strategy_service'),
            name: 'service',
            allowBlank: false,
            value: data.hasOwnProperty('support_strategy') ? data.support_strategy.service : ''
        }];
    },

    getFormData: function (panel) {
        var form = panel.getForm();
        var fieldValues = form.getFieldValues();

        return {
            service: fieldValues['service']
        };
    },
});
