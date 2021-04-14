var ListFilters = function (obj) {

    var _obj = obj,
            _self = this,
            _switchers = _obj.find('input[type=checkbox]'),
            _radios = _obj.find('input[type=radio]'),
            _selectFilter = _obj.find($('.filter-filter .select, .filter-select-holder .select')),
            _targetContainer = $('.data-container'),
            _targetAddContainer = $('.list-body'),
            _paramName = _targetContainer.data('type'),
            _paramValue = _targetContainer.data('type-value'),
            _ajaxContent = $('.aj-content'),
            _emptyContent = $('.empty-filters'),
            _listHolder = _obj.next('.data-container-holder'),
            _loaderHolder = _listHolder.find('.holder'),
            _moreButton,
            _resetButton,
            _itemsPerPage = 25,
            _request = new XMLHttpRequest();


    if (typeof _paramName == 'undefined') {
        _paramName = 'game_type';
    }

    _url = _obj.data('url');

    _switchers.prop('checked', false);
    
    var CloseTFPopup = function () {
        $('.close_tf_wrap').on('click', function (e) {
            console.dir($(this).parent().parent().parent());
            $(this).parent().parent().parent().remove();
            e.stopPropagation();

        });
    }

    var ShowTFPopup = function () {
        $(".tf_flex").on('click', function () {
            var id = $(this).data('id');
            var _this = $(this);
            $.ajax({
                url: '/timeframe-tooltip',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'html'
            })
                    .done(function (data) {
                        $(".software-tooltipster").remove();
                        _this.append(data);
                        CloseTFPopup();

                    });
        });
    }

    var _onEvent = function () {
        _moreButton = $('.js-more-items');
        _resetButton = $('.js-reset-items');
        _switchers.off();
        _switchers.on('click', function () {
            _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace', this);
        });

        _radios.off();
        _radios.on('click', function () {
            _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue), 'replace', this);
        });

        $('.js-filter > option').on('click', function () {
            var counter = 0;
            $('.js-filter > option').each(function (index, el) {
                if ($(this).prop("selected")) {
                    counter++;
                }
            });
        });

        _selectFilter.off();
        _selectFilter.on('change', function () {
            processCheckboxes(this);
            if (typeof resetGameItemsCounter === "function") {
                resetGameItemsCounter();
            }
            _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, '', this), 'replace', this);
        });

        _moreButton.off();
        _moreButton.on('click', function () {
            _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, 'add', this), 'add', this);
            return false;
        });

        _resetButton.off();
        _resetButton.on('click', function () {
            _ajaxRequestCasinos(_getAjaxParams(_paramName, _paramValue, 'reset'), 'add', this);

            return false;
        });
    },
    
    _getAjaxParams = function (_paramName, _paramValue, _action, _this) {

        var _ajaxDataParams = {
            list_view: _listHolder.attr('data-view')
        };
        
        $.each(_switchers, function (index, el) {
            if ($(el).is(':checked')) {
                _ajaxDataParams[$(el).attr('name')] = 1;
                if (typeof resetGameItemsCounter === "function") {
                    resetGameItemsCounter();
                }
            }

            if (_action == 'reset') {
                _ajaxDataParams[$(el).attr('name')] = '';
                $(el).prop('checked', false);
            }
        });

        $.each(_radios, function (index, el) {
            if ($(el).is(':checked')) {
                _ajaxDataParams[$(el).attr('name')] = $(el).attr('value');
            }

            if (_action == 'reset') {
                _ajaxDataParams[$(el).attr('name')] = 1;
                if (index == 0) {
                    $(el).prop('checked', true);
                }
            }
        });

        _ajaxDataParams[_paramName] = _paramValue;
        $.each(_selectFilter, function (index, el) {
            if ($(el).val() != 'undefined' && $(el).val() != null) {
                /* console.log($(el).attr('name'));
                console.log($(el).val().join());*/
                _ajaxDataParams[$(el).attr('name')] = $(el).val().join();
            }
        });

        if (_selectFilter.val() != 'undefined' && _selectFilter.val() != null) {
            _itemsPerPage = 12;

            if (_action == 'reset') {
                _ajaxDataParams['software'] = '';
                _ajaxDataParams['features'] = '';
                _ajaxDataParams['themes'] = '';
            }
            /*if (typeof _ajaxDataParams['software'] === 'undefined' && typeof $('.data-container').data('software') !== 'undefined')
            {
                _ajaxDataParams['software'] = $('.data-container').data('software');
            }*/
        } /*else {
            _ajaxDataParams['software'] = $('.data-container').data('software');
        }*/

        _targetAddContainer = $(_this).closest('.container').find('.data-add-container:first');

        _ajaxDataParams['offset'] = _action == 'add' ? $(_targetAddContainer).children().length : 0;

       // console.log(_ajaxDataParams);

        if (typeof AJAX_CUR_PAGE == "undefined")
            AJAX_CUR_PAGE = 0;
        AJAX_CUR_PAGE++;
        if (_action != 'add' || _action == 'reset') {
            AJAX_CUR_PAGE = 0;
        }

        /* if (sortMode != _ajaxDataParams['sort']) {
            if (typeof resetGameItemsCounter === "function") {
                resetGameItemsCounter();
            }
        }

        if (path === '/best-online-slots')
            gameItemsBoxCounter = 5; */

        return _ajaxDataParams;
    },
    
    _ajaxRequestCasinos = function (_ajaxDataParams, _action, _this) {
        /* if (allGameItemsReceived) {
            if (typeof updateGameItemsCounters === "function") {
                updateGameItemsCounters();
            }
            return;
        }*/

       // console.log();

        $('.overlay, .loader').fadeIn('fast');

        if (BUSY_REQUEST)
            return;
        BUSY_REQUEST = true;
        _request.abort();

/*        var theme = window.location.pathname.split('themes/');
        if (typeof _ajaxDataParams['themes'] == 'undefined') {
            if (theme.length == 2)
                _ajaxDataParams['themes'] = theme[1];
        } else {
            var _themesArray = _ajaxDataParams['themes'].split(',');
            _themesArray.push(theme[1]);
            _ajaxDataParams['themes'] = _themesArray.join(',');
        }*/
        _ajaxDataParams['url'] = window.location.pathname;
        //sortMode = _ajaxDataParams['sort'];

        _request = $.ajax({
            url: _url + AJAX_CUR_PAGE,
            data: _ajaxDataParams,
            dataType: 'html',
            type: 'GET',
            success: function (data) {
              //  _targetAddContainer = $(_this).closest('.container').find('.data-add-container:first');
                var scrollPos = $(document).scrollTop();
                var cont = $(data).find('.loaded-item');
                var loadTotal = $(data).filter('[data-load-total]').data('load-total');
                var totalItems = $(data).find('.qty-items').data('load-total');

                if (_url === '/tournaments-filter/') {
                    cont = $(data).find('.list-item-tournament');

                    if (_action == "add") {
                        $('.list-body').append(data);
                    } else {
                        $('.list-body').html(data);
                    }
                    if (cont.length === 0) {
                        _emptyContent.show();
                    } else {
                        _emptyContent.hide();
                    }

                    if (cont.length < 10 || cont.length === _targetAddContainer.data('total')) {
                        _moreButton.hide();
                    } else {
                        _moreButton.show();
                    }
                    var total = $('.total').data('total');
                    $('.qty-items').text(total + " results");
                } else if (_url === '/no-deposit-slots-filter/') {
                    var total = $('.qty-items').data('load-total');
                    cont = $(data).find('.edges');
                    if (_action == "add") {
                        $('.casinos-list').append(data);
                    } else {
                        $('.holder').html(data);
                    }

                    if (cont.length == 0) {
                        _moreButton.hide();
                        _loaderHolder.hide();
                        _emptyContent.show();
                    } else {
                        _moreButton.show();
                        _loaderHolder.show();
                        _emptyContent.hide();
                    }
                    if (total === $('.casinos-list').find('.edges').length) {
                        $('.btn-holder').hide();
                    } else {
                        $('.btn-holder').show();
                    }

                    if ($.fn.tooltipster) {
                        $('.js-tooltip').tooltipster(tooltipConfig);
                        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
                        $('.js-tooltip-content-popup').tooltipster(contentTooltipConfigPopup);
                    }
                    //initMoboleBonusesPop(ww);
                } else {


                    if (_action == 'replace') {
                        _targetContainer.html('');
                        _targetContainer.html(data);
                        //_targetAddContainer.html('');

                        if (_ajaxDataParams['game_type'] == "Best" && loadTotal > 100) {
                            $('.qty-items span').text(100);
                        } else {
                            $('.qty-items span').text(loadTotal);
                        }

                        if (loadTotal > 0) {
                            // $('[data-total]').data('total', loadTotal);
                        }

                        if (cont.length == 0) {
                            _moreButton.hide();
                            _loaderHolder.hide();
                            _emptyContent.show();
                        } else {
                            _moreButton.show();
                            _loaderHolder.show();
                            _emptyContent.hide();
                        }
                    } else {
                     //   console.log(_this);
                        if ($('.games-list').hasClass('list-view')) {
                            _targetAddContainer.addClass('list-view');
                        }

                        _targetAddContainer.append(cont);
                    }

                    if (_url === '/slots-filter/') {
                        $('.categories').remove();
                        $(data).insertAfter('#filters');
                    }

                    if (_url === '/software-filter/') {
                        is_options_loaded = false;
                        UpdateSelectFilter(_this);
                    }

                    var itemsNumberLoaded = $('.holder .loaded-item').length;
                    _construct();
                    if ($.fn.tooltipster) {
                        $('.js-tooltip').tooltipster(tooltipConfig);
                        $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                        $('.js-tooltip-content').tooltipster(contentTooltipConfig);
                        $('.js-tooltip-content-popup').tooltipster(contentTooltipConfigPopup);
                    }
                    //initMoboleBonusesPop(ww);

                    checkStringLength($('.data-add-container .bonus-box, .data-container .bonus-box'), 21);


                    if (loadTotal <= itemsNumberLoaded) {
                        if (_url === '/real-money-slots')
                            _moreButton.hide();
                        else{
                           // allGameItemsReceived = true;
                        }

                    }
                    gameItemsTotalResult = parseInt($('.qty-items span').text());

                    if (typeof updateGameData == 'function') {
                        updateGameData();
                    }
                    // gridViewBoxPopup();
                }
                
                if (_url === '/casinos-filter/') {
                    ShowTFPopup();
                    CloseTFPopup();
                    copyToClipboard();
                }
                
                if($('.list-body').children().length >= totalItems) {
                    _moreButton.hide();
                }
                //imageDefer("lazy_loaded");
                if ($.fn.tooltipster) {
                    $('.js-tooltip').tooltipster(tooltipConfig);
                    $('.js-copy-tooltip').tooltipster(copyTooltipConfig);
                    $('.js-tooltip-content').tooltipster(contentTooltipConfig);
                    $('.js-tooltip-content-popup').tooltipster(contentTooltipConfigPopup);
                }
                window.onbeforeunload = function () {
                    resetFilter();
                }
                $(document).scrollTop(scrollPos);
            },
            error: function (XMLHttpRequest) {
                if (XMLHttpRequest.statusText != "abort") {
                    console.log('err');
                }
            },
            complete: function () {
                BUSY_REQUEST = false;
                $('.overlay, .loader').fadeOut('fast');
            }
        });

        var loadDelay = setTimeout(function () {
        }, 300);

        _hideLoading = function () {
            clearTimeout(loadDelay);
        }
    },
    
    _construct = function () {
        _onEvent();
        _obj[0].obj = _self;
    };

    _construct();
};

