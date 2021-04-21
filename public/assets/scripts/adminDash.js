var adminDash = function () {
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


        var table = $('#request_payout');

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
                "url": base_url+"/api/payout",
                "contentType": "application/json",
               
                "data": function ( d ) {
                    
                    console.log(d)
                  return JSON.stringify( d );
                }
              }
        });

        var tableWrapper = $("#request_payout_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

       

        table.on('click', '.receive', function (e) {
            e.preventDefault();

            if (confirm("Are you sure the payout is Receive? Click \"Ok\" if yes ") == false) {
                return;
            }
            $(document.body).css({'cursor' : 'wait'})
            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            $.ajax({
                method:"put",
                headers: {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                url: base_url+"/api/payout/"+$(nRow)[0].childNodes[0].innerHTML,
                data:{
                    node_id:$(nRow)[0].childNodes[1].innerHTML
                },
                success: function (data) {
                    toastr['success'](data.messages.success, "Notifications")                
                }
                ,error: function(data) {
                    data = JSON.parse(data.responseText)
                    var error = ''
                    $.each( data.messages, function( key, value ) {
                        // console.log(key + ": " + value)
                        // error +=value+'<br>'
                        
                        toastr['error'](value, "Notifications")
                    });
                    
                     
                },
                complete: function(){
                    RefreshTable('request_payout')
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
            url: base_url+"/api/payout",
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