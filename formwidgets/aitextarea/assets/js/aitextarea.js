/*
 * This is a sample JavaScript file used by AITextArea
 *
 * You can delete this file if you want
 */
addEventListener('ajax:promise', function(event) {
    event.target.closest('form').querySelectorAll('button').forEach(function(el) {
        el.display = true;
    });
});

addEventListener('ajax:always', function() {
    event.target.closest('form').querySelectorAll('button').forEach(function(el) {
        el.display = false;
    });
});

oc.richEditorRegisterButton('insertAdvancePrompt', {
    title: 'OctopusAI Advance Prompt',
    icon: '<i class="icon-magic"></i>',
    undo: true,
    focus: true,
    refreshOnCallback: true,
    callback: function () {
        this.html.insert('<strong>My Custom Thing!</strong>');
    }
});

oc.richEditorButtons.splice(0, 0, 'insertAdvancePrompt');
