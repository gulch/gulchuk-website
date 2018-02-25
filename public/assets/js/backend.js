/* To Translit Function */
var toTranslit = function (text) {
    return text.replace(/([а-яё])|([\s_-])|([^a-z\d])/gi,
        function (all, ch, space, words, i) {
            if (space || words) {
                return space ? '-' : '';
            }
            var code = ch.charCodeAt(0),
                index = code == 1025 || code == 1105 ? 0 :
                    code > 1071 ? code - 1071 : code - 1039,
                t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                    'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                    'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                    'shch', '', 'i', '', 'e', 'yu', 'ya'
                ];
            return t[index];
        });
};

var putCount = function ($elem) {
    if ($elem.length > 0) {
        $elem.closest('.field').find('.counter').html($elem.val().length);
    }
}


/* Document Ready JQuery Handler */
$(document).ready(function () {

    putCount($('textarea[name="seo_keywords"]'));
    putCount($('textarea[name="seo_description"]'));
    putCount($('input[name="seo_title"]'));
    $('textarea[name="seo_keywords"], textarea[name="seo_description"], input[name="seo_title"]').on('keyup', function () {
        var $elem = $(this);
        putCount($elem);
    });

    $('select[name="article_tags[]"]').dropdown();

    $('.ui.checkbox').checkbox();

    /* Action elements */
    $('span[data-action], a[data-action], div[data-action]').on('click', function () {
        var elem = $(this);
        var action = elem.attr('data-action');
        var action_name = elem.attr('data-action-name');
        var segment = elem.closest('div[data-action-element]');
        if (!segment.length) {
            segment = elem.closest('.segment');
        }

        var method = 'POST';
        if (elem.attr('data-method')) {
            method = elem.attr('data-method');
        }

        if (!action) {
            return;
        }

        segment.addClass('ui basic segment');
        segment.append("<div class=\"ui active inverted dimmer\"><div class=\"ui text loader\">Please wait</div></div>");

        $.ajax({
            url: action,
            type: method,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (result) {
                if (result) {

                    if (result.success !== 'OK') {
                        showErrorModalMessage(result.message);
                        return;
                    }

                    switch (action_name) {
                        case 'remove':
                            segment.remove();
                            break;
                        case 'publish':
                        case 'unpublish':
                        case 'generate-social-image':
                            elem[0].outerHTML = '<span><i class="check icon"></i>' + result.message + '</span>';
                            break;
                    }
                }
            },
            error: function (request, status) {
                if (status == "timeout") {
                    showErrorModalMessage("Request time is out.");
                } else {
                    showErrorModalMessage("Undefined error.");
                }
            },
            complete: function () {
                segment.find('.dimmer').remove();
            }
        });
    });

    /* Custom popups */
    $('a[data-popup="1"]').each(function () {
        var $popup = $(this);
        $popup.popup({
            popup: $popup.closest('div').find('.custom.popup'),
            on: 'click'
        });

        $popup.closest('div').find('.custom.popup .button').click(function () {
            $popup.popup('hide');
        });
    });

    /* Activate Submit Buttons */
    saveFormActivation();

    /* generate slug button click handler */
    $('#translit-button').click(function () {
        var title = $('input[name="title"]').val();
        if (title.length) {
            $('input[name="slug"]').val(toTranslit(title).toLowerCase());
        }
    });

    // Init wysiwyg editor
    if ($('.wysiwyg-editor').length) {

        $('.wysiwyg-editor').froalaEditor({
            htmlAllowComments: false,
            htmlExecuteScripts: false,
            htmlAllowedEmptyTags: ['i'],

            linkAlwaysBlank: true,
            linkAlwaysNoFollow: false,
            linkNoReferrer: false,
            linkNoOpener: true,

            imageUploadURL: $('.wysiwyg-editor').attr('data-upload-url'),
            imageUploadParams: {
                setup: 'editor'
            }
        });

        /*$('.fr-box a:contains("Unlicensed")').parent().remove();*/
    }

});


function saveFormActivation() {

    $('#save-button').click(function () {
        saveFormHandler($(this), false);
    });

    $('#save-n-close-button').click(function () {
        saveFormHandler($(this), true);
    });

}

function saveFormHandler($btn, withRedirect) {

    withRedirect = withRedirect || false;

    var form = $btn.closest('form');

    form.append("<div class=\"ui active inverted dimmer\"><div class=\"ui loader\"></div></div>");

    var form_data = form.serialize();

    if (withRedirect) {
        form_data += '&redirect_url=' + form.find('input[id="redirect_url"]').val();
    }

    $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: form_data,
        dataType: "json",
        timeout: 10000,
        success: function (result) {
            if (result.success == 'OK') {
                if (result.redirect) {
                    window.location.href = result.redirect;
                }
                if (result.id) {
                    if (!form.find('input[name="id"]').length) {
                        $('<input>').attr({
                            type: 'hidden',
                            value: result.id,
                            name: 'id'
                        }).appendTo('form');
                    }
                }
            }
            if (result.message) {
                form.find('.save-message').html(result.message).removeClass('display-none').removeClass('hide');
            }
        },
        error: function (request, status) {
            if (status == "timeout") {
                showErrorModalMessage("Request time is out.");
            } else {
                showErrorModalMessage("Undefined error.");
            }
        },
        complete: function () {
            form.find('.dimmer').remove();
        }
    });
}


/* Modal Error Message */
function showErrorModalMessage(message, text, icon) {
    if (message == undefined) {
        message = 'UNKNOWN ERROR';
    }
    if (icon == undefined) {
        icon = 'orange warning sign';
    }
    if (text == undefined) {
        text = 'ERROR';
    }
    var key = Math.floor(Math.random() * 1000);
    $(document.body).append(
        '<div id="errormodal_' + key + '" class="ui small modal">' +
        '<i class="remove close icon"></i>' +
        '<div class="header"><i class="' + icon + ' circle middle big icon"></i>' + text + '</div>' +
        '<div class="content"><p>' + message + '</p></div>' +
        '<div class="actions">' +
        '<div class="ui large basic button">OK</div>' +
        '</div>' +
        '</div>');
    $('#errormodal_' + key).modal({allowMultiple: false}).modal('show');
    $('#errormodal_' + key + ' .button').click(function () {
        $(this).closest('.modal').modal('hide').remove();
    });
}