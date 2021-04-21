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
        //editables element samples 
        // $('#username').editable({
        //     url: '/post',
        //     type: 'text',
        //     pk: 1,
        //     name: 'username',
        //     title: 'Enter username'
        // });

        $('#firstname').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#middlename').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#lastname').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#age').editable({
            validate: function (value) {
                
                if ( isNaN(value) ) return 'Age must be a number';
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#email').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });
        
        $('#gender').editable({
            prepend: "not selected",
            inputclass: 'form-control',
            source: [{
                    value: 1,
                    text: 'Male'
                }, {
                    value: 2,
                    text: 'Female'
                }
            ],
            display: function (value, sourceData) {
                var colors = {
                    "": "gray",
                    1: "green",
                    2: "blue"
                },
                    elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            },
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });
        
        $('#civil_status').editable({
            prepend: "not selected",
            inputclass: 'form-control',
            source: [{
                    value: 'Single',
                    text: 'Single'
                }, {
                    value: 'Merried',
                    text: 'Merried'
                }, {
                    value: 'Divorced',
                    text: 'Divorced'
                }, {
                    value: 'Separated',
                    text: 'Separated'
                }, {
                    value: 'Widowed',
                    text: 'Widowed'
                }
            ],
            display: function (value, sourceData) {
                var colors = {
                    "": "gray",
                    1: "green",
                    2: "blue"
                },
                    elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            },
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#birthdate').editable({
            inputclass: 'form-control',
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#mobile_no').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#tin').editable({
            validate: function (value) {
                if ( isNaN(value) ) return 'TIN must be a number';
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        function getSource() {
            var url = base_url+"/api/country";
            return $.ajax({
                type:  'GET',
                "headers": {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                async: true,
                url:   url,
                dataType: "json",
                "contentType": "application/json"
            });
        }

        getSource().done(function(result) {
            // console.log(result)
            var countries = [];
                $.each(result, function (k, v) {
                    countries.push({
                        id: v.country_id,
                        text: v.cname
                    });
                });
            
            $('#country').editable({
                inputclass: 'form-control input-medium',
                source: countries,
                
                success: function(response, newValue) {
                    toastr['success'](response.messages.success, "Notifications")
                }
            });


        }).fail(function() {
            alert("Error with coutry function!")
        });

        $('#address').editable({
            url: base_url+"/api/members/1",
            type: "put",
            value: {
                city: $('#address').attr('data-city'),
                address: $('#address').attr('data-street'),
                province: $('#address').attr('data-province'),
                postcode: $('#address').attr('data-postal_code')
            },
            validate: function (value) {
                if (value.city == '') return 'city is required!';
                if (value.address == '') return 'address is required!';
                if (value.province == '') return 'province is required!';
                if (value.postcode == '') return 'postcode is required!';
            },
            display: function (value) {
                if (!value) {
                    $(this).empty();
                    return;
                }
                var html = '<b>' + $('<div>').text(value.address).html() + '</b>, ' + $('<div>').text(value.city).html() + ', ' + $('<div>').text(value.province).html()+" "+ $('<div>').text(value.postcode).html();
                $(this).html(html);
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#mop_cash').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#mop_bank_deposit').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            success: function(response, newValue) {
                toastr['success'](response.messages.success, "Notifications")
            }
        });

        $('#mop_bank_details').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
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