/*
 * AdvancePrompt advanceprompt
 */
'use strict';

oc.Modules.register('azaharizaman.octopusai.widget.advanceprompt', function() {
    class AdvancePromptWidget extends oc.FoundationBase
    {
        constructor(config) {
            super(config);

            if (this.config.alias === null) {
                throw new Error('Advance prompt alias is required.');
            }

            this.$rootElement = $('<div />');
            this.$rootElement.one('hide.oc.popup', this.proxy(this.onPopupHidden));
            this.$rootElement.one('shown.oc.popup', this.proxy(this.onPopupShown));

            this.show();
        }

        dispose() {
            super.dispose();
        }

        static processContent(content) {
            return processResolverContent(content);
        }

        static popup(config) {
            return new this(config);
        }

        static get DEFAULTS() {
            return {
                alias: null,
                value: '',
                onInsert: null,
                onShown: null
            }
        }

        onRefreshGenerated = function(event) {
            var $select = $(event.target),
                val = $select.val();

            if (!val) {
                return ;
            }

            var parts = val.split('::', 3);
            var extraData = {
                title: parts[0],
                prompt: parts[1],
                generated: parts[2]
            };

            oc.request(this.$popupElement.get(0), this.config.alias + '::onRefreshRecord', {
                data: {
                    AdvancePromptItem: extraData
                }
            });

            $select.empty().trigger('change.select2');
        }

        onInsertRecord = function(event) {
            const { data, context } = event.detail;

            if (context.handler !== this.config.alias + '::onInsertRecord') {
                return;
            }

            if (!data) {
                return;
            }

            if (this.config.onInsert) {
                this.config.onInsert.call(this, data);
            }
        }

        onPopupShown = function(event, element, popup) {
            this.$popupElement = popup;
            oc.Events.on(this.$popupElement.get(0), 'change', 'select[name=recordSearch]', this.proxy(this.onRefreshRecord));
            oc.Events.on(this.$popupElement.get(0), 'ajax:done', this.proxy(this.onInsertRecord));

            if (this.config.onShown) {
                this.config.onShown.call(this);
            }
        }

        onPopupHidden = function(event, element, popup) {
            oc.Events.off(this.$popupElement.get(0), 'change', 'select[name=recordSearch]', this.proxy(this.onRefreshRecord));
            oc.Events.off(this.$popupElement.get(0), 'ajax:done', 'form', this.proxy(this.onInsertRecord)); 
        
            this.dispose();
        }

        show() {
            var data = {
                advanceprompt_flag: true,
                value: this.config.value
            };

            this.$rootElement.popup({
                extraData: data,
                size: 'large',
                handler: this.config.alias + '::onLoadPopup'
            });
        }

        hide() {
            if (this.$rootElement) {
                this.$rootElement.trigger('close.oc.popup');
            }
        }
    }

    // oc.advanceprompt = AdvancePromptWidget;

    // if ($.FE) {
    //     $.FE.RegisterInsertAdvancePromptCommand();
    // }

    // function processResolverContent(content) {
    //     return window.location.origin + window.location.pathname + content;
    // }

    oc.richEditorRegisterButton('insertAdvancePrompt', {
        title: 'OctopusAI Advance Prompt',
        icon: '<i class="icon-magic"></i>',
        undo: true,
        focus: true,
        refreshOnCallback: true,
        callback: function () {
            oc.advanceprompt = AdvancePromptWidget;
            // Assuming 'show' is the method you want to call
            // if (oc.advanceprompt && typeof oc.advanceprompt.show === 'function') {
            //     oc.advanceprompt.show();
            // } else {
            //     console.error('show method not found or not a function.');
            // }
        }
    });
    
    oc.richEditorButtons.splice(0, 0, 'insertAdvancePrompt');


});

