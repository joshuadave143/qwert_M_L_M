var payout_history = function () {
    var base_url = window.location.origin;
    var handleTable = function () {


        var table = $('#payout_history');

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
                "url": base_url+"/api/payout/history",
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

    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();