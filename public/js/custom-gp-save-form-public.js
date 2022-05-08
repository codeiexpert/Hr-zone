(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * jQuery function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * jQuery(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * jQuery( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    function hrDataTable(text, form_id) {
        var table = jQuery('#hr-selected-form-table').DataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details for <strong>#' + data[0] + '</strong>';
                        }
                    }),
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
                            if (col.title.toLowerCase() == 'employer' || col.title.toLowerCase() == 'education') {
                                var html = '<div class="row ' + col.title.toLowerCase() + '">' +
                                    '<div class="col-md-12 ' + col.title.toLowerCase() + '-data">' + col.data + '</div>' +
                                    '</div>';
                            } else {

                                var html = '<div class="row">' +
                                    '<div class="col-md-6"><p class="text-secondary m-0 mt-2 fw-bold fs-5">' + col.title + '</p></div> ' +
                                    '<div class="col-md-6 text-secondary m-0 mt-2 fs-5">' + col.data + '</div>' +
                                    '</div>';
                            }
                            return col.hidden ? html : '';
                        }).join('');

                        return data ? jQuery('<div/>').append(data) : false;
                    }
                }
            },
            "createdRow": function(row, data, dataIndex) {
                var check = jQuery(data[0]).attr('data-read-status');
                var id = jQuery(data[0]).attr('data-entry-id');
                if (check == 0) {
                    jQuery(row).addClass('n-readed n-readed-cs-' + id).addClass('interview_read_status').attr('data-entry-id', id);
                }
            },
            deferRender: true,
            language: {
                "emptyTable": text,
                "loadingRecords": "<div id='cover-spin'><div>"
            },
            ajax: {
                "url": WW_AJAX_OBJECT.ajax_url,
                "method": 'get',
                "data": {
                    action: 'WW_ShowSelectedFormData_Action',
                    form_id: form_id,
                    type: 'get_data'

                }
            },
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                },
                {
                    responsivePriority: 3,
                    targets: -2
                },
                { "orderable": false, "targets": [0, -1] }
            ],
            // "order": [[ 0, 'desc' ]]
        });
    }

    // function jobPostDataTable() {
    // 	if(jQuery('.modal-dialog').siblings().not('.modal-dialog')){
    // 		jQuery('.modal-dialog').addClass('modal-lg');
    // 		jQuery('.modal-dialog').addClass('modal-dailog-centered')
    // 	}
    // 	var table = jQuery('#hr-job-post-table').DataTable({
    // 		responsive: {
    // 			details: {
    // 				display: $.fn.dataTable.Responsive.display.modal( {
    // 					header: function ( row ) {
    // 						var data = row.data();
    // 						return 'Details for '+data[0]+' '+data[1];
    // 					}
    // 				} ),
    // 				renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
    // 					tableClass: 'table'
    // 				} )
    // 			}
    // 		},
    // 		deferRender: true,
    // 		language: {
    // 			"emptyTable": 'No Job Posts Find',
    // 			"loadingRecords": "<div id='cover-spin'><div>"
    // 		},
    // 		ajax: {
    // 			"url": WW_AJAX_OBJECT.ajax_url,
    // 			"method": 'get',
    // 			"data": {
    // 				action: 'WW_ShowJobPostData_Action',

    // 			}
    // 		},
    // 		initComplete: function () {
    // 			jQuery('#hr-job-post-table').DataTable().columns.adjust().responsive.recalc();
    // 		},
    // 		columnDefs: [{
    // 				responsivePriority: 1,
    // 				targets: 0
    // 			},
    // 			{
    // 				responsivePriority: 2,
    // 				targets: -1
    // 			},
    // 			{ "orderable": false, "targets": [-1] }
    // 		],
    // 		"order": [[ 0, 'desc' ]]
    // 	});
    // 	table.on('draw', function () {
    // 		jQuery('#hr-job-post-table_length label').contents().filter((_, el) => el.nodeType === 3).remove();
    // 		jQuery('#hr-job-post-table_length label').prepend(' Show Entries ');
    // 		jQuery('#hr-job-post-table_filter label').contents().filter((_, el) => el.nodeType === 3).remove();
    // 		// jQuery('#hr-job-post-table_filter').prepend('<label style="float: left;" class="mx-1">Search</label><br>');
    // 		jQuery('.table-custom').show();
    // 	});
    // }



    jQuery(document).ready(function() {
        Fancybox.bind("[data-fancybox]");
        jQuery('.page-preloader').hide();
        jQuery("body").tooltip({ selector: '[data-bs-toggle="tooltip"]' });
        // hrDataTable('No Entries Available', '');
        jQuery('.table-custom').show();
        // jQuery('#gp-form-select-hr').change();

        jQuery('#interviewModalCenter').on('click', 'button.close', function(eventObject) {
            jQuery('#interviewModalCenter').modal('hide');
        });

        setTimeout(function() {
            jQuery('.gp-form-select-hr').eq(0).click();
            // jQuery('#gp-form-select-hr').change();
        }, 50);

        jQuery(document).on('click', '.button-menu-mobile', function(e) {
            e.preventDefault();
            if (jQuery('body').hasClass('sidebar-enable')) {
                jQuery('body').removeClass('sidebar-enable');
                jQuery('.leftside-menu').css('padding-top', '');
            } else {
                var height = jQuery('ul.nav').height() + jQuery('.navbar-custom').height();
                jQuery('.leftside-menu').css('padding-top', height);
                jQuery('body').addClass('sidebar-enable');
            }
        });
        jQuery(document).on('click', '.gp-form-select-hr', function() {
            var form_id = jQuery(this).data('value');

            if (form_id != '') {
                var href = jQuery('.gp-edit-form').data('href');
                jQuery('.gp-edit-form').attr('href', href + "&id=" + form_id + "&type=hr");
                var old_html = jQuery('.gp-hr-form-dropdown').html();
                var new_html = jQuery(this).find('button').html();

                if (old_html != new_html) {
                    jQuery('.gp-hr-form-dropdown').html(jQuery(this).find('button').html());
                    jQuery('#selected-form-id').val(form_id);
                    jQuery('.gp-hr-form-dropdown').after('<span class="loader"><div id="cover-spin"></div></span>');
                    jQuery.ajax({
                        url: WW_AJAX_OBJECT.ajax_url,
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            action: 'WW_ShowSelectedFormData_Action',
                            form_id: form_id,
                            type: 'get_label'
                        },
                        success: function(data) {

                            if (data.success == true) {
                                jQuery('.hr-seleted-form-data').fadeIn();
                                jQuery('#hr-selected-form-table').dataTable().fnDestroy();
                                jQuery('#hr-selected-form-table thead tr').empty();
                                jQuery('#hr-selected-form-table tfoot tr').empty();
                                jQuery('#hr-selected-form-table tbody').empty();
                                jQuery.each(data.labels, function(index, val) {
                                    jQuery('#hr-selected-form-table thead tr').append('<th scope="col">' + val + '</th>');
                                    jQuery('#hr-selected-form-table tfoot tr').append('<th scope="col">' + val + '</th>');
                                });

                                jQuery('.loader').remove();
                                hrDataTable('No Entries Available', form_id);

                                jQuery('#hr-selected-form-table_length label').contents().filter((_, el) => el.nodeType === 3).remove();
                                jQuery('#hr-selected-form-table_length label').prepend(' Show Entries ');
                                // jQuery('#hr-selected-form-table_filter label').contents().filter((_, el) => el.nodeType === 3).remove();
                                // jQuery('#hr-selected-form-table_filter').prepend('<label style="float: left;" class="mx-1">Search</label><br>');

                            }
                        }
                    });
                }

            }

        });

        jQuery(document).on('click', '.interview-save-btn', function(e) {
            e.preventDefault();



            //interview timings

            var interview_timings = jQuery('#hr-choose-interview-timing').val();

            var timings_arr = interview_timings.split('-');

            var start_time = moment(date);
            if (timings_arr[2] != '') {
                var time_in_hour = timings_arr[0];
                var time_type_in_hour = timings_arr[1];
                var time_in_mins = timings_arr[2];
                var time_type_in_mins = timings_arr[3];
                var end_time = moment(date).add(time_in_mins, time_type_in_mins).add(time_in_hour, time_type_in_hour);
            } else {
                var time = timings_arr[0];
                var time_type = timings_arr[1];
                var end_time = moment(date).add(time, time_type);
            }
            //comments 

            var comments = jQuery('#gp-additonal-comments').val();

            // location 
            var location = jQuery('#hr-interview-location').val();

            //web conference interview type

            var conference_txt = 'On Site Interview';
            var interview_txt = 'On Site';


            if (jQuery('#hr-choose-interview-type').val() == 'Online') {
                conference_txt = 'Web conference interview';
                interview_txt = 'Web conference';
                var webconference_url = jQuery('#hr-interview-webconference').val();

                if (webconference_url == '') {
                    webconference_url = 'https:://meet.google.com/test';
                }
                location = webconference_url;
            } else {

                if (location == '') {

                    jQuery.iaoAlert({
                        msg: "<strong>Please add interview location</strong>",
                        type: "error",
                        fadeOnHover: true,
                        roundedCorner: true,
                        zIndex: '999999999999',
                        mode: "dark",
                    });
                    return false;
                }
            }

            //Interview details 

            var interview_stage = jQuery('#hr-choose-interview-stage').val();
            var interview_status = jQuery('#hr-choose-interview-status').val();
            var interview_status_name = jQuery('#hr-choose-interview-status option:selected').text();
            var interviewer = jQuery('#hr-choose-interviewer').val();
            var interview_post = jQuery('#hr-choose-posts-stage').val();

            if (interview_status_name.toLowerCase() == 'offer-rejected' || interview_status_name.toLowerCase() == 'rejected' || interview_status_name.toLowerCase() == 'withdrawn') {
                if (comments == '') {
                    jQuery.iaoAlert({
                        msg: "<strong>Please Add Reason</strong>",
                        type: "error",
                        fadeOnHover: true,
                        roundedCorner: true,
                        zIndex: '999999999999',
                        mode: "dark",
                    });
                    return false;
                }
            } else {
                if (interview_stage == '') {

                    jQuery.iaoAlert({
                        msg: "<strong>Please select interview stage</strong>",
                        type: "error",
                        fadeOnHover: true,
                        roundedCorner: true,
                        zIndex: '999999999999',
                        mode: "dark",
                    });
                    return false;
                }

                // date	
                var date = jQuery("#hr-date-pick").val();
                if (date == '') {
                    jQuery.iaoAlert({
                        msg: "<strong>Please Select Date Before Scheduling an interview</strong>",
                        type: "error",
                        fadeOnHover: true,
                        roundedCorner: true,
                        zIndex: '999999999999',
                        mode: "dark",
                    });
                    return false;
                }



            }
            if (interview_status == '') {

                jQuery.iaoAlert({
                    msg: "<strong>Please select interview status</strong>",
                    type: "error",
                    fadeOnHover: true,
                    roundedCorner: true,
                    zIndex: '999999999999',
                    mode: "dark",
                });
                return false;
            }
            if (interviewer == '') {

                jQuery.iaoAlert({
                    msg: "<strong>Please select interviewer</strong>",
                    type: "error",
                    fadeOnHover: true,
                    roundedCorner: true,
                    zIndex: '999999999999',
                    mode: "dark",
                });
                return false;
            }

            if (interview_post == '') {

                jQuery.iaoAlert({
                    msg: "<strong>Please select interview posts</strong>",
                    type: "error",
                    fadeOnHover: true,
                    roundedCorner: true,
                    zIndex: '999999999999',
                    mode: "dark",
                });
                return false;
            }

            var user = JSON.parse(jQuery('#hr-choose-interview-type').attr('data-user'));
            var type = jQuery('#hr-choose-interview-type').attr('data-type');
            if (user.mname != '-' && user.mname != null) {
                var full_name = user.fname + ' ' + user.mname + ' ' + user.lname;
            } else if (user.lname != null) {
                var full_name = user.fname + ' ' + user.lname;
            } else {
                var full_name = user.fname;
            }
            var email = user.email;

            // jQuery('#gp-save-mail-send-html').trigger('click');
            jQuery('.interview-save-btn').html('Making Email Template...');
            jQuery('.interview-save-btn').attr('disabled', true);
            jQuery('.interview-save-btn').addClass('sendMailData');
            jQuery('.sendMailData').removeClass('interview-save-btn');
            jQuery("#gp-save-mail-send-html").remove();
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'GET',
                dataType: 'json',
                data: {
                    action: 'WW_GetEmailTemplate_Action',
                    interview_type: interview_txt,
                    interview_stage: interview_stage,
                    interviewer: interviewer,
                    interview_status: interview_status,
                    webconference_url: webconference_url,
                    email: email,
                    comments: comments,
                    interview_post: interview_post,
                    full_name: full_name,
                    date: moment(date).format('YYYY-MM-DD HH:mm:ss'),
                    location: location
                },
                success: function(data) {
                    if (data.success == true) {
                        jQuery('.sendMailData').html('Schedule an Interview');
                        jQuery('.sendMailData').removeAttr('disabled');
                        tinymce.remove('#gp-save-mail-send');
                        jQuery('#gp-mail-subject').val(data.subject);
                        jQuery('#gp-save-mail-send').val(data.content);
                        jQuery('.gp-save-top-content').hide();
                        tinymce.init(tinyMCEPreInit.mceInit['gp-save-mail-send']);
                        if (interview_status_name.toLowerCase() == 'offer-rejected' || interview_status_name.toLowerCase() == 'rejected' || interview_status_name.toLowerCase() == 'withdrawn') {
                            jQuery('#notify-sec').css('display', 'flex');
                        } else {
                            jQuery('#notify-sec').hide();
                        }
                        jQuery('.gp-submit-email-content').show();


                    }
                }
            });

        });

        jQuery(document).on('change', '#hr-choose-interview-status', function(e) {

            var interview_s_name = jQuery(this).find('option:selected').text().toLowerCase();
            console.log(interview_s_name);
            if (interview_s_name == 'offer-rejected' || interview_s_name == 'rejected' || interview_s_name == 'withdrawn') {
                jQuery('#comments-label').html('Reason <span class="required">*</span>');
                jQuery('.non-reject-in').hide();
            } else {
                jQuery('#comments-label').html('Additional Comments');
                jQuery('.non-reject-in').show();
            }


        });
        jQuery(document).on('click', '.sendMailData', function(e) {
            e.preventDefault();
            jQuery('.sendMailData').html('Scheduling an Interview....');
            jQuery('.sendMailData').attr('disabled', true);

            var user = JSON.parse(jQuery('#hr-choose-interview-type').attr('data-user'));
            var type = jQuery('#hr-choose-interview-type').attr('data-type');
            var notfiy_sts = '';
            if (jQuery('#notify-sec').css('display') != 'none') {
                notfiy_sts = jQuery('#notify-status').is(':checked');
            }
            if (user.mname != '-' && user.mname != null) {
                var full_name = user.fname + ' ' + user.mname + ' ' + user.lname;
            } else if (user.lname != null) {
                var full_name = user.fname + ' ' + user.lname;
            } else {
                var full_name = user.fname;
            }
            var email = user.email;
            var entry_id = user.entryId;
            var phone = user.phone;
            var mobile = user.mobile;
            var email_content = tinymce.get('gp-save-mail-send').getContent();
            var email_subject = jQuery('#gp-mail-subject').val();
            var form_name = user.form_name;
            // date	
            var date = jQuery("#hr-date-pick").val();

            //interview timings

            var interview_timings = jQuery('#hr-choose-interview-timing').val();
            var interview_timings_to_save = jQuery('#hr-choose-interview-timing option:selected').attr('data-prop');

            // date_arr.push({	start_time: start_time });
            // date_arr.push({ end_time:  end_time	});
            //comments 

            var comments = jQuery('#gp-additonal-comments').val();

            // location 
            var location = jQuery('#hr-interview-location').val();

            //web conference interview type

            var conference_txt = 'On Site Interview';
            var interview_txt = 'On Site';


            if (jQuery('#hr-choose-interview-type').val() == 'Online') {
                conference_txt = 'Web conference interview';
                interview_txt = 'Web conference';
                var webconference_url = jQuery('#hr-interview-webconference').val();

                if (webconference_url == '') {
                    webconference_url = 'https:://meet.google.com/test';
                }
                location = webconference_url;
            }

            //Interview details 

            var interview_stage = jQuery('#hr-choose-interview-stage').val();
            var interview_status = jQuery('#hr-choose-interview-status').val();
            var interview_s_name = jQuery('#hr-choose-interview-status option:selected').text().toLowerCase();
            var interviewer = jQuery('#hr-choose-interviewer').val();
            var interview_post = jQuery('#hr-choose-posts-stage').val();
            var interview_stage_name = jQuery('#hr-choose-interview-stage option:selected').text();
            // console.log(email_content);

            var desc_html = '<div class="main-content">';
            //Candidate Details
            desc_html += '<br><div class="candidate-content">';
            if (jQuery('#hr-choose-interview-type').val() == 'Online') {
                desc_html += '<div class="webconference-label">';
                desc_html += '<u><strong>Webconference Url:</strong></u> ' + webconference_url;
                desc_html += '</div>';
            }
            desc_html += '<div class="candidate-label">';
            desc_html += '<label><u><strong>Candidate Details:</strong></u></label>';
            desc_html += '</div>';
            desc_html += '<div class="candidate-details">';
            desc_html += '<span>Candidate Email: </span> <span>' + email + '</span><br>';
            desc_html += '<span>Candidate Mobile | Phone: </span> <span>' + mobile + " | " + phone + '</span>';
            desc_html += '</div>';
            desc_html += '</div><br>';

            //Interview Details
            desc_html += '<div class="interview-content">';
            desc_html += '<div class="interview-label">';
            desc_html += '<label><u><strong>Interview Details:</strong></u></label>';
            desc_html += '</div>';
            desc_html += '<div class="interview-details">';
            desc_html += '<span>Interview Type: </span> <span>' + interview_txt + '</span><br>';
            desc_html += '<span>Interview Stage: </span> <span>' + interview_stage_name + '</span>';
            desc_html += '</div>';
            desc_html += '</div><br>';
            //Additional Details

            if (comments != '') {
                desc_html += '<div class="additional-content">';
                desc_html += '<div class="additional-label">';
                desc_html += '<label><u><strong>Additional Comments:</strong></u></label>';
                desc_html += '</div>';
                desc_html += '<div class="additional-details">';
                desc_html += comments;
                desc_html += '</div>';
                desc_html += '</div>';
            }

            desc_html += '</div>';


            if (interview_s_name == 'offer-rejected' || interview_s_name == 'rejected' || interview_s_name == 'withdrawn') {
                var data = {
                    action: 'WW_SaveEvent_ID_Action',
                    entry_id: entry_id,
                    interview_status: interview_status,
                    comments: comments,
                    type: type,
                    notfiy_sts: notfiy_sts,
                    email_subject: email_subject,
                    interviewer: interviewer,
                    interview_post: interview_post,
                    email: email,
                    full_name: full_name,
                    email_content: email_content,
                    data: event

                };
            } else {


                var duration = interview_timings;
                var startDate = new Date(date);
                var msDuration = (Number(duration.split(':')[0]) * 60 * 60 + Number(duration.split(':')[1]) * 60 + Number(duration.split(':')[2])) * 1000;
                var endDate = new Date(startDate.getTime() + msDuration);
                var isoStartDate = new Date(startDate.getTime() - new Date().getTimezoneOffset() * 60 * 1000).toISOString().split(".")[0];
                var isoEndDate = new Date(endDate.getTime() - (new Date().getTimezoneOffset()) * 60 * 1000).toISOString().split(".")[0];

                var timings_arr = interview_timings_to_save.split('-');

                var event = {
                    'summary': full_name + ' | ' + form_name + ' | ' + conference_txt,
                    'location': location,
                    'description': desc_html,
                    'start': {
                        'dateTime': isoStartDate,
                        'timeZone': 'Asia/Kolkata'
                    },
                    'end': {
                        'dateTime': isoEndDate,
                        'timeZone': 'Asia/Kolkata'
                    },
                    // 'recurrence': [
                    // 	'RRULE:FREQ=DAILY;COUNT=1'
                    // ],
                    'attendees': [{
                        'email': email
                    }],
                    'reminders': {
                        'useDefault': false,
                        'overrides': [{
                                'method': 'email',
                                'minutes': 2 * 60
                            },
                            {
                                'method': 'popup',
                                'minutes': 2 * 60
                            },
                        ]
                    }
                };
                var data = {
                    action: 'WW_SaveEvent_ID_Action',
                    entry_id: entry_id,
                    timings_arr: timings_arr,
                    interview_type: interview_txt,
                    interview_stage: interview_stage,
                    interviewer: interviewer,
                    interview_status: interview_status,
                    webconference_url: webconference_url,
                    interview_post: interview_post,
                    comments: comments,
                    type: type,
                    notfiy_sts: notfiy_sts,
                    email_subject: email_subject,
                    email: email,
                    full_name: full_name,
                    date: moment(date).format('YYYY-MM-DD HH:mm:ss'),
                    location: location,
                    email_content: email_content,
                    data: event

                };
            }

            // console.log(date_arr);
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    if (data.success == true) {
                        jQuery('.sendMailData').html('Scheduling an Interview');
                        jQuery('.sendMailData').removeAttr('disabled');
                        jQuery('#interviewModalCenter').modal('hide');
                        jQuery('.entry-int-' + entry_id).removeClass('hr-schedule-interview');
                        jQuery('.entry-int-' + entry_id).removeAttr('data-eventid');
                        jQuery('.entry-int-' + entry_id).removeAttr('data-entry');
                        jQuery('.entry-int-' + entry_id).addClass('disabled');
                        jQuery('.entry-int-' + entry_id).attr('data-bs-toggle', 'tooltip');
                        jQuery('.entry-int-' + entry_id).attr('data-bs-placement', 'left');
                        jQuery('.entry-int-' + entry_id).attr('title', 'Interview Already Scheduled');
                        jQuery('.entry-int-' + entry_id).html('<i class="uil uil-calendar-slash" aria-hidden="true"></i>');
                        if (interview_s_name == 'offer-rejected' || interview_s_name == 'rejected' || interview_s_name == 'withdrawn') {
                            if (interview_s_name == 'offer-rejected' || interview_s_name == 'rejected') {
                                var msg = 'Interview Has Been Rejected';
                            } else {
                                var uppercase = interview_s_name.replace(/\b[a-z]/g, function(letter) {
                                    return letter.toUpperCase();
                                });
                                var msg = 'Interview Has Been ' + uppercase;
                            }
                            jQuery.iaoAlert({
                                msg: "<strong>" + msg + "</strong>",
                                type: "success",
                                fadeOnHover: true,
                                roundedCorner: true,
                                zIndex: '9999999999',
                                mode: "dark",
                            });
                        } else {
                            jQuery.iaoAlert({
                                msg: "<strong>Interview Has Been Scheduled</strong>",
                                type: "success",
                                fadeOnHover: true,
                                roundedCorner: true,
                                zIndex: '9999999999',
                                mode: "dark",
                            });
                        }

                        // debugger;
                        if (type == 'reschedule') {
                            window.location.reload();
                        } else {
                            var read = jQuery('.n-readed-cs-' + entry_id);
                            jQuery('.read-stats-' + entry_id).find('small').remove();
                            read.removeAttr('data-entry-id');
                            jQuery('.n-readed-cs-' + entry_id).removeClass('n-readed');
                        }
                        // }
                    }
                }
            });

        });
        jQuery("#hr-date-pick").datetimepicker({
            minDate: moment().add(1, 'day'),
            format: 'Y-m-d h:m:s',
            // allowTimes:[
            // 	'10:00','11:00','12:00', '13:00', '15:00', 
            // 	'17:00', '17:05', '17:20', '19:00', '20:00'
            //    ],
            onChangeDateTime: function(dp, jQueryinput) {}

        });


        jQuery(document).on('click', '.hr-schedule-interview', function(e) {
            e.preventDefault();
            var data = jQuery(this).data('entry');
            jQuery("#hr-choose-interview-type").attr('data-user', JSON.stringify(data));
            jQuery("#hr-choose-interview-type").attr('data-type', 'schedule');
            jQuery("#hr-date-pick").attr('data-eventid', '');
            jQuery('#select-date-label').text('Select Date');
            jQuery('.interview-save-btn').text('Schedule an Interview');
            jQuery('#interviewModalCenter .modal-title').html('Schedule Interview #' + data.entryId);
            // console.log('hi');
            jQuery("#hr-choose-interview-type").attr('data-user', JSON.stringify(data));
            jQuery('#interviewModalCenter').find('#hr-choose-posts-stage option').each(function() {
                var formName = jQuery(this).text().trim();

                if (formName.trim() == data.form_name) {
                    jQuery('#interviewModalCenter').find('#hr-choose-posts-stage').val(jQuery(this).val());
                }
            });
            jQuery('#interviewModalCenter').modal('show');
            // dialog.dialog("open");
        });

        jQuery("#interviewModalCenter").on('hide.bs.modal', function() {
            // jQuery("#hr-date-pick").val('');
            jQuery("#hr-date-pick").attr('data-eventid', '');
            // jQuery('#hr-date-pick').datetimepicker('hide');
            jQuery('.gp-email-composer').val('').change();
            jQuery('.gp-save-top-content').show();
            jQuery('#gp-save-mail-send').val('').change();
            jQuery('.gp-submit-email-content').hide();
            jQuery('.sendMailData').addClass('interview-save-btn');
            jQuery('#hr-choose-interview-status').val('').change();
            jQuery('.interview-save-btn').removeClass('sendMailData');

        });


        jQuery(document).on('change', '#hr-choose-interview-type', function() {

            var type = jQuery(this).val();
            if (type == 'OnSite') {
                jQuery('#hr-interview-loc-content').show();
                jQuery('#hr-interview-webconference-content').hide();
            } else {
                jQuery('#hr-interview-loc-content').hide();
                jQuery('#hr-interview-webconference-content').show();
            }

        });


        //Save Email Template

        jQuery(document).on('click', '.select-email-template', function() {
            var target = jQuery(this).data('target');
            jQuery('.email-sub-btn').attr('data-value', target);
        });
        jQuery(document).on('click', '.email-sub-btn', function() {
            var content = '';
            var template_type = jQuery(this).attr('data-value');
            tinyMCE.triggerSave();

            if (template_type == 1) {
                var subject = jQuery('.email-subject-hr').val();
                content = jQuery('#gp-save-hr-form-editor').val();
            } else if (template_type == 2) {
                var subject = jQuery('.email-subject').val();
                content = jQuery('#gp-save-form-editor').val();
            } else if (template_type == 3) {
                var subject = jQuery('.email-subject-interviewer').val();
                content = jQuery('#gp-save-interviewer-form-editor').val();
            }

            var btn = jQuery(this);
            btn.addClass('disabled');
            btn.text('Saving...');
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'WW_SaveEmailTemplate_Action',
                    subject: subject,
                    content: content,
                    type: template_type

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
                    }
                    btn.removeClass('disabled');
                    btn.text('Save');
                }
            });

        });

        jQuery(document).on('click', '.reschedule-interview', function(e) {
            var data = jQuery(this).data('entry');
            var entryId = jQuery('.entryDetail').val();
            jQuery("#hr-choose-interview-type").attr('data-user', JSON.stringify(data));
            jQuery("#hr-choose-interview-type").attr('data-type', 'reschedule');
            jQuery('#select-date-label').text('Select Date');
            jQuery('.interview-save-btn').text('Rechedule an Interview');
            jQuery('#interviewModalCenter .modal-title').html('Reschedule Interview #' + entryId)
            jQuery('#interviewModalCenter').modal('show');

        });
        jQuery(document).on('change', '#entry-status', function() {
            var status = jQuery(this).children('option:selected').text();
            if (status.toLowerCase() == 'rejected' || status.toLowerCase() == 'withdrawn' || status.toLowerCase() == 'offer-rejected') {
                jQuery('#gp-reason').remove();
                var reason = '';
                if (jQuery('.main-reason').text() != '') {
                    reason = jQuery('.main-reason').text();
                }
                jQuery('#entry-status').after('<input type="text" id="gp-reason" class="form-control my-2" required value="' + reason + '" placeholder="Enter Reason">');
            } else {
                jQuery('#gp-reason').remove();
            }


        });
        jQuery(document).on('submit', '#hr-change-status', function(e) {
            e.preventDefault();
            var form = jQuery(this);
            form.find('.btn').addClass('disabled').html('Saving...');
            var status = jQuery('#entry-status').val();
            var status_text = jQuery('#entry-status option:selected').text();
            var reason = '';
            if (status_text.toLowerCase() == 'rejected' || status_text.toLowerCase() == 'withdrawn' || status_text.toLowerCase() == 'offer-rejected') {
                reason = jQuery('#gp-reason').val();

                if (jQuery('.main-reason').length == 0) {
                    jQuery('.user-status').append('<small><strong class="text-info">Reason: </strong><span class="text-secondary">' + reason + '</span></small>')
                } else {
                    jQuery('.main-reason').html(reason);
                }
            } else {
                jQuery('.main-reason').parent().parent().remove();
            }
            var id = jQuery('.entryDetail').val();
            var type = form.data('type');
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'WW_SaveStatusStage_Action',
                    id: id,
                    status: status,
                    type: type,
                    reason: reason

                },
                success: function(data) {
                    if (data.success == true) {

                        form.find('.btn').removeClass('disabled').html('Save');
                        var html = status_text + '<a href="javascript:;" class="gp-change-status" onclick=showHideModal("#changeStatusModal")> <i class="uil uil-edit-alt" aria-hidden="true"></i>	</a><br>';
                        jQuery('.gp-change-status').parent().html(html);
                        jQuery(".sta-stg-up .history-heading").after(data.html);
                        if (jQuery('.no-history-d').length > 0) {
                            jQuery('.no-history-d').parent().remove();
                        }
                        showHideModal('#changeStatusModal');
                        jQuery.iaoAlert({
                            msg: "<strong>" + data.message + "</strong>",
                            type: "success",
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '9999999999',
                            mode: "dark",
                        });
                    }
                }
            });

        });
        jQuery(document).on('submit', '#hr-change-stages', function(e) {
            e.preventDefault();
            var form = jQuery(this);
            form.find('.btn').addClass('disabled').html('Saving...');
            var stages = jQuery('#entry-stages').val();
            var stages_text = jQuery('#entry-stages option:selected').text();
            var id = jQuery('.entryDetail').val();
            var type = form.data('type');
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'WW_SaveStatusStage_Action',
                    id: id,
                    stages: stages,
                    type: type

                },
                success: function(data) {
                    if (data.success == true) {
                        // location.reload();
                        form.find('.btn').removeClass('disabled').html('Save');
                        var html = stages_text + '<a href="javascript:;" class="gp-change-stage" onclick=showHideModal("#changeStageModal")> <i class="uil uil-edit-alt" aria-hidden="true"></i>	</a><br>';
                        jQuery('.gp-change-stage').parent().html(html);
                        if (jQuery('.no-history-d').length > 0) {
                            jQuery('.no-history-d').parent().remove();
                        }
                        jQuery(".sta-stg-up .history-heading").after(data.html);
                        showHideModal('#changeStageModal');
                        jQuery.iaoAlert({
                            msg: "<strong>" + data.message + "</strong>",
                            type: "success",
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '9999999999',
                            mode: "dark",
                        });
                    }
                }
            });

        });
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger mx-2'
            },
            buttonsStyling: false
        })

        jQuery(document).on('click', '.delete-setting', function(e) {
            e.preventDefault();
            var btn = jQuery(this);
            var type = jQuery(this).attr('name');
            var id = jQuery(this).data('id');
            swalWithBootstrapButtons.fire({
                title: 'Are You Sure?',
                showCancelButton: true,
                confirmButtonText: 'Yes! Delete it',
                cancelButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    jQuery.ajax({
                        url: WW_AJAX_OBJECT.ajax_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'WW_DeleteSettings_Action',
                            type: type,
                            id: id
                        },
                        success: function(data) {

                            if (data.error == true) {
                                btn.parent().parent().remove();
                                jQuery.iaoAlert({
                                    msg: "<strong>" + data.message + "</strong>",
                                    type: "error",
                                    fadeOnHover: true,
                                    roundedCorner: true,
                                    zIndex: '9999999999',
                                    mode: "dark",
                                });

                            }
                        }
                    });
                }
            })
        });

        jQuery(document).on('submit', '.settings-save', function(e) {
            e.preventDefault();
            var sub_btn = jQuery(this).find('.btn');
            var input = jQuery(this).find('.settings-val');
            sub_btn.val('Saving...');
            sub_btn.addClass('disabled');
            var type = jQuery(this).find('.btn').attr('name');
            var val = input.val();
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'WW_SaveSettings_Action',
                    type: type,
                    value: val
                },
                success: function(data) {
                    var element_id = '';
                    var modal_name = '';
                    var count = 0;
                    var dName = '';
                    var main_cls = '';
                    var count_cls = '';
                    if (type == 'save_status') {
                        element_id = "#status-settings";
                        modal_name = '#addStatusModal';
                        dName = "delete_status";
                        count_cls = ".status-content";
                        main_cls = "row m-0 status-content";
                    } else if (type == 'save_posts') {
                        element_id = "#posts-settings";
                        modal_name = '#addPostModal';
                        dName = "delete_post";
                        count_cls = ".posts-content";
                        main_cls = "row m-0 posts-content";
                    } else {
                        element_id = "#stages-settings";
                        modal_name = '#addStageModal';
                        dName = "delete_stage";
                        count_cls = ".stages-content";
                        main_cls = "row m-0 stages-content";
                    }
                    if (data.success == true) {

                        var html = '';
                        count = (jQuery(count_cls).length) + 1;
                        html += '<div class="' + main_cls + '">';
                        html += '<div class="col-md-4 col-sm-4 col-4 text-center py-2">' + count + '</div>';
                        html += '<div class="col-md-4 col-sm-4 col-4 text-center py-2">' + val + '</div>';
                        html += '<div class="col-md-4 col-sm-4 col-4 text-center py-2">';
                        html += '<button type="submit" name="' + dName + '" data-id="' + data.id + '" class="btn btn-danger delete-setting"><i class="uil uil-trash-alt" aria-hidden="true"></i></button>';
                        html += '</div>';
                        html += '</div>';
                        // console.log(html);
                        jQuery(element_id).append(html);
                        sub_btn.val('Save');
                        sub_btn.removeClass('disabled');
                        input.val('');
                        showHideModal(modal_name);
                        jQuery.iaoAlert({
                            msg: "<strong>" + data.message + "</strong>",
                            type: "success",
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '9999999999',
                            mode: "dark",
                        });


                    } else {
                        input.val('');
                        jQuery.iaoAlert({
                            msg: "<strong>" + data.message + "</strong>",
                            type: "error",
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '9999999999',
                            mode: "dark",
                        });
                    }

                }
            });
        });

        jQuery(document).on('click', '.gp-create-form', function(e) {
            e.preventDefault();
            showHideModal('#createForm');
        });

        jQuery(document).on('submit', '#create-form-hr', function(e) {
            e.preventDefault();
            var btn = jQuery(this).find('.btn');
            btn.addClass('disabled');
            btn.html('Submitting...');
            var formTitle = jQuery(this).find('.custom-form-title').val();
            jQuery.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                type: 'GET',
                dataType: 'json',
                data: {
                    action: 'WW_createForm_Action',
                    formTitle: formTitle,
                },
                success: function(data) {
                    if (data.success == true) {
                        btn.removeClass('disabled');
                        btn.html('Submit');
                        window.location.href = data.url;
                    }
                }
            });
        });

        jQuery(document).on('submit', '#gp-edit-account', function(e) {
            e.preventDefault();
            var btn = jQuery(this).find('.btn');
            btn.addClass('disabled');
            btn.val('Updating...');
            var fd = new FormData(this);
            fd.append('action', 'WW_editAccount_Action');
            $.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data) {
                    btn.removeClass('disabled');
                    btn.val('Update');
                    if (data.success == true) {
                        jQuery.iaoAlert({
                            msg: "<strong>" + data.message + "</strong>",
                            type: "success",
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '9999999999',
                            mode: "dark",
                        });
                    } else if (data.error == true) {
                        jQuery.iaoAlert({
                            msg: "<strong>" + data.message + "</strong>",
                            type: "error",
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '9999999999',
                            mode: "dark",
                        });
                    }
                }
            })
        });
        //Show Google Login Modal
        jQuery(document).on('click', '.check-google-login', function(e) {
            e.preventDefault();
            jQuery('#checkGoogleStatus').modal('show');
        });


        jQuery(document).on('click', '.interview_read_status', function(e) {
            e.preventDefault();
            var read = jQuery(this);
            var entryId = jQuery(this).data('entry-id');
            var form_id = jQuery('#selected-form-id').val();
            if (entryId != '') {
                $.ajax({
                    url: WW_AJAX_OBJECT.ajax_url,
                    data: {
                        entryId: entryId,
                        action: 'WW_ReadInterview_Action'
                    },
                    type: 'POST',
                    success: function(data) {
                        jQuery('.read-stats-' + entryId + ' small').remove();
                        read.removeAttr('data-entry-id');
                        jQuery('.n-readed-cs-' + entryId).removeClass('n-readed');
                        var badge1 = jQuery('.badge-' + form_id + '-1');
                        var badge2 = jQuery('.badge-' + form_id + '-2');
                        var badge3 = jQuery('.badge-' + form_id + '-3');

                        if (parseInt(badge1.find('span').html()) != 0) {
                            badge1.find('span').html(parseInt(badge1.find('span').html()) - 1);
                        }
                        badge2.find('span').html(parseInt(badge2.find('span').html()) + 1);
                        badge3.find('span').html(parseInt(badge3.find('span').html()) + 1);
                    }
                });
            }
        });


        //Send Mail to Job Applicants Modal

        jQuery(document).on('click', '.hr-send-mail', function(e) {
            e.preventDefault();
            var user_email = jQuery(this).data('email');
            var user_name = jQuery(this).data('name');
            var user_post = jQuery(this).data('post');
            jQuery('#hr-user-email').val(user_email);
            jQuery('#hr-user-name').val(user_name);
            jQuery('#hr-user-post').val(user_post);
            jQuery('#send-mail-hr').modal('show');
        });

        //Send Mail to Job Applicants

        jQuery(document).on('submit', '#send-mail-hr-form', function(e) {
            e.preventDefault();
            jQuery('input[type="submit"]').val('Sending Mail...');
            jQuery('input[type="submit"]').addClass('disabled');
            var email = jQuery(this).find('#hr-user-email').val();
            var name = jQuery(this).find('#hr-user-name').val();
            var msg = jQuery(this).find('#hr-user-msg').val();
            var subject = jQuery(this).find('#hr-user-subject').val();
            var post = jQuery('#hr-user-post').val();
            $.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                data: {
                    email: email,
                    name: name,
                    msg: msg,
                    post: post,
                    subject: subject,
                    action: 'WW_SendMail_Action'
                },
                type: 'POST',
                success: function(data) {
                    if (data.success == true) {
                        jQuery.iaoAlert({
                            msg: data.msg,
                            type: 'success',
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '999999999999',
                            mode: "dark",
                        });
                    } else {
                        jQuery.iaoAlert({
                            msg: data.msg,
                            type: 'error',
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '999999999999',
                            mode: "dark",
                        });
                    }
                    jQuery('#send-mail-hr').modal('hide');
                    jQuery('input[type="submit"]').val('Send Mail');
                    jQuery('#send-mail-hr-form').find('#hr-user-msg').val('');
                    jQuery('#send-mail-hr-form').find('#hr-user-subject').val('');
                    jQuery('input[type="submit"]').removeClass('disabled');
                }
            });
        });


        //Rate 
        var prev_rate = '';
        jQuery(document).on('click', '.rate-applicant', function(e) {
            var entryId = jQuery(this).parent().data('entry');
            if (jQuery(this).is(':checked')) {
                var rating = jQuery(this).val();
                prev_rate = jQuery(this).val();
            }
            jQuery('#rating-reason').find('#entryId').val(entryId);
            jQuery('#rating-reason').find('#rating').val(rating);
            jQuery('#rating-reason').find('input[type="text"]').val('');
            jQuery('#rating-reason').modal('show');
        });
        jQuery(document).on('submit', '#add-rating-reason', function(e) {
            e.preventDefault();
            jQuery(this).find('input[type="submit"]').val('Rating...');
            jQuery(this).find('input[type="submit"]').addClass('disabled');

            var entryId = jQuery(this).find('#entryId').val();
            var rating = jQuery(this).find('#rating').val();
            var reason = jQuery(this).find('#reason-for-rating').val();
            var ratings = jQuery('.show_all_ratings-' + entryId + '').data('rating');
            $.ajax({
                url: WW_AJAX_OBJECT.ajax_url,
                data: {
                    entryId: entryId,
                    rating: rating,
                    reason: reason,
                    action: 'WW_SaveRating_Action'
                },
                type: 'POST',
                success: function(data) {
                    if (data.success == true) {
                        jQuery.iaoAlert({
                            msg: data.msg,
                            type: 'success',
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '999999999999',
                            mode: "dark",
                        });
                        jQuery('#rating-reason').modal('hide');
                        if (typeof ratings[data.user_id] !== 'undefined' && typeof ratings[data.user_id].ratings[entryId] !== 'undefined') {
                            ratings[data.user_id].ratings[entryId]['rate'] = rating;
                            ratings[data.user_id].ratings[entryId]['reason'] = reason;
                            jQuery('.show_all_ratings-' + entryId + '').attr('data-rating', JSON.stringify(ratings));
                        } else {
                            var arr = {};
                            arr['rate'] = rating;
                            arr['reason'] = reason;

                            ratings[data.user_id].ratings[entryId] = arr;

                            jQuery('.show_all_ratings-' + entryId + '').attr('data-rating', JSON.stringify(ratings));
                        }
                    } else {
                        jQuery.iaoAlert({
                            msg: data.msg,
                            type: 'error',
                            fadeOnHover: true,
                            roundedCorner: true,
                            zIndex: '999999999999',
                            mode: "dark",
                        });
                    }
                    jQuery('#add-rating-reason').find('input[type="submit"]').val('Rate');
                    jQuery('#add-rating-reason').find('input[type="submit"]').removeClass('disabled');
                }
            });
        })

        jQuery(document).on('click', '.show_all_ratings', function(e) {
            // e.preventDefault();
            jQuery('#all-ratings-table').modal('show');
            var ratings = jQuery(this).data('rating');
            var entryId = jQuery(this).data('entry');
            var html = '';

            jQuery.each(ratings, function(i, v) {
                var rate1, rate2, rate3, rate4, rate5 = '';
                var reason = '-';
                if (v.ratings[entryId] != undefined) {
                    if (v.ratings[entryId]['rate'] == '1') {
                        rate1 = 'checked=checked';
                    } else {
                        rate1 = '';
                    }

                    if (v.ratings[entryId]['rate'] == '2') {
                        rate2 = 'checked=checked';
                    } else {
                        rate2 = '';
                    }

                    if (v.ratings[entryId]['rate'] == '3') {
                        rate3 = 'checked=checked';
                    } else {
                        rate3 = '';
                    }

                    if (v.ratings[entryId]['rate'] == '4') {
                        rate4 = 'checked=checked';
                    } else {
                        rate4 = '';
                    }


                    if (v.ratings[entryId]['rate'] == '5') {
                        rate5 = 'checked=checked';
                    } else {
                        rate5 = '';
                    }

                }
                var user_id = v.id;
                if (v.ratings[entryId] != undefined) {
                    if (v.ratings[entryId]['reason'] != undefined) {
                        reason = v.ratings[entryId]['reason'];
                    }
                }
                html += '<tr>';
                html += '<td>' + v.name + '</td>';
                html += '<td>';
                html += "<div class='all_ratings_section'>";
                html += "<div class='rate'>";
                html += "<input type='radio' value='5' " + rate5 + "/>";
                html += "<label>5 stars</label>";
                html += "<input type='radio'  value='4' " + rate4 + "/>";
                html += "<label>4 stars</label>";
                html += "<input type='radio' value='3' " + rate3 + "/>";
                html += "<label>3 stars</label>";
                html += "<input type='radio' value='2' " + rate2 + "/>";
                html += "<label>2 stars</label>";
                html += "<input type='radio'  value='1' " + rate1 + "/>";
                html += "<label>1 star</label>";
                html += "</div>";
                html += "</div>";
                html += '</td>';
                html += '<td>' + reason + '</td>';
                html += '</tr>';


            });
            jQuery('.all-ratings-table tbody').empty();
            jQuery('.all-ratings-table tbody').append(html);
        });
    });

})(jQuery);