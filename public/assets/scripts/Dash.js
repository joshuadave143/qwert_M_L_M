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

    var collect = function(){
        $('.collect').click(function (e) {
            e.preventDefault();
            var type = $(this).attr('data')

            if( $('#'+type).text() == 'P 0.00' ){
                toastr['warning']("You have nothing to collect.", "Notifications")
                return;
            }
            var btn = this;
            $(btn ).prop( "disabled", true );
            $(btn).text('Collecting...')
            $.ajax({
                method:"GET",
                headers: {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                url: base_url+"/api/collect/"+type,
                success: function (data) {
                    toastr['success'](data.messages.success, "Notifications")
                    $('#'+type).text('P 0.00')
                }
                ,error: function(data) {
                    toastr['error']("Error while collecting.", "Notifications")
                },
                complete: function(){
                    $(btn).text('Collect')
                    $(btn ).prop( "disabled", false );
                }
            });
        })
    }

    var check_ewallet = function(callback){
        $.ajax({
            method:"GET",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/vw_ewallet_total/",
            success: function (data) {
              
                $('#Payout').prop( "disabled", data == 0? true:'' );
                if(data != 0){
                    
                    check_payout_request()
                }
                else{

                }

                callback(data)
            }
        });
    }

    var check_payout_request = function(){
        $.ajax({
            method:"GET",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/payout/me",
            success: function (data) {
                if(data.length == 0 ){
                    $('#Payout').html('<i class="fa fa-paper-plane"></i> Request Payout');
                    $('#Payout').prop( "disabled", false );
                }
                else{
                    $('#Payout').text('Pending Request Payout');
                    $('#Payout').prop( "disabled", true );    
                }
            }
            
        });
    }

    var Payout = function(){
        $('#Payout').click(function (e) {
            e.preventDefault();
            var type = $(this).attr('data')

            var btn = this;
            $(btn ).prop( "disabled", true );
            $(btn).text('Sending Request...')

            check_ewallet(function(ewallet){
                // if( ewallet == 0 ){
                //     return
                // }
                $.ajax({
                    method:"POST",
                    headers: {
                        "Authorization": "Bearer "+localStorage.getItem('access_token')
                    },
                    url: base_url+"/api/payout",
                    data:{
                        amount:ewallet
                    },
                    success: function (data) {
                        console.log(data)
                        toastr['success'](data.messages.success, "Notifications")
                       
                        $(btn).text('Pending Request Payout')
                        $(btn ).prop( "disabled", true );
                    }
                    ,error: function(data) {
                        toastr['error']("Error while Sending.", "Notifications")
                    },
                    complete: function(){
                        // $(btn).text('Pending Request Payout')
                        // $(btn ).prop( "disabled", true );
                    }
                });
            })
            
        })
    }

    return {
        //main function to initiate the module
        init: function () {
            collect()
            submit();
            Payout()

            check_ewallet(function(){})
        }
    };

}();