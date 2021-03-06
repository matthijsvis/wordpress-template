;
jQuery(document).ready(function ($) {
    $(document).delegate('.wpd-info,.wpd-page-link,.wpd-delete-content,.wpd-user-email-delete-links', 'click', function (e) {
        e.preventDefault();
    });

    $('#wc_delete_content_message').delay(3000).fadeOut(1500, function () {
        $(this).remove();
        location.href = location.href.substring(0, location.href.indexOf('delete') - 1);
    });

    $(document).delegate('.wpd-info.wpd-not-clicked', 'click', function (e) {
        var btn = $(this);
        btn.removeClass('wpd-not-clicked');
        var data = new FormData();
        data.append('action', 'wpdGetInfo');
        wpdFullInfo(btn, data);
        return false;
    });

    function wpdFullInfo(btn, data) {
        var icon = $('.fas', btn);
        var oldClass = icon.attr('class');
        icon.removeClass();
        icon.addClass('fas fa-pulse fa-spinner');
        var ajax = getUCAjaxObj(false, data);
        ajax.done(function (resp) {
            btn.addClass('wpd-not-clicked');
            icon.removeClass();
            icon.addClass(oldClass);
            if (resp) {
                $('#wpdUserContentInfo').html(resp);
                $('#wpdUserContentInfo ul.wpd-list .wpd-list-item:first-child').addClass('wpd-active');
                $('#wpdUserContentInfo div.wpd-content .wpd-content-item:first-child').addClass('wpd-active');

                if (!($('#wpdUserContentInfo').is(':visible'))) {
                    $('#wpdUserContentInfoAnchor').trigger('click');
                }
            }
        });
    }

    $(document).delegate('.wpd-list-item', 'click', function () {
        var relValue = $('input.wpd-rel', this).val();
        $('#wpdUserContentInfo .wpd-list-item').removeClass('wpd-active');
        $('#wpdUserContentInfo .wpd-content-item').removeClass('wpd-active');
        $(this).addClass('wpd-active');
        $('#wpdUserContentInfo #' + relValue).addClass('wpd-active');
    });


    $(document).delegate('.wpd-page-link.wpd-not-clicked', 'click', function (e) {
        var btn = $(this);
        btn.removeClass('wpd-not-clicked');
        var goToPage = btn.data('wpd-page');
        var action = $('.wpd-active .wpd-pagination .wpd-action').val();
        var data = new FormData();
        data.append('action', action);
        data.append('page', goToPage);
        var ajax = getUCAjaxObj(true, data);
        ajax.done(function (resp) {
            btn.addClass('wpd-not-clicked');
            if (resp) {
                $('.wpd-content-item.wpd-active').html(resp);
            }
            $('.wpdiscuz-loading-bar').hide();
        });
    });

    $(document).delegate('.wpd-delete-content.wpd-not-clicked', 'click', function () {

        var btn = $(this);
        var id = parseInt(btn.data('wpd-content-id'));
        if (!isNaN(id)) {
            var action = btn.data('wpd-delete-action');
            if (action == 'wpdDeleteComment' && !confirm(wpdiscuzUCObj.msgConfirmDeleteComment)) {
                return false;
            } else if (action == 'wpdCancelSubscription' && !confirm(wpdiscuzUCObj.msgConfirmCancelSubscription)) {
                return false;
            }
            var icon = $('i', btn);
            var oldClass = icon.attr('class');
            var goToPage = $('.wpd-wrapper .wpd-page-number').val();
            var childCount = $('.wpd-content-item.wpd-active').children('.wpd-item').length;
            btn.removeClass('wpd-not-clicked');
            icon.removeClass().addClass('fas fa-pulse fa-spinner');
            if (childCount == 1 && goToPage > 0) {
                goToPage = goToPage - 1;
            }

            var data = new FormData();
            data.append('id', id);
            data.append('page', goToPage);
            data.append('action', action);


            var ajax = getUCAjaxObj(false, data);
            ajax.done(function (response) {
                btn.addClass('wpd-not-clicked');
                icon.removeClass().addClass(oldClass);
                $('.wpd-content-item.wpd-active').html(response);
            });

        }
    });

    $(document).delegate('.wpd-user-email-delete-links.wpd-not-clicked', 'click', function () {
        var btn = $(this);
        btn.removeClass('wpd-not-clicked');
        $('.wpd-loading', btn).addClass('wpd-show');
        var data = new FormData();
        data.append('action', 'wpdEmailDeleteLinks');
        var ajax = getUCAjaxObj(false, data);
        ajax.done(function (response) {
            btn.addClass('wpd-not-clicked');
            $('[data-lity-close]', window.parent.document).trigger('click');
        });
    });

    $(document).delegate('.wpd-user-settings-button.wpd-not-clicked', 'click', function () {
        var btn = $(this);
        btn.removeClass('wpd-not-clicked');
        var guestAction = btn.data('wpd-delete-action');
        console.log(guestAction);
        if (guestAction !== 'deleteCookies') {
            btn.find('.wpd-loading').addClass('wpd-show');
            var data = new FormData();
            data.append('action', 'wpdGuestAction');
            data.append('guestAction', guestAction);
            var ajax = getUCAjaxObj(false, data);
            ajax.done(function (response) {
                btn.addClass('wpd-not-clicked');
                btn.find('.wpd-loading').removeClass('wpd-show');
                try {
                    var r = $.parseJSON(response);
                    btn.after(r.message);
                    var messageWrap = btn.next('.wpd-guest-action-message');
                    messageWrap.fadeIn(100).fadeOut(7000, function () {
                        messageWrap.remove();
                        if (parseInt(r.code) === 1) {
                            btn.parent().remove();
                            guestActionDeleteCookieClass();
                        }
                    });
                } catch (e) {
                    console.log(e);
                }
            });
        } else {
            wpdDeleteAllCookies();
        }
    });

    function guestActionDeleteCookieClass() {
        if (!$('.wpd-delete-all-comments').length && !$('.wpd-delete-all-subscriptions').length) {
            $('.wpd-delete-all-cookies').parent().addClass('wpd-show');
        }
    }

    function wpdDeleteAllCookies() {
        var wpdCookies = document.cookie.split(";");
        for (var i = 0; i < wpdCookies.length; i++) {
            var wpdCookie = wpdCookies[i];
            var eqPos = wpdCookie.indexOf("=");
            var name = eqPos > -1 ? wpdCookie.substr(0, eqPos) : wpdCookie;
            Cookies.remove(name.trim());
        }
        Cookies.remove(wpdiscuzAjaxObj.wpdiscuz_options.lastVisitKey, {path: window.location});
        location.reload(true);
    }

    /**
     * @param {type} action the action key 
     * @param {type} data the request properties
     * @returns {jqXHR}
     */
    function getUCAjaxObj(isShowTopLoading, data) {
        if (isShowTopLoading) {
            $('.wpdiscuz-loading-bar').show();
        }
        data.append('postId', wpdiscuzAjaxObj.wpdiscuz_options.wc_post_id);
        return $.ajax({
            type: 'POST',
            url: wpdiscuzAjaxObj.url,
            data: data,
            contentType: false,
            processData: false,
        });
    }
});