initReviewForm();
initReplies();
initTexfieldsLabels();
showMoreReviews();
initTableOpen();
initAddReview();

getWebName = function (name) {
    return name.replace(/\s/g, '-').toLowerCase();
}

function _getCurrDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) dd='0'+dd;

    if(mm<10) mm='0'+mm;

    return dd + '.' + mm + '.' + yyyy;
}

function get_rating($name) {
    if ($name > 8) {
        $string = 'Excellent';
    } else if ($name > 6 && $name <= 8) {
        $string = 'Very good';
    } else if ($name > 4 && $name <= 6) {
        $string = 'Good';
    } else if ($name > 2 && $name <= 4) {
        $string = 'Poor';
    } else {
        $string = 'Terrible';
    }

    return $string;
}

function AddingReview(obj) {
    this.obj = obj;
    var _wrap = obj,
        _imgDir = $('#reviews-form').data('img-dir'),
        _countryCode = $('#reviews-form').data('country'),
        _send_btn = _wrap.find('input[name=submit]'),
        _qty = $('.reviews-qty'),
        _contact_error_class = 'not-valid',
        _casinoID = $('.reviews-form').data('casino-id'),
        _storage_casino_id_reviewed = localStorage.getItem('casino_' + _casinoID + '_reviewed'),
        _storage_review_score = localStorage.getItem('casino_' + _casinoID + '_score'),
        _reviewID,
        _field_title,
        _field_name,
        _field_email,
        _field_message,
        _contact_error_required,
        _contact_error_rate,
        _reviewHolder,
        title,
        name,
        email,
        message,
        _is_child,
        _is_child_of_child,
        _rate_slider_result,
        _childReplies,
        _request = new XMLHttpRequest();

    _prepReview = function (_self) {
        var parent = _self;
        _field_title = parent.find('input[name=title]');
        _field_name = parent.find('input[name=name]');
        _field_email = parent.find('input[name=email]');
        _field_message = parent.find('textarea[name=body]');
        _contact_error_required = parent.find('.field-error-required');
        _contact_error_rate = parent.find('.field-error-rate');
        _contact_error = parent.find('.field-error');
        title = _field_title.val();
        name = _field_name.val();
        email = _field_email.val();
        message = _field_message.val();

        casino_name = $('.rating-container').data('casino-name');
        _rate_slider_result = $('.rating-container-score-value').text();
        _reviewID = 0;
        ok = true;
        if (parent.data('id') != undefined) {
            _reviewID = parent.data('id');
            console.log(_reviewID + 'ttt');
            _is_child = true;

            if (parent.next().find('.reply-data-holder').length > 0) {
                _reviewHolder = parent.next().find('.reply-data-holder');
                _is_child_of_child = false;
            } else {
                _is_child_of_child = true;
                _reviewID = parent.closest('.reply').prev().data('id');
                _setReviewerName(parent);
                _reviewHolder = parent.closest('.reply-data-holder');
            }
            _childReplies = parent.find('.js-reply-btn span');


            console.log(_reviewID + 't4');
        } else {
            _is_child = false;
            _reviewHolder = $('#review-data-holder');
        }

        // console.log(_reviewID + 't');

        if (title === '') {
            _field_title.parent().addClass(_contact_error_class);
            ok = false;
        } else {
            _field_title.parent().removeClass(_contact_error_class);
        }

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

        if ($('.drag-rate-range-score').html() == '0/10') {
            $('.drag-rate-title').addClass('error');
            ok = false;
        } else {
            $('.drag-rate-title').removeClass('error');
        }

        if (!ok) {
            _contact_error_required.show();
        } else {
            _contact_error.hide();
            _contact_error_required.hide();
        }

        if (!_is_child) {
            if (_rate_slider_result === '0') {
                _contact_error_rate.show();
                parent.find($('.rating-container')).addClass(_contact_error_class);
                ok = false;
            } else {
                _contact_error_rate.hide();
                parent.find($('.rating-container')).removeClass(_contact_error_class);
            }
        }
        function validateEmail(email) {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            return pattern.test(email);
        }
        return ok;
    },
        _setReviewerName = function (parent) {
            var name = parent.find('.review-name').text();
            var pattern = '<strong>@' + name + '</strong> ';

            message = pattern + _field_message.val().substr(name.length + 1);
        },
        _changeName = function () {
            $('#reviews-form input[name=name]').on('keyup', function () {
                $('#reviews-form .review-name').text($(this).val());
            });
        },
        _prepAjaxData = function (_this) {
            var ajaxData = {
                casino: casino_name,
                title: title,
                name: name,
                email: email,
                body: message,
                parent: _reviewID,
                casino_id: $('.reviews-form').attr('data-casino-id')
            };
            _sendReview(ajaxData, _this);
        },
        _sendReview = function (ajaxData, _this) {
            if (BUSY_REQUEST)
                return;
            BUSY_REQUEST = true;
            _request.abort();
            console.log(ajaxData);
            _request = $.ajax({
                url: "/casino/review-write",
                data: ajaxData,
                dataType: 'json',
                timeout: 20000,
                type: 'POST',
                success: function (data) {
                    _loadData(data, _this);
                    _field_name.val('');
                    _field_email.val('');
                    _field_message.val('').addClass('expanding');
                    _onEvents();
                    $('.form .js-expanding-textfields').slideUp();
                },
                error: function (jqXHR) {
                    _errors_found = $.parseJSON(jqXHR.responseText);
                    console.error("Could not send message!");
                    console.log(_errors_found.body.message);
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        },
        _showEmptyMessage = function () {
        _searchListsContainer.parent().hide();
        _searchCasinosContainer.parent().hide();
        _searchPagesContainer.parent().hide();
        _searchEmptyContainer.show();
        _searchAllButton.parent().fadeOut();
    },
        _loadData = function (data, _this) {

            if ($.isEmptyObject(data)) {
                _showEmptyMessage();
            } else {


                function getItemPattern() {
                    var review_element = $('.review-element').clone();

                    if (_is_child) {
                        return setComment(review_element, 'review-child',  name, data.body.id, _imgDir, _countryCode, message, title);
                    } else {
                        return setComment(review_element, 'review-parent', name, data.body.id, _imgDir, _countryCode, message, title);
                    }
                }


                function setComment(review_element, element_class, name, data_id, imgDir, countryCode, message, title ){
                    $(review_element).removeClass('review-element');
                    $(review_element).removeClass('hidden');
                    $(review_element).removeAttr('hidden');
                    $(review_element).addClass(element_class);
                    $(review_element).addClass(name.toLowerCase());
                    $(review_element).addClass('review-parent');
                    $(review_element).attr('data-id', data_id);
                    $(review_element).find('.review-flag img').attr('src', imgDir);
                    $(review_element).find('.review-flag img').attr('alt', countryCode);
                    $(review_element).find('.review-title').removeClass('hidden');
                    $(review_element).find('.review-title').text(title);
                    $(review_element).find('.review-name').text(name);
                    $(review_element).find('.review-date').text(_getCurrDate());
                    $(review_element).find('.review-text').html(message);
                    review_element.find('.js-vote .votes-like').attr('data-id', data_id);

                    if(element_class === 'review-parent'){
                        $(review_element).find('.list-rating').addClass(getWebName(get_rating(_rate_slider_result)));
                        $(review_element).find('.list-rating-score').text(_rate_slider_result);
                        $(review_element).find('.list-rating-text').text(getWebName(get_rating(_rate_slider_result)));
                    }else{
                        $(review_element).find('.list-rating').remove();
                        $(review_element).attr('data-img-dir', _imgDir);
                    }

                    return review_element;
                }

                if (_is_child_of_child) {
                    $(getItemPattern()).insertAfter(_this);
                } else {
                    _reviewHolder.prepend($('.to-clone').clone());
                    _reviewHolder.prepend(getItemPattern());
                }
                _refreshData();
            }
        },
        _refreshData = function () {
            if (!_is_child) {
                _qty.text(parseInt(_qty.text()) + 1);
                localStorage.setItem('casino_' + _casinoID + '_reviewed', 1);
                localStorage.setItem('casino_' + _casinoID + '_score', _rate_slider_result);
            }
            if (_is_child)
                _childReplies.text(parseInt(_childReplies.text()) + 1);

            $('.review-form').slideUp();
            initReviewForm();
            initTexfieldsLabels();

            new Vote($('.js-vote'));

            $('.review, .reply').each(function () {
                new AddingReview($(this));
            });

            grayscaleIE();
        },
        _doIfReviewedAlready = function () {
            var formContainer = $('#reviews-form');

            $(formContainer).addClass('reviewed');
            $('textarea', formContainer).addClass('disabled');
            $('.rating-current-value span').text(_storage_review_score);
            $('textarea[name=body]', formContainer).attr('placeholder', 'You have already reviewed');
        },
        _initForms = function () {
            _send_btn.off();
            _send_btn.on({
                'click': function (e) {
                    var error = _prepReview(_wrap);

                    if (error === false) {
                        e.stopPropagation();
                    } else {
                        _prepAjaxData(_wrap);
                    }
                }
            });
        },
        _onEvents = function () {
            if (_storage_casino_id_reviewed) {
                _doIfReviewedAlready();
                _initForms();
            } else {
                _initForms();
                _changeName();
            }
        },
        _onEvents();
}

function showMoreReviews() {
    var _btn = $('.js-more-reviews');
    var _totalReviews = _btn.data('reviews');
    var _holderParent = $('#review-data-holder');
    var _holderMoreChild = $('.reply-data-holder');
    var _name = $('.rating-container').data('casino-name');
    var _request = new XMLHttpRequest;
    _btn.on('click', function () {
        _addReviews($(this), $(this).data('type'));
        return false;
    });

    if ($(".not-accepted").length) {
        _btn.css("pointer-events", "auto");
    }

    var _addReviews = function (_this, _type) {
            if (BUSY_REQUEST)
                return;
            BUSY_REQUEST = true;
            _request.abort();
            _request = $.ajax({
                url: '/casino/more-reviews/' + getWebName(_name) + '/' + _this.data('page'),
                dataType: 'HTML',
                data: {
                    id: _this.data('id'),
                    type: _type
                },
                type: 'GET',
                success: function (data) {

                    if (_type == 'review') {
                        _holderParent.append(data);
                        if (_this.data('page') >= (_this.data('total') / 5) - 1) {
                            _this.hide();
                        }
                    } else if (_type == 'reply') {
                        _this.closest('.reply').find(_holderMoreChild).append(data);
                    }

                    if (_this.data('page') >= (_this.data('total') / 5) - 1) {
                        _this.hide();
                    }

                    var _page = _this.data('page');

                    _this.data('page', ++_page);

                    _refreshData();

                    showMoreReviews();
                },
                error: function (XMLHttpRequest) {
                    if (XMLHttpRequest.statusText != "abort") {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        },
        _refreshData = function () {
            // initReplies();
            initReviewForm();
            initTexfieldsLabels();

            Vote($('.js-vote'));

            $('.review').each(function () {
                new AddingReview($(this));
            });
            grayscaleIE();
        };
}

function initReviewForm() {
    var field = $('.expanding');
    var hiddenBlocks = $('.js-expanding-textfields');

    if ($('.box img.not-accepted').length) {
        field.unbind("mouseenter mouseleave mouseover click focus");
    } else {
        field.on('focus', function () {
            $(this).removeClass('expanding');
            $(this).closest('.form').find(hiddenBlocks).slideDown();
        });
    }
}

function initTexfieldsLabels() {
    var field = $('.textfield');

    field.focus(function () {
        $(this).parent().addClass('active').removeClass('not-valid');
    });

    field.blur(function () {
        if ($(this).val() == '') {
            $(this).parent().removeClass('active');
        }
    });
}

function initReplies() {
    $('#reviews').on('click', '.js-reply-btn', function (e) {
        var replyReview = $(this).closest('.reply.review');
        if (replyReview.length > 0 && replyReview.find('.reply-data-holder').length > 0) {
            var userName = $(this).parent().parent().parent().find('.review-name').text();
            $(this).parent().parent().find('textarea').val('@' + userName + ' ');
        }
        $(this).parent().next().slideToggle();

        return false;
    });
}

function initTableOpen() {
    $('.js-table-package-opener').on('click', function (e) {
        $(this).closest('tr').toggleClass('active');
        e.preventDefault();
    });
}

function initScrollTo(_target, _offset) {

    if (typeof _target !== "undefined") {
        action(_target, _offset);
    } else {
        var btn = $('.js-scroll');

        btn.on('click', function (a) {
            var target = $($(this).attr('href'));

            action(target, 0);

            a.preventDefault();
        });
    }

    function action(target, offset) {
        $('html, body').animate({
            scrollTop: target.offset().top - offset
        }, 1000);
    }
}

function initAddReview(){
    $('.review').each(function () {
        new AddingReview($(this));
    });
}


