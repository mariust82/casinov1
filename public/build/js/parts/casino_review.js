initReviewForm();
initReplies();
initTexfieldsLabels();
showMoreReviews();

getWebName = function (name) {
    return name.replace(/\s/g, '-').toLowerCase();
}

var Score = function (obj) {
    var _obj = obj,
        _name = _obj.name,
        _score = _obj.value,
        _request = new XMLHttpRequest;

    var _init = function () {
            _updateScore(_name, _score);
        },
        _updateScore = function (_name, _score) {
            if (BUSY_REQUEST)
                return;
            BUSY_REQUEST = true;
            _request.abort();

            _request = $.ajax({
                url: '/casino/rate',
                data: {
                    name: _name,
                    value: _score
                },
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    if (data.body['success'] == "Casino already rated!") {
                        $(".icon-icon_available").toggleClass("icon-icon_unavailable");
                        $(".icon-icon_unavailable").removeClass("icon-icon_available");
                        $('.thanx').html(data.body['success']);
                    }
                    $('.rating-container').next('.action-field').show();
                },
                error: function (XMLHttpRequest) {
                    if (XMLHttpRequest.statusText != "abort")
                    {
                        console.log('err');
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        };
    _init();
};

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
        _field_name,
        _field_email,
        _field_message,
        _contact_error_required,
        _contact_error_rate,
        _reviewHolder,
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
        _field_name = parent.find('input[name=name]');
        _field_email = parent.find('input[name=email]');
        _field_message = parent.find('textarea[name=body]');
        _contact_error_required = parent.find('.field-error-required');
        _contact_error_rate = parent.find('.field-error-rate');
        _contact_error = parent.find('.field-error');
        name = _field_name.val();
        email = _field_email.val();
        message = _field_message.val();

        casino_name = $('.rating-container').data('casino-name');
        _rate_slider_result = $('.rating-current-value span').text();
        _reviewID = 0;
        ok = true;

        if (parent.data('id') != undefined) {
            _reviewID = parent.data('id');
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
        } else {
            _is_child = false;
            _reviewHolder = $('#review-data-holder');
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
                    //_contact_error.html(_errors_found.join('<br />')).show();
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
                    var pattern;

                    if (_is_child) {
                        pattern = '\
                        <div class="review review-child ' + name.toLowerCase() + '" data-id="' + data.body.id + '" data-img-dir="' + _imgDir + '">\
                            <div class="review-wrap">\
                                <div class="review-info">\
                                    <div class="review-info-top">\
                                        <div class="review-flag">\
                                            <img src="' + _imgDir + '" alt="' + _countryCode + '" width="15" height="12">\
                                        </div>\
                                        <div class="review-info-body">\
                                            <div class="review-name">' + name + '</div>\
                                            <div class="review-date">' + _getCurrDate() + '</div>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="review-body">\
                                    <div class="review-text">\
                                        <p>' + message + '</p>\
                                    </div>\
                                    <div class="review-underline">\
                                        <a href="#" class="review-replies js-reply-btn">Reply</a>\
                                        <div class="votes js-vote">\
                                            <a href="#" class="votes-like vote-button" data-id="' + data.body.id + '">\
                                                <i class="icon-icon_likes"></i>\
                                                <span class="bubble bubble-vote">0</span>\
                                            </a>\
                                        </div>\
                                    </div>\
                                    <div class="review-form">\
                                        <div class="form">\
                                            <div class="form-row">\
                                                <div class="textfield-holder">\
                                                    <textarea rows="5" class="expanding textfield" name="body" placeholder="Write your review..."></textarea>\
                                                </div>\
                                            </div>\
                                            <div class="hidden js-expanding-textfields">\
                                                <div class="form-row form-multicol">\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="name" class="textfield" placeholder="Name">\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="email" class="textfield" placeholder="Email (it won\'t be published)">\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="form-row">\
                                                    <div class="review-submit-holder">\
                                                        <input class="btn" name="submit" type="submit" value="ADD YOUR REPLY">\
                                                        <div>\
                                                            <div class="field-error-required not-valid action-field">\
                                                                Please fill in the required fields.\
                                                            </div>\
                                                            <div class="field-success success action-field">\
                                                                Thank You!\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        ';
                    } else {
                        pattern = '\
                        <div class="review review-parent ' + name.toLowerCase() + '" data-id="' + data.body.id + '">\
                            <div class="review-wrap">\
                                <div class="review-info">\
                                    <div class="review-info-top">\
                                        <div class="review-flag">\
                                            <img src="' + _imgDir + '" alt="' + _countryCode + '" width="15" height="12">\
                                        </div>\
                                        <div class="review-info-body">\
                                            <div class="review-name">' + name + '</div>\
                                            <div class="review-date">' + _getCurrDate() + '</div>\
                                        </div>\
                                    </div>\
                                    <div class="list-rating ' + getWebName(get_rating(_rate_slider_result)) + '">\
                                        <div class="list-rating-wrap">\
                                            <div class="list-rating-score">' + _rate_slider_result + '</div>\
                                            <div class="list-rating-text">' + get_rating(_rate_slider_result) + '</div>\
                                        </div>\
                                    </div>\
                                </div>\
                                <div class="review-body">\
                                    <div class="review-text">\
                                        <p>' + message + '</p>\
                                    </div>\
                                    <div class="review-underline">\
                                        <a href="#" class="review-replies js-reply-btn">Reply</a>\
                                        <div class="votes js-vote">\
                                            <a href="#" class="votes-like vote-button"  data-id="' + data.body.id + '">\
                                                <i class="icon-icon_likes"></i>\
                                                <span class="bubble bubble-vote">0</span>\
                                            </a>\
                                        </div>\
                                    </div>\
                                    <div class="review-form">\
                                        <div class="form">\
                                            <div class="form-row">\
                                                <div class="textfield-holder">\
                                                    <textarea rows="5" class="expanding textfield" name="body" placeholder="Write your review..."></textarea>\
                                                </div>\
                                            </div>\
                                            <div class="hidden js-expanding-textfields">\
                                                <div class="form-row form-multicol">\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="name" class="textfield" placeholder="Name">\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-col">\
                                                        <div class="textfield-holder error">\
                                                            <input type="text" name="email" class="textfield" placeholder="Email (it won\'t be published)">\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="form-row">\
                                                    <div class="review-submit-holder">\
                                                        <input class="btn" name="submit" type="submit" value="ADD YOUR REPLY">\
                                                        <div>\
                                                            <div class="field-error-required not-valid action-field">\
                                                                Please fill in the required fields.\
                                                            </div>\
                                                            <div class="field-success success action-field">\
                                                                Thank You!\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="reply review">\
                            <div class="reply-data-holder"></div>\
                        </div>\
                        ';
                    }
                    return pattern;
                }

                if (_is_child_of_child) {
                    $(getItemPattern()).insertAfter(_this)
                } else {
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

            $('.review-rating', formContainer).addClass('active');
            $('textarea', formContainer).addClass('disabled');
            $('.rating-bar').barrating('set', _storage_review_score);
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

function _getCurrDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

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

function grayscaleIE() {
    if (getInternetExplorerVersion() >= 10) {
        $('img.not-accepted').each(function () {
            var el = $(this);
            el.css({"position": "absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position": "absolute", "z-index": "5", "opacity": "0"}).insertBefore(el).queue(function () {
                var el = $(this);
                el.parent().css({"width": this.width, "height": this.height});
                el.dequeue();
            });
            this.src = grayscaleIE10(this.src);
        });

        function grayscaleIE10(src) {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            var imgObj = new Image();
            imgObj.src = src;
            canvas.width = imgObj.width;
            canvas.height = imgObj.height;
            ctx.drawImage(imgObj, 0, 0);
            var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
            for (var y = 0; y < imgPixels.height; y++) {
                for (var x = 0; x < imgPixels.width; x++) {
                    var i = (y * 4) * imgPixels.width + x * 4;
                    var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
                    imgPixels.data[i] = avg;
                    imgPixels.data[i + 1] = avg;
                    imgPixels.data[i + 2] = avg;
                }
            }
            ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
            return canvas.toDataURL();
        }
        ;
    }
    ;
}

function getInternetExplorerVersion() {
    var rv = -1;
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    else if (navigator.appName == 'Netscape') {
        var ua = navigator.userAgent;
        var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}
