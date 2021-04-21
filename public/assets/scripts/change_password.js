var FormEditable = function () {
    var base_url = window.location.origin;

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-bottom-left",
        "onclick": null,
        "showDuration": "2000",
        "hideDuration": "2000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $.mockjaxSettings.responseTime = 500;

    var initEditables = function () {

        //set editable mode based on URL parameter
        if (App.getURLParameter('mode') == 'inline') {
            $.fn.editable.defaults.mode = 'inline';
            $('#inline').attr("checked", true);
            jQuery.uniform.update('#inline');
        } else {
            $('#inline').attr("checked", false);
            jQuery.uniform.update('#inline');
        }

        $.ajaxSetup({
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
        });
        //global settings 
        $.fn.editable.defaults.inputclass = 'form-control';

        $.fn.editable.defaults.url = base_url+"/api/members/1";
        $.fn.editable.defaults.ajaxOptions = {type: "put"}
        
        $('#password').editable({
            url: base_url+"/api/security/1",
            type: "put",
            value: {
                password:   '',
                repassword: ''
            },
            validate: function (value) {
                if (value.password != value.repassword) return 'password don\'t match!';
                
                
            },
            display: function (value) {
                if (!value) {
                    $(this).empty();
                    return;
                }
                var html = 'Click';
                $(this).html(html);
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });
        
    }

    return {
        //main function to initiate the module
        init: function () {


            // init editable elements
            initEditables();
            
            // init editable toggler
            $('#enable').click(function () {
                $('#user .editable').editable('toggleDisabled');
            });

            // init 
            $('#inline').on('change', function (e) {
                if ($(this).is(':checked')) {
                    window.location.href = 'form_editable.html?mode=inline';
                } else {
                    window.location.href = 'form_editable.html';
                }
            });

            // handle editable elements on hidden event fired
            $('#user .editable').on('hidden', function (e, reason) {
                if (reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable');
                    if ($('#autoopen').is(':checked')) {
                        setTimeout(function () {
                            $next.editable('show');
                        }, 300);
                    } else {
                        $next.focus();
                    }
                }
            });


        }

    };

}();