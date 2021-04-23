var developers_feeTable = function () {
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
    var handleTable = function () {

        var table = $('#dev_fee_table');

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
                "url": base_url+"/api/developers_fee",
                "contentType": "application/json",
               
                "data": function ( d ) {
                    
                  return JSON.stringify( d );
                }
              }
        });

        var tableWrapper = $("#dev_fee_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('.collect').click(function (e) {
            e.preventDefault();
            var amount = $(this).attr('data-amount')
            if(amount == '0.00') {
                toastr['warning']( 'There is no amount to collect.', "Notifications")
                return;
            }
            if (confirm("Previose row not saved. Do you want to save it ?")) {

                $.ajax({
                    method:"put",
                    headers: {
                        "Authorization": "Bearer "+localStorage.getItem('access_token')
                    },
                    url: base_url+"/api/developers_fee/collect",
                    success: function (data) {
                        toastr['success'](data.messages.success, "Notifications")
                        $('.collect').attr('data-amount','0.00') 
                        RefreshTable('dev_fee_table')
                    }
                    ,error: function(data) {
                        data = JSON.parse(data.responseText)
                        $.each( data.messages, function( key, value ) {
                            
                            toastr['error'](value, "Notifications")
                        });
                        
                    },
                    complete: function(){
                        $('#total').html('<i class="fa fa-ruble" style="font-size: 25px;"></i> 0.00');
                        $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                    }
                });
            }
        });

    }

    var RefreshTable = function (id){
        // base_url+'/active-def-trans-nature'
        $.ajax({
            method: "get",
            "headers": {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/developers_fee",
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

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();