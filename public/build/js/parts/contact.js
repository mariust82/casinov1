function handleContactUs(obj) {
    console.log('123');
    var _wrap = obj,
        _field_name = $('.contact-name'),
        _field_email = $('.contact-email'),
        _field_message = $('.contact-message'),
        _contact_btn = $('.contact-btn'),
        _contact_success = $('#contact-us-success'),
        _contact_error = $('#contact-us-note'),
        _server_error = $('#server-error-note'),
        _contact_error_class = 'not-valid',
        name,
        email,
        message,
        _request = new XMLHttpRequest();

    _prepContact = function () {
        name = _field_name.val();
        email = _field_email.val();
        message = _field_message.val();
        ok = true;
        if (name === '') {
            _field_name.parent().addClass(_contact_error_class);
            ok = false;
        } else {
            _field_name.parent().removeClass(_contact_error_class);
        }
        if (email === '' || !validateEmail(email)) {
            _field_email.parent().addClass(_contact_error_class);
            ok = false;
        } else {
            _field_email.parent().removeClass(_contact_error_class);
        }
        if (message === '') {
            _field_message.parent().addClass(_contact_error_class);
            ok = false;
        } else {
            _field_message.parent().removeClass(_contact_error_class);
        }

        if (!ok) {
            _contact_error.show();
        } else {
            _contact_error.hide();
        }

        return ok;
    },
        _sendMessage = function (name, email, message) {
            _request.abort();
            _request = $.ajax({
                url: "/contact/send",
                data: {
                    name: name,
                    email: email,
                    message: message
                },
                dataType: 'json',
                timeout: 20000,
                type: 'POST',
                success: function (response) {
                    if (response.status == "ok") {
                        _contact_success.show();
                        _contact_error.hide();
                        _server_error.hide();
                        _contact_btn.prop('disabled', true);
                        _field_name.val('');
                        _field_email.val('');
                        _field_message.val('');
                        _onEvents();
                    }
                    else if (response.status == "error") {
                        // console.error(response.body);
                        var arr = JSON.parse(response.body);

                        _server_error.show();
                    }
                },
                error: function (XMLHttpRequest) {
                    console.error("Could not send message!");
                }
            });
        },
        _onEvents = function () {
            _contact_btn.on({
                'click': function (e) {
                    var error = _prepContact();

                    if (error === false) {
                        e.stopPropagation();
                    } else {
                        _sendMessage(name, email, message);
                    }
                }
            });
        },
        _init = function () {
            _onEvents();
        };

    _init();
}