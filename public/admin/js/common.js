$(document).ready(function () {
    /*** Validate form fields ***/
    initFormValidation();

    tick();
});

function initFormValidation()
{
    $.validator.addMethod(
        'regex',
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        'This field is invalid format'
    );

    $('form').each(function (key, form) {
        $(form).validate({
            errorClass: 'invalid-feedback',
            errorElement: 'span',
            errorPlacement: function (error, element) {
                element.parents('.form-group > div').append(error);
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).removeClass('is-invalid');
            },
            success: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    $('form .alert.has-error').on("close.bs.alert", function () {
        $(this).removeClass('show');
        return false;
    });
}

function tick() {
    $.ajax({
        type: 'POST',
        url: config.routes.tick,
        data: {},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.success) {
                if (data.logout) {
                    var logoutMsg = '로그아웃 되었습니다.';
                    if (data.reason == 'inactivity')
                        logoutMsg = '장시간 미사용으로 하여 자동 로그아웃되었습니다.';
                    alert(logoutMsg);
                    window.location.href = config.routes.logout;
                    return;
                }
                
                var new_users_cnt = data.data.new_users_cnt;
                var new_messages_cnt = data.data.new_messages_cnt;
                var new_inquiries_cnt = data.data.new_inquiries_cnt;
                var online_users_cnt = data.data.online_users_cnt;
                var new_statistics_cnt = data.data.new_statistics_cnt;
                
                $('#new_users_cnt').text(new_users_cnt);
                if (new_users_cnt > 0)
                {
                    var promise = $('#new_user_alarm')[0].play();
                    if (promise !== undefined) {
                        promise.then(_ => {
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
                else {
                    $('#new_user_alarm').stop();
                }
                $('#new_messages_cnt').text(new_messages_cnt);
                if (new_messages_cnt > 0)
                {
                    var promise = $('#new_message_alarm')[0].play();
                    if (promise !== undefined) {
                        promise.then(_ => {
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
                else {
                    $('#new_message_alarm').stop();
                }
                $('#new_statistics_cnt').text(new_statistics_cnt);
                if (new_statistics_cnt > 0)
                {
                    var promise = $('#new_statistics_alarm')[0].play();
                    if (promise !== undefined) {
                        promise.then(_ => {
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
                else {
                    $('#newstatistics_alarm').stop();
                }
                $('#new_inquiries_cnt').text(new_inquiries_cnt);
                if (new_inquiries_cnt > 0)
                {
                    var promise = $('#new_inquiry_alarm')[0].play();
                    if (promise !== undefined) {
                        promise.then(_ => {
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
                else {
                    $('#new_inquiry_alarm').stop();
                }
                $('#online_users_cnt').text(online_users_cnt);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
            if (xhr.status == 419)
                window.location.reload();
        },
        complete: function () {
            setTimeout(tick, 5000);
        }
    });
}