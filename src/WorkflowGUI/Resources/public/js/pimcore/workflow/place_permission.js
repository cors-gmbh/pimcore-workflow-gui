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

pimcore.registerNS('pimcore.plugin.workflow.place_permission');
pimcore.plugin.workflow.place_permission = Class.create({
    initialize: function (permissionStore, permission) {
        this.permissionStore = permissionStore;

        this.window = new Ext.window.Window({
            title: t('workflow_place_permission'),
            items: this.getSettings(permission),
            modal: true,
            resizeable: false,
            layout: 'fit',
            width: 600,
            height: 500
        });

        this.window.show();
    },

    getPermissionCheckbox: function (permission, name) {
        return {
            xtype: 'combobox',
            fieldLabel: t('workflow_place_permission_' + name),
            name: name,
            store: Ext.data.ArrayStore({
                fields: ['type'],
                data: [
                    [null, 'not configured'],
                    [true, 'yes'],
                    [false, 'no']
                ]
            }),
            value: permission.get(name),
            displayField: 'type',
            valueField: 'type'
        };
    },

    getSettings: function (permission) {
        this.settingsForm = new Ext.form.Panel({
            bodyStyle: 'padding:20px 5px 20px 5px;',
            border: false,
            autoScroll: true,
            forceLayout: true,
            defaults: {
                width: '100%',
                labelWidth: 200
            },
            items: [
                {
                    xtype: 'textfield',
                    name: 'condition',
                    value: permission.get('condition'),
                    fieldLabel: t('workflow_place_permission_condition'),
                },
                this.getPermissionCheckbox(permission, 'save'),
                this.getPermissionCheckbox(permission, 'publish'),
                this.getPermissionCheckbox(permission, 'unpublish'),
                this.getPermissionCheckbox(permission, 'delete'),
                this.getPermissionCheckbox(permission, 'rename'),
                this.getPermissionCheckbox(permission, 'view'),
                this.getPermissionCheckbox(permission, 'settings'),
                this.getPermissionCheckbox(permission, 'versions'),
                this.getPermissionCheckbox(permission, 'properties'),
                this.getPermissionCheckbox(permission, 'modify'),
                {
                    xtype: 'textfield',
                    name: 'objectLayout',
                    value: permission.get('objectLayout'),
                    fieldLabel: t('workflow_place_permission_object_layout')
                },
            ],
            buttons: [
                {
                    text: t('save'),
                    handler: function (btn) {
                        var formValues = this.settingsForm.getForm().getFieldValues();

                        var notEmptyValues = Object.keys(formValues).filter(function(key) {
                            var actualValue = formValues[key];

                            return !((key === 'condition' && !actualValue) || actualValue === null);
                        });

                        if (notEmptyValues.length === 0) {
                            Ext.Msg.alert(t('workflow_place_permission'), t('workflow_place_permission_invalid'));
                            return;
                        }

                        if (this.settingsForm.isValid()) {


                            permission.set(formValues);
                            permission.commit();

                            this.permissionStore.add(permission);

                            this.window.close();
                        }
                    }.bind(this),
                    iconCls: 'pimcore_icon_apply'
                }
            ],
        });

        return this.settingsForm;
    }
});