$('.sort-label').click(function () {
    $('.filter-sort-buttons input[type=text]').prop('checked', false);
    $(this).prev().prop('checked', true);
});

setTimeout(function () {
    $('.filter-check').find('input').prop('checked', false);
}) // reset filter's checkboxes by clicking "back" button

function select2tags() {
    prepareSelectFilter();
    var tags = [],
            placeholder = 'Select an option';

    $(".select2").each(function (i) {
        $t = $(this).attr("data-select", i);

        $t.select2({
            id: -1,
            placeholder: placeholder
        })
        .on("select2:select", function (e) {
            var selected = {
                value: e.params.data.text,
                select: $(this).attr("data-select")
            };
            tags.push(selected);

            $(this).next().find('.select2-selection__custom').html(selected.value + ' (' + $(this).val().length + ')');

            displayTags();
        })
        .on("select2:unselect", function (e) {
            var selected = {
                value: e.params.data.text,
                select: $t.attr("data-select")
            };

            foundObj = findObjectByKey(tags, "value", selected.value);
            indexToDelete = tags.indexOf(foundObj);
            tags.splice(indexToDelete, 1);

            val = $(this).val()[0] == undefined ? placeholder : $(this).val()[0] + ' (' + $(this).val().length + ')'
            $(this).next().find('.select2-selection__custom').html(val);

            displayTags();

            setTimeout(function () {
                $('.select2-dropdown').parent().remove();
            }, 1);
        });

        // Adding Fake Selection Placeholder
        $('<div class="select2-selection__custom">' + placeholder + '</div>').appendTo($t.next().find('.select2-selection'));
    });


    // DELETE TAGS
    $(".tags-area").on("click", ".tag", function () {
        var selected = {
            value: $(this).find(".value").text(),
            select: $(this).attr("data-select")
        };

        foundObj = findObjectByKey(tags, "value", selected.value);
        indexToDelete = tags.indexOf(foundObj);

        tags.splice(indexToDelete, 1);

        values = $('select[data-select="' + selected.select + '"]').val();
        values.splice(values.indexOf(selected.value), 1);

        $('select[data-select="' + selected.select + '"]').val(values).trigger('change');

        val = values[0] == undefined ? placeholder : values[0] + ' (' + values.length + ')'
        $('select[data-select="' + selected.select + '"]').next().find('.select2-selection__custom').html(val);

        $(this).remove();
        return false;
    });

    // DISPLAY TAGS
    function displayTags() {
        $(".tags-area").html("");

        for (i = 0; i < tags.length; i++) {
            $('<a href="#" class="tag" data-select="' + tags[i].select + '"><span class="value">' + tags[i].value + "</span></a>").appendTo($(".tags-area"));
        }
    }
}

