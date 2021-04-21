var unilevelTable = function () {
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
    
    var unilevel = function () {
        var table = $('#Unilevel_table');

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
                "url": base_url+"/api/vw_unilevel_details",
                "contentType": "application/json",
               
                "data": function ( d ) {
                    
                    console.log(d)
                  return JSON.stringify( d );
                }
              }
        });

        var tableWrapper = $("#product_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

    }

    return {

        //main function to initiate the module
        init: function () {
            unilevel();
            
        }

    };

}();