var product_codeTable = function () {
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
    var NotUseTable = function () {

       
        var table = $('#code_table');

        var oTable = table.dataTable({
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ], // set first column as a default sort by asc
            "ajax": { 
                type:'GET',
                "headers": {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                "url": base_url+"/api/vw_product_code",
                "contentType": "application/json",
               
                "data": function ( d ) {
                  return JSON.stringify( d );
                }
              }
        });

        var tableWrapper = $("#code_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        $('#generator').click(function (e) {
            e.preventDefault();
            product_list();
            
        });
        
        $('#generate').click(function (e) {
            e.preventDefault();
            $(document.body).css({'cursor' : 'wait'}); //make the cursor change to loading

            $.ajax({
                method:"post",
                headers: {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                url: base_url+"/api/vw_product_code",
                data: {
                    products    : $('#productList').val(),
                    total       : $('#total').val()
                },
                success: function (data) {
                    toastr['success'](data.messages.success, "Notifications")
                    RefreshTable('code_table')                
                }
                ,error: function(data) {
                    data = JSON.parse(data.responseText)
                    var error = ''
                    $.each( data.messages, function( key, value ) {
                        toastr['error'](value, "Notifications")
                    });
                   
                },
                complete: function(){
                    $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                }
            });
        });

    }

    var RefreshTable = function (id){
        // base_url+'/active-def-trans-nature'
        $.ajax({
            method: "get",
            "headers": {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/vw_product_code",
            "contentType": "application/json",
            success: function(json){
                table = $('#'+id).dataTable();
                oSettings = table.fnSettings();

                table.fnClearTable(this);
                // json = JSON.parse(json)
                console.log(json)
                for (var i=0; i<json.data.length; i++){
                    table.oApi._fnAddData(oSettings, json.data[i]);
                }

                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
                table.fnDraw();
            }
        })
        // $.getJSON(urlData, null, function( json ){
            
        // });
    }

    var product_list = function (){
        $.ajax({
            method:"get",
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/product/0/true",
            
            success: function (data) {
                // data = JSON.parse(data)
                var option = '';
                $('#productList option').remove();
                
                $.each(data, function( index, value ) {
                    option += '<option value="'+value.product_id+'">Product name: '+value.product_name+' | Amount: '+value.amount+'</option>'
                });
                  $('#productList').append(option)
            }
            ,error: function(data) {
                
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            NotUseTable();
        }

    };

}();