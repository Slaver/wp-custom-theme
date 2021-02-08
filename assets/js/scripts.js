( function( $ ) {
    // Filters
    var beerList = $('.beer-list'),
        beerSpinner = $('.spinner'),
        beerFilters = $('.beer-filters'),
        beerLoadMore = $('.load-more'),
        beerFiltersCache = [],
        beerCache = [];

    beerFilters.on('change', function( e ) {
        e.preventDefault();

        var nextPage = 1;
        var filter = $(this).serializeArray();

        $.ajax({
            url: ajaxurl,
            dataType: 'json',
            type: 'POST',
            data: filter,
            beforeSend: function() {
                $('input', beerFilters).attr('disabled', 'disabled');
                beerList.html('');
                beerSpinner.show();
                beerLoadMore.attr('disabled', 'disabled').hide();
            },
            success: function(data) {
                var html = '';
                var url = updateUrl(filter);
                $('input', beerFilters).removeAttr('disabled');
                beerSpinner.hide();
                if (data.error) {
                    html += '<p>' + data.error + '</p>';
                    beerLoadMore.removeAttr('disabled').data('next', 1).hide();
                } else {
                    $.each(data.posts, function (i, arr) {
                        html += '<a href="' + arr.url + '" class="card" title="' + arr.title + '"><div class="card-wrapper">';
                        if (arr.image.length > 0) {
                            html += '<img src="' + arr.image + '" alt="' + arr.subtitle + '" /><div class="card-img-overlay d-flex flex-column align-items-center justify-content-center"></div>';
                        } else {
                            html += '<img src="https://fakeimg.pl/200x200/" alt="" /><div class="card-img-overlay d-flex flex-column align-items-center justify-content-center"></div>';
                        }
                        html += '</div></a>';
                    });
                    if (data.data.pages > nextPage) {
                        beerLoadMore.removeAttr('disabled').data('next', nextPage + 1).show();
                    } else {
                        beerLoadMore.attr('disabled', 'disabled').data('next', 1).hide();
                    }
                }
                beerCache[url] = html;
                beerFiltersCache[url] = filter;
                beerList.html(html);
            }
        });
        return false;
    });

    // Load more
    beerLoadMore.on('click', function( e ) {
        e.preventDefault();

        var nextPage = $(this).data('next');
        var filter = beerFilters.serializeArray();
        filter.push({name: 'paged', value: nextPage});

        $.ajax({
            url: ajaxurl,
            dataType: 'json',
            type: 'POST',
            data: filter,
            beforeSend: function() {
                $('input', beerFilters).attr('disabled', 'disabled');
                beerLoadMore.attr('disabled', 'disabled');
            },
            success: function(data) {
                var newest = 0;
                var html = '';
                var url = updateUrl(filter);
                $('input', beerFilters).removeAttr('disabled').show();
                if (data.error) {
                    beerLoadMore.removeAttr('disabled').data('next', 1).hide();
                } else {
                    $.each(data.posts, function (i, arr) {
                        if (i === 0) {
                            newest = arr.id;
                        }
                        html += '<a href="' + arr.url + '" class="card card-' + arr.id + '" title="' + arr.title + '"><div class="card-wrapper"><img src="' + arr.image + '" alt="' + arr.subtitle + '" /><div class="card-img-overlay d-flex flex-column align-items-center justify-content-center ' + ((arr.new) ? 'card-img-new' : '') + '"></div></div></a>';
                    });

                    if (data.data.pages > nextPage) {
                        beerLoadMore.data('next', nextPage + 1).removeAttr('disabled').show();
                    } else {
                        beerLoadMore.attr('disabled', 'disabled').data('next', 1).hide()
                    }
                }
                beerCache[url] = beerList.html() + html;
                beerFiltersCache[url] = filter;
                beerList.append(html);

                if (newest > 0) {
                    $('html,body').animate({
                        scrollTop: $('.card-' + newest).offset().top
                    }, 200);
                }
            }
        });
    });

    function updateUrl(filter) {
        var url = '';
        var filterArr = $.map(filter , function(n, i){
            return n.name + '=' + n.value;
        });
        var filterString = filterArr.join('&');
        if (filterString !== 'action=beerfilter') {
            url = '&' + filterString.replace('&action=beerfilter', '').replace('action=beerfilter', '');
        }
        url = url.replace('?&', '?');
        history.pushState({}, '', '/?post_type=beers' + url);
        return url;
    }

    $(window).on('load', function(e) {
        var currentUrl = location.href.replace(/^.*\/\/[^\/]+/, '').replace('/?post_type=beers', '');
        beerCache[currentUrl] = beerList.html();
        beerFiltersCache[currentUrl] = beerFilters.serialize();
    });

    $(window).on('popstate', function(e) {
        if (e.originalEvent.state !== null) {
            var prevUrl = location.href.replace(/^.*\/\/[^\/]+/, '').replace('/?post_type=beers', '');
            if (beerCache[prevUrl]) {
                beerList.html(beerCache[prevUrl]);
            }
            if (beerFiltersCache[prevUrl]) {
                var updateParams = $.parseParams(beerFiltersCache[prevUrl]);
                $('input', beerFilters).removeAttr('checked');
                $.each(updateParams, function(param, val) {
                    if ($.isArray(val)) {
                        $.each(val, function(i, val2) {
                            $('[name="' + param + '"][value="' + val2 + '"]', beerFilters).attr('checked', true);
                        });
                    } else {
                        $('[name="' + param + '"][value="' + val + '"]', beerFilters).attr('checked', true);
                    }
                });
            }
        }
    });

    $('.beer-filters-title', beerFilters).on('click', function( e ) {
        $(this).toggleClass('active');
        $(this).next('.form-group').toggleClass('d-none');
    });

    // jQuery.parseParams - parse query string paramaters into an object
    var re = /([^&=]+)=?([^&]*)/g;
    var decode = function(str) {
        return decodeURIComponent(str.replace(/\+/g, ' '));
    };
    $.parseParams = function(query) {
        var params = {}, e;
        if (query) {
            if (query.substr(0, 1) == '?') {
                query = query.substr(1);
            }

            while (e = re.exec(query)) {
                var k = decode(e[1]);
                var v = decode(e[2]);
                if (params[k] !== undefined) {
                    if (!$.isArray(params[k])) {
                        params[k] = [params[k]];
                    }
                    params[k].push(v);
                } else {
                    params[k] = v;
                }
            }
        }
        return params;
    };
} )( jQuery );