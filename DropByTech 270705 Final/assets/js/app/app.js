(function($) {

    var _init = [];
    var _call_process = 0;

    $.app = {
        scope: function() {
            var data = $.parseJSON(scope);
            return data.scope;
        },
        init: function(f) {
            if (f) {
                _init.push(f);
            }
            else {
                $.each(_init, function(idx, f) {
                    f();
                });
            }
        },
        keys: function(o) {
            var keys = [];
            $.each(o, function(k, v) {
                keys.push(k);
            });

            return keys;
        },
        element_message_box: function(message, selector, element) {
            element.html('<div class="alert alert-' + selector + '"><a class="close" data-dismiss="alert">x</a>' + message + '</div>');
        },
        trim: function(string) {
            return $.trim(string);
        },
        json: {
            encode: function(obj, useOwn) {
                if (typeof JSON != "undefined" && !useOwn) {
                    return JSON.stringify(obj);
                } else {
                    return _json_encode(obj, []);
                }
            },
            decode: function(str) {
                return $.parseJSON(str);
            }
        },
        ajax: function(method, url, params, callback, error) {
            if (typeof params == "function") {
                error = callback;
                callback = params;
                params = {};
            }

            callback = callback || function() {
            };
            error = error || function() {
            };

            $.ajax({
                type: method,
                url: url,
                data: params,
                dataType: 'json',
                async: false,
                success: function(result) {
                    callback(result);
                },
                error: error
            });
        },
        get: function(controller, action, params, callback, error) {
            $.app.ajax("get", controller, action, params, callback, error);
        },
        post: function(controller, action, params, callback, error) {
            $.app.ajax("post", controller, action, params, callback, error);
        },
        message_box: function(message, selector) {
            switch (selector) {
                case 'error':
                    $('.message-container').html('<p class="bg-danger"><a class="close" data-dismiss="alert">&times;</a>' + message + '</p>');
                    break;

                case 'warning':
                    $('.message-container').html('<p class="bg-warning"><a class="close" data-dismiss="alert">&times;</a>' + message + '</p>');
                    break;

                case 'info':
                    $('.message-container').html('<p class="bg-info"><a class="close" data-dismiss="alert">&times;</a>' + message + '</p>');
                    break;

                case 'success':
                default:
                    $('.message-container').html('<p class="bg-success"><a class="close" data-dismiss="alert">&times;</a>' + message + '</p>');
                    break;
            }
        },
        _validate: function(fields) {
            var error = [];
            $.each(fields, function(idx, selector) {
                var _pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if ($.trim($('#' + selector).val()) == '') {
                    error.push(selector);
                    $('#' + selector).val('');
                }
                if (selector == 'email') {
                    if (!_pattern.test($('#email').val())) {
                        error.push(selector);
                    }
                }
            });

            if (error.length > 0) {
                $.app.message_box('Please fill in all the details', 'error');
                error = [];
                return false;
            }
            else
                return true;
        },
        tooltips: function() {
            $('.tooltip-top').tooltip({'placement': 'top'});
            $('.tooltip-bottom').tooltip({'placement': 'bottom'});
            $('.tooltip-left').tooltip({'placement': 'left'});
            $('.tooltip-right').tooltip({'placement': 'right'});
        },
        auth_data: function() {
            var data = $.parseJSON(auth_data);
            return data;
        },
        slug_url: function(controller, id, title) {
            if (title != null)
                return base_url + controller + '/' + title;
            else
                return base_url + controller + '/' + id;
        },
        urls: function(value) {
            var data = $.parseJSON(urls);

            switch (value) {
                case 'assets':
                    return data.assets.base;
                    break;
                case 'js':
                    return data.assets.js;
                    break;
                case 'css':
                    return data.assets.css;
                    break;
                case 'img':
                    return data.assets.img;
                    break;
                case 'base_url':
                default:
                    return data.base_url;
                    break;
            }
        },
        radio_checkbox: function(params) {

            var boxes = Array();
            params.block.parents('.radio-checkbox-wrapper').find('input[type="checkbox"]').each(function(key, value) {
                var cb_block = $(value), name = cb_block.attr('name');

                boxes[key] = {name: name, block: params.pblock + ' .radio-checkbox-wrapper input[name="' + name + '"]'};
            });

            $.each(boxes, function(key, value) {

                if (value.name == params.name)
                {
                    if ($(value.block).prop('checked'))
                        $(value.block).trigger('click');
                }
                else
                {
                    if ($(value.block).prop('checked'))
                    {
                        $(value.block).prop("checked", false);
                        $(value.block).parent().find('.button-checkbox .cb-icon-check').hide();
                        $(value.block).parent().find('.button-checkbox .cb-icon-check-empty').show();
                        //$(value.block).trigger('click');
                    }

                }
            });
        },
        toggle_to: function() {
            $(document).on('click', '.toggle-to', function() {
                var block = $(this).attr('block');
                var has_login = true;

                if ($(this).hasClass('check-login') && !is_login)
                {
                    has_login = false;

                    $('#check-login-modal').find('.login-txt').html($(this).attr('login-text'));
                    $('#check-login-modal').modal('show');
                }
                if (has_login)
                    $(block).fadeToggle();
            });
        },
        check_login: function(params) {
            if (!is_login)
            {
                $('#check-login-modal').find('.login-txt').html(params.text);
                $('#check-login-modal').modal('show');
            }
            return is_login;
        }

    }

    $(document).ready(function() {
        _bind_events();

        $.app.toggle_to();
       // $('.selectpicker').selectpicker();
        $(window).load(function(){
                    $('.different-loader').hide();
        });
  
    });

    var _bind_events = function() {

    }

    var _json_encode = function(obj, cache) {
        if ($.inArray(obj, cache) > -1) {
            throw "JSON error: circular reference";
        }
        if (obj === null) {
            return "null";
        }
        else if (typeof obj == "string") {
            return "\"" + obj.replace(/\\/g, "\\\\").replace(/"/g, "\\\"") + "\"";
        }
        else if (typeof obj == "object") {
            cache.push(obj);
            if (obj.constructor === window.Array) {
                return "[" + $.map(obj, function(v) {
                    return _encode(v, cache.slice(0));
                }).join(", ") + "]";
            }
            else {
                var p = [];
                for (var k in obj) {
                    if (obj.hasOwnProperty(k)) {
                        p.push(_encode(k, cache.slice(0)) + ": " + _encode(obj[k], cache.slice(0)));
                    }
                }
                return "{" + p.join(", ") + "}";
            }
        }
        else {
            return obj.toString();
        }
    };
})(jQuery);
