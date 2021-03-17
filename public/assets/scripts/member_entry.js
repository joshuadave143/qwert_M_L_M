var member_entry = function () {

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
    var check_spID = function () {
        $('#check').click(function (e) {
            e.preventDefault();
            $(this).text('Loading...')
            var btn = this;
            $.ajax({
                method:"get",
                headers: {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                url: base_url+"/api/members/"+$('#sponsor_id').val(),
                success: function (data) {
                    // data = JSON.parse(data)
                    console.log(data)
                    $("#spname").val(data.lastname+", "+data.firstname)
                }
                ,error: function(data) {
                    toastr['error']("Sponsor ID don't exist.", "Notifications")
                    $("#spname").val('')
                   
                },
                complete: function(){
                    $(btn).text('Check')
                    console.log('test')
                }
            });
        });
    }


    return {
        //main function to initiate the module
        init: function () {
           
            check_spID();
        }
    };

}();