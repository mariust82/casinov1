var Vote = function (obj) {
    var _obj = obj,
        _trigger = _obj.find('.vote-button'),
        _request = new XMLHttpRequest;

    var _init = function () {
            _trigger.off();
            _trigger.on('click', function () {
                var _id = $(this).data('id');
                var _success = $(this).data('success');
                var _target = $(this).data('type');

                _updateVote($(this), _getTarget(_target), _getData(_target, _id, _success));

                return false;
            });

        },
        _getData = function (_target, _id, _success) {
            return {id: _id, is_like: _success};
        },

        _getTarget = function (_arg) {
            var _target = '/casino/review-like';
            if (_arg === 'article') {
                _target = '/blog/rate';
            }
            return _target;
        },
        _updateVote = function (_this, _target, _data) {
            if (BUSY_REQUEST)
                return;
            BUSY_REQUEST = true;
            _request.abort();

            _request = $.ajax({
                url: _target,
                data: _data,
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    if (_target === '/casino/review-like') {
                        if (data.body.status == 'not_ok') {
                            console.log(data.body.message);
                        } else {
                            var _holderLikes = $(_this).find('.bubble-vote');
                            var _oldLikes = _holderLikes.text();
                            _holderLikes.text(++_oldLikes);
                        }
                        _this.closest(_obj).next('.action-field.success').show();
                    } else if (_target === '/blog/rate') {
                        $(_this.parent().parent()).find('.votes-like .vote-block-num, .like .vote-block-num').text(data.body.likes);
                        $(_this.parent().parent()).find('.votes-dislike .vote-block-num, .dislike .vote-block-num').text(data.body.dislikes);

                        _this.closest(_obj).next('.action-field.success').show();
                    }
                },
                error: function (XMLHttpRequest) {
                    var msg = jQuery.parseJSON(XMLHttpRequest.responseJSON.body.message)[0];
                    if (XMLHttpRequest.statusText != "abort") {
                        __this.closest(_obj).next('.action-field.not-valid').show();
                    }
                },
                complete: function () {
                    BUSY_REQUEST = false;
                }
            });
        };
    _init();
};