function findObjectByKey(array, key, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return array[i];
        }
    }
    return null;
}

var is_options_loaded = false;

if ($.fn.select2) {
    // select2tags();

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        setTimeout(customSelectFunc, 4000);
    } else {
        customSelectFunc();
    }

    setTimeout(function () {
        $(".player iframe ").css("opacity", "1");
    }, 1500);
    
    if ($(window).width() < 1025) {
        if (!is_options_loaded) {
            prepareSelectFilter();
        }
    } else {
        $(document).on('mousemove touchstart', function () {
            if (!is_options_loaded) {
                prepareSelectFilter();
            }
        });
    }
}

var options = ['software', 'features', 'themes'];
var software_element = $('.select.software');
var features_element = $('.select.features');
var themes_element = $('.select.themes');

var software_placeholder = 'Software';
var features_placeholder = 'Features';
var themes_placeholder = 'Themes';

function UpdateSelectFilter(_this) {
    if (!is_options_loaded) {
        // console.dir('loaded again');
        is_options_loaded = true;
        var theme = "";
        if (window.location.pathname.indexOf('themes/') > -1) {
            theme = window.location.pathname.split('themes/')[1];
        }
        var type = $('.data-container').data('type-value');
        var software = $('.data-container').data('software');
        var selected_feature = $('.features  option:selected').text().split('|')[0];
        var selected_theme = $('.themes  option:selected').val();
        var selected_software = $('.software  option:selected').val();
        theme = (typeof selected_theme === 'undefined') ? theme : selected_theme;
        software = (typeof selected_software === 'undefined') ? software : selected_software;
        var pageNewSlots = window.location.pathname === '/new-online-slots'? 1:0;

        if (typeof selected_software === 'undefined' && $(_this).attr('name') != 'software') {
            $.ajax({
                url: '/filter-software',
                type: 'GET',
                data: {
                    type: type,
                    theme: theme,
                    selected_feature: selected_feature,
                    pageNewSlots: pageNewSlots
                },
                dataType: 'html'
            })
            .done(function (data) {
                $('#filters .select.software').html(data);
            })
            .fail(function () {
                // console.log("error");
            })
            .always(function () {
                // console.log("complete");
            });
        }


        /*if (selected_feature === '' && $(_this).attr('name') != 'features') {
            $.ajax({
                url: '/filter-features',
                type: 'GET',
                data: {
                    type: type,
                    theme: theme,
                    software: software,
                    pageNewSlots: pageNewSlots
                },
                dataType: 'html'
            })
            .done(function (data) {
                $('#filters .select.features').html(data);
            })
            .fail(function () {
                // console.log("error");
            })
            .always(function () {
                // console.log("complete");
            });
        }

        if (typeof selected_theme === 'undefined' && $(_this).attr('name') != 'themes') {
            $.ajax({
                url: '/filter-themes',
                type: 'GET',
                data: {
                    type: type,
                    software: software,
                    selected_feature: selected_feature,
                    theme: theme,
                    pageNewSlots: pageNewSlots
                },
                dataType: 'html'
            })
            .done(function (data) {
                $('#filters .select.themes').html(data);
            })
            .fail(function () {
                // console.log("error");
            })
            .always(function () {
                // console.log("complete");
            });
        }*/
    }

}

function prepareSelectFilter() {
    if (!is_options_loaded) {
        // console.dir('loaded2');
        is_options_loaded = true;
        var theme = "";
        if (window.location.pathname.indexOf('themes/') > -1) {
            theme = window.location.pathname.split('themes/')[1];
        }
        // console.dir(theme);
        var type = $('.data-container').data('type-value');
        var software = $('.data-container').data('software');
        var pageNewSlots = window.location.pathname === '/new-online-slots'? 1:0;

        var filter = $('#filters').data('filter');
        var entity = $('#filters').data('entity');

        if(filter != undefined) {
            //  console.dir(type);
            $.ajax({
                url: '/filter-software',
                type: 'GET',
                data: {
                    filter: filter,
                    entity: entity
                },
                dataType: 'html'
            })
            .done(function (data) {
                $('#filters .select.software').append(data);
            })
            .fail(function () {
                // console.log("error");
            })
            .always(function () {
                // console.log("complete");
            });
        }

    /*    $.ajax({
            url: '/filter-features',
            type: 'GET',
            data: {
                type: type,
                theme: theme,
                software: software,
                pageNewSlots: pageNewSlots
            },
            dataType: 'html'
        })
        .done(function (data) {
            $('#filters .select.features').append(data);
        })
        .fail(function () {
            // console.log("error");
        })
        .always(function () {
            // console.log("complete");
        });

        $.ajax({
            url: '/filter-themes',
            type: 'GET',
            data: {
                type: type,
                software: software,
                theme: theme,
                pageNewSlots: pageNewSlots
            },
            dataType: 'html'
        })
        .done(function (data) {
            $('#filters .select.themes').append(data);
        })
        .fail(function () {
            // console.log("error");
        })
        .always(function () {
            // console.log("complete");
        });*/
    }

}

