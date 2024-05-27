
pimcore.registerNS('pimcore.plugin.workflow.support_strategy.abstract');
pimcore.plugin.workflow.support_strategy.abstract = Class.create({
    getSettingsForm: function (id, data) {
        this.form = new Ext.form.Panel({
            defaults: {
                width: '100%',
                labelWidth: 200
            },
            items: this.getSettingsItems(id, data)
        });

        return this.form;
    },

    isValid: function() {
        return this.form.isValid();
    },

    getData: function () {
        return this.getFormData(this.form);
    },
});
