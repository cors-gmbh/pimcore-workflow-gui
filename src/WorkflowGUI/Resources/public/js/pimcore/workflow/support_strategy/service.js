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
