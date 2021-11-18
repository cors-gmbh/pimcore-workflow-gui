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

pimcore.registerNS('pimcore.plugin.workflow.support_strategy.expression');
pimcore.plugin.workflow.support_strategy.expression = Class.create(pimcore.plugin.workflow.support_strategy.abstract, {
    getSettingsItems: function (id, data) {
        return [{
            xtype: 'textfield',
            fieldLabel: t('workflow_support_strategy_class'),
            name: 'class',
            allowBlank: false,
            value: data.hasOwnProperty('support_strategy') && data.support_strategy.hasOwnProperty('arguments') ? data.support_strategy.arguments[0] : ''
        }, {
            xtype: 'textfield',
            fieldLabel: t('workflow_support_strategy_expression'),
            name: 'expression',
            allowBlank: false,
            value: data.hasOwnProperty('support_strategy') && data.support_strategy.hasOwnProperty('arguments') ? data.support_strategy.arguments[1] : ''
        }];
    },

    getFormData: function (panel) {
        var form = panel.getForm();
        var fieldValues = form.getFieldValues();

        return {
            type: 'expression',
            arguments: [
                fieldValues['class'],
                fieldValues['expression']
            ]
        };
    },
});
