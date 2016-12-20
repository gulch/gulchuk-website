$(document).ready(function () {

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
                    segment.find('.dimmer').remove();

                    if (result.success !== 'OK') {
                        showErrorModalMessage(result.message);
                        return;
                    }

                    switch (action_name) {
                        case 'remove':
                            segment.remove();
                            break;
                    }
                }
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


});


/* Модальный диалог ошибки */
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