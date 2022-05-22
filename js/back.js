(function($) {
    'use strict';


    var existed = Array();

    jQuery(document).ready(function() {
        $('.gp-form-select li').each(function() {
            var value = jQuery(this).data('title').toLowerCase();
            if (typeof value !== 'undefined') {
                existed.push(value);
            }
        });
    });

    jQuery(document).on('change', '#gp-save-select-form', function() {
        var form_id = jQuery(this).val();
        var title = jQuery(this).children("option:selected").text();
        if (form_id != '') {
            if (jQuery('.gp-form-select li').eq(0).attr('data-value') == 0) {
                jQuery('.gp-form-select li').eq(0).remove();
            }
            if ($.inArray(title.toLowerCase(), existed) == -1) {
                // if(jQuery('.gp-form-select li'))
                existed.push(title.toLowerCase());
                jQuery('.gp-form-select').append('<li data-value="' + form_id + '" data-title="' + title + '">' + title + ' <a href="javascript:;" class="removeSelectedHr"> X </a></li>');
            }
        }

    });
    jQuery(document).on('click', '.removeSelectedHr', function() {

        jQuery(this).parent().remove();
        var remove_t = jQuery(this).parent().attr('data-title');
        existed.splice($.inArray(remove_t, existed), 1);
        jQuery('#gp-save-select-form').val('');
        if (jQuery('.gp-form-select li').length == 0) {
            jQuery('.gp-form-select').append('<li data-value="0">No Form Selected</li>');
        }
    });

    jQuery(document).on('click', '.gp-save-hr-form-submit', function() {
        var selected_forms = Array();
        jQuery(this).addClass('disabled');
        jQuery(this).html('Saving...');
        jQuery('.gp-form-select li').each(function(index, val) {
            selected_forms.push(jQuery(val).attr('data-value'));
        });


        $.ajax({
            url: WW_ADMIN_AJAX_OBJECT.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'WW_SaveSelectedHR_Action',
                selected_forms: selected_forms
            },
            success: function(data) {
                if (data.success == true) {
                    jQuery.iaoAlert({
                        msg: "<strong>" + data.message + "</strong>",
                        type: "success",
                        fadeOnHover: true,
                        roundedCorner: true,
                        zIndex: '9999999999',
                        mode: "dark",
                    });
                    jQuery('.gp-save-hr-form-submit').removeClass('disabled');
                    jQuery('.gp-save-hr-form-submit').html('Save');
                }
            }
        });
    });

    function getUrlVars() {
        var vars = [],
            hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    var type = getUrlVars()["type"];
    var page = getUrlVars()['page'];
    var action = getUrlVars()['action'];
    var post = getUrlVars()['post'];
    var post_type = getUrlVars()['post_type'];

    if (typeof page !== "undefined" && (page == 'gf_edit_forms' || page == 'gf_entries' || page == 'gf_export')) {
        if (typeof type !== "undefined" && type == 'hr') {
            window.onload = function(e) {
                jQuery('#gf_toolbar_buttons_container').prepend('<a href="' + SITE_URL.main + '/hr-zone/" class="button gform-button gform-button--white"><i class="uil uil-edit-alt" aria-hidden="true" style="margin-right: 6px;"></i>Back to HR Zone</a>');
                var form_name = '<div class="custom-gp-form-data"><h3>' + jQuery('#gform-form-switcher-control').find('span').text() + '</h3></div>'
                jQuery('#gform-form-toolbar').prepend(form_name);
                jQuery('#gform-form-switcher-label').parent().parent().remove();
                jQuery('#gform-form-toolbar__menu').remove();
            }
        } else {
            if (WW_ADMIN_AJAX_OBJECT.user_role == WW_ADMIN_AJAX_OBJECT.global_hr_role) {
                location.href = SITE_URL.main + '/hr-zone?ex=permission_denied';
            }
        }
    }

    if (window.location.pathname == '/wp-admin/post-new.php') {

        if (typeof type !== "undefined" && type == 'hr') {
            window.onload = function(e) {
                setTimeout(function() {
                    if (jQuery('.wpb_switch-to-composer').text() != 'Classic Mode') {
                        jQuery('.wpb_switch-to-composer').trigger('click');
                    }
                    jQuery('#post').attr('action', 'post.php?type=hr');
                }, 20);
                jQuery('.wp-heading-inline').after('<a href="' + SITE_URL.main + '/hr-zone/" class="button button-primary" style="float:right;"> Back to HR Zone</a>');

                jQuery(document).on('focus', '.wpb_edit_form_elements select', function() {
                    var data = jQuery('.vc_wrapper-param-type-dropdown').attr('data-param_settings');
                    if (data) {
                        var json_data = JSON.parse(data);
                        var selected_forms = WW_ADMIN_AJAX_OBJECT.selected_forms;
                        var arr = {};

                        jQuery.each(json_data.value, function(a, b) {
                            if ((jQuery.inArray(b, selected_forms) != -1)) {
                                arr[a] = b;
                            }
                        });
                        arr['Select a form to display.'] = '';
                        json_data.value = arr;
                        jQuery('.vc_wrapper-param-type-dropdown').attr('data-param_settings', JSON.stringify(json_data));
                    }
                    if (jQuery('.wpb_edit_form_elements').attr('data-title') == 'Edit Gravity Form') {
                        var selected_forms = WW_ADMIN_AJAX_OBJECT.selected_forms;
                        if (selected_forms) {
                            jQuery('.wpb_edit_form_elements select:first > option').each(function() {
                                var option_val = jQuery(this).val();
                                if (option_val != '') {
                                    if ((jQuery.inArray(option_val.toString(), selected_forms) == -1)) {
                                        jQuery(this).remove();
                                    }
                                }
                            });
                        }
                    }
                });
            }
        } else {
            if (WW_ADMIN_AJAX_OBJECT.user_role == WW_ADMIN_AJAX_OBJECT.global_hr_role) {
                location.href = SITE_URL.main + '/hr-zone/';
            }
        }
    }

    if (window.location.pathname == '/wp-admin/post.php') {

        if ((post != '') && (action == 'edit') && type == 'hr') {
            window.onload = function(e) {
                setTimeout(function() {
                    if (jQuery('.wpb_switch-to-composer').text() != 'Classic Mode') {
                        jQuery('.wpb_switch-to-composer').trigger('click');
                    }
                    jQuery('#post').attr('action', 'post.php?type=hr');
                }, 20);
                jQuery('.wp-heading-inline').after('<a href="' + SITE_URL.main + '/hr-zone/" class="button button-primary" style="float:right;">Back to HR Zone</a>');
                jQuery('.page-title-action').remove();
                jQuery(document).on('focus', '.wpb_edit_form_elements select', function() {
                    var data = jQuery('.vc_wrapper-param-type-dropdown').attr('data-param_settings');
                    if (data) {
                        var json_data = JSON.parse(data);
                        var selected_forms = WW_ADMIN_AJAX_OBJECT.selected_forms;
                        var arr = {};

                        jQuery.each(json_data.value, function(a, b) {
                            if ((jQuery.inArray(b, selected_forms) != -1)) {
                                arr[a] = b;
                            }
                        });
                        arr['Select a form to display.'] = '';
                        json_data.value = arr;
                        jQuery('.vc_wrapper-param-type-dropdown').attr('data-param_settings', JSON.stringify(json_data));
                    }
                    if (jQuery('.wpb_edit_form_elements').attr('data-title') == 'Edit Gravity Form') {
                        var selected_forms = WW_ADMIN_AJAX_OBJECT.selected_forms;
                        if (selected_forms) {
                            jQuery('.wpb_edit_form_elements select:first > option').each(function() {
                                var option_val = jQuery(this).val();
                                if (option_val != '') {
                                    if ((jQuery.inArray(option_val.toString(), selected_forms) == -1)) {
                                        jQuery(this).remove();
                                    }
                                }
                            });
                        }
                    }
                });
            }
        } else {
            if (WW_ADMIN_AJAX_OBJECT.user_role == WW_ADMIN_AJAX_OBJECT.global_hr_role) {
                location.href = SITE_URL.main + '/hr-zone/';
            }
        }
    }


})(jQuery);