function filtesrAjax(cb) {

}

function customSelectFunc() {
    $.fn.select2.amd.require([
        'select2/selection/single',
        'select2/selection/placeholder',
        'select2/selection/allowClear',
        'select2/dropdown',
        'select2/dropdown/search',
        'select2/dropdown/attachBody',
        'select2/utils'
    ], function (SingleSelection, Placeholder, AllowClear, Dropdown, DropdownSearch, AttachBody, Utils) {

        var SelectionAdapter = Utils.Decorate(
                SingleSelection,
                Placeholder,
                SelectionAdapter,
                AllowClear
                );

        var DropdownAdapter = Utils.Decorate(
                Utils.Decorate(
                        Dropdown,
                        DropdownSearch
                        ),
                AttachBody
                );

        for (var i = 0; i < options.length; i++) {
            window[options[i] + '_element'].select2({
                theme: 'default drop_' + i,
                placeholder: window[options[i] + '_placeholder'],
                selectionAdapter: SelectionAdapter,
                dropdownAdapter: DropdownAdapter,
                allowClear: true,
                matcher: matchCustom,
                templateResult: function (data, i) {
                    $('.select2-results__options').niceScroll({
                        cursorcolor: "#A8AEC8",
                        cursorwidth: "3px",
                        autohidemode: false,
                        cursorborder: "1px solid #A8AEC8",
                        horizrailenabled: false,
                    });
                    if (!data.id) {
                        return data.text;
                    }

                    var $res = $('<div></div>');
                    var $res1 = $('<span></span>');
                    var $res2 = $('<span></span>');
                    var result = data.text.split('|');

                    $res1.text(result[0]);
                    $res2.text(result[1]);
                    $res1.addClass('wrap');
                    $res2.addClass('soft_count');
                    $res.append($res1);
                    $res.append($res2);
                    return $res;
                },
                // templateSelection: function (data) {
                //     if (!data.id) {
                //         return data.text;
                //     }
                //     var selected = window[options[i]+'_element'].val();
                //     selected = selected.join(', ');
                //     return selected;
                // }
            });
        }

        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            // if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1 || data.selected) {
            //     var modifiedData = $.extend({}, data, true);
            //     modifiedData.text;

            //     // You can return modified objects from here
            //     // This includes matching the `children` how you want in nested data sets
            //     // return modifiedData;
            //     return data;
            // }
            if (!params.term.toLowerCase() || params.term.toLowerCase().trim() === '' || data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                return data;
            }
            // Return `null` if the term should not be displayed
            return null;
        }
    });
}
;

function resetFilter(_select) {
    var $select = $(_select) || $(".select");
    var selectName = $select.attr('name');

    $select.val(null).trigger('change').select2('close');
    $('.select2-results__options').children().attr('aria-selected', false);

    $('.select2-selection__rendered').text('Software');
   // $('.' + selectName + '+.select2 .select2-selection__rendered').html(window[selectName + '_placeholder']);

}

function initCustomSelect() {
    var _filterOptions = $('.js-filter > option');

    $('.js-filter').select2MultiCheckboxes({
        templateSelection: function (selected, total) {
            return "Software";
        }
    })

    _filterOptions.prop("selected", false);
    $(".select2").on('click', function () {
        // processCheckboxes();
    });
};


var selectedItems = [];
function processCheckboxes(_this) {
    var block = $(_this).parent();
    var $this = block.find(".select2");
    var parent = block.find(".select2-results");
    var children = $(".select2-results__options");
    var child = $(".select2-results__option");
    var addingClass = block.find(".select2-container--open");
    var textHolder = block.find('.select2-selection__rendered');
    var searchIDs = [];
    var $clearButton = $("<li class='clearFilter'></li>");

    if ($('.clearFilter').length < 1) {
        children.prepend($clearButton);
    }

    clearSelectFilters();

    // if (selectedItems.length > 0)
    //     printClearButtonText(selectedItems.length);

    var clearButtonSelector = $('.clearFilter');

    function clearSelectFilters() {
        $('body').off('click').on('click', '.clearFilter', function () {
            selectedItems = [];
            resetFilter(_this);
            clearButtonSelector.hide();
            return false;
        });
    }


    if ($this.hasClass('select2-container--open')) {
        if ($(_this).val() && $(_this).val() != '') {
            if (window.location.pathname.indexOf('games/') > -1) {
                textHolder.html($(_this).val().join(', '));
            }
            printClearButtonText($(_this).val().length);
        }

        addingClass.addClass("qwerty");

        $('.select2-search__field').prop('focus', false);

        selectedItems.length = 0;

        checkIds();


        $('.select2-results__option').off("click").on("click", function () {

            selectedItems.length = 0;

            checkIds();

            if (!searchIDs.length) {
                textHolder.html($(_this).data('name'));
                clearButtonSelector.hide();

            } else {
                printClearButtonText(searchIDs.length);
                if (window.location.pathname.indexOf('games/') == -1) {
                    textHolder.html(searchIDs.join(', '));
                }
                clearButtonSelector.show();
                if ($(window).width() <= 690) {
                    // parent.css("maxHeight", "256px");
                } else {
                    $(".nicescroll-rails").css("maxHeight", "100%");
                }

            }
        });

        $('.select2-search__field').off("keyup").on('keyup', function () {
            checkIds();
            if (!searchIDs.length) {
                clearButtonSelector.hide();
            } else {
                printClearButtonText(searchIDs.length);
                clearButtonSelector.show();
            }
        });

        // function showHideClearButton() {
        //     if (!searchIDs.length) {
        //         clearButtonSelector.hide();
        //     } else {
        //         printClearButtonText(searchIDs.length);
        //         clearButtonSelector.show();
        //     }
        // }

        function checkIds() {
            searchIDs = child.map(function () {
                if ($(this).attr("aria-selected") === "true") {
                    $(this).insertAfter(clearButtonSelector);
                    selectedItems.push($(this));
                    return $(this).find('.wrap').html();
                }

            }).get();
        }
    }
    function printClearButtonText(searchIDs) {
        $('.clearFilter').text('Clear ' + searchIDs + ' selected filters');
    }
}