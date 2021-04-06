var dash = function () {

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

    var get_code_id = function(callback) {
        
        $.ajax({
            method: "GET",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/vw_product_code/"+$('#code').val(),
            success: function (data){
                callback(data)
            }
            ,error: function(data) {
                data = JSON.parse(data.responseText)
                console.log(data.messages.error)
                toastr['error'](data.messages.error, "Notifications")
            },
            complete: function(){
                $('#productcode').text('Claim')
                $( "#productcode" ).prop( "disabled", false );
                $( "#code" ).prop( "disabled", false );
            }

        })
    }

    var submit = function () {
       
        $('#productcode').click(function (e) {
            e.preventDefault();
            var btn = this;
            $( btn).prop( "disabled", true );
            $( "#code" ).prop( "disabled", true );
            $(btn).text('Claiming...')

            if( $('#code').val() == '' ){
                toastr['warning']("Please enter product code.", "Notifications")
                
                $(btn).text('Claim')
                $(btn ).prop( "disabled", false );
                $( "#code" ).prop( "disabled", false );
                return
            }
            get_code_id(function(data){
                
               
                $.ajax({
                    method:"PUT",
                    headers: {
                        "Authorization": "Bearer "+localStorage.getItem('access_token')
                    },
                    url: base_url+"/api/vw_product_code/"+data.procode_id,
                    success: function (data) {
                        toastr['success'](data.messages.success, "Notifications")
                        $("#code").val('')
                    }
                    ,error: function(data) {
                        toastr['error']("Product code doesn't exist.", "Notifications")
                        $("#code").val('')
                       
                    },
                    complete: function(){
                        $(btn).text('Claim')
                        $(btn ).prop( "disabled", false );
                        $( "#code" ).prop( "disabled", false );
                    }
                });
            })
           
        });
    }


    return {
        //main function to initiate the module
        init: function () {
           
            submit();
        }
    };

}();