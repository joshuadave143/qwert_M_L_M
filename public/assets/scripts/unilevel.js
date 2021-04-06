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
    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            // jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            // jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<a class="edit btn btn-primary" function="Save" href=""><span class="fa fa-save"></span> Save</a> <a class="cancel btn btn-warning" href=""><span class="fa fa-undo"></span> Cancel</a>';

        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit btn btn-success" href=""><span class="fa fa-edit"></span> Edit</a>', nRow, 3, false);
            oTable.fnDraw();
        }


        var table = $('#unilevel');

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
                "url": base_url+"/api/unilevel",
                "contentType": "application/json",
               
                "data": function ( d ) {
                    
                    console.log(d)
                  return JSON.stringify( d );
                }
              }
        });

        var tableWrapper = $("#unilevel_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;



        table.on('click', '.cancel', function (e) {
            e.preventDefault();

            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && $(this).attr("function") == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                $(document.body).css({'cursor' : 'wait'}); //make the cursor change to loading
                var method = ""
                var id = ""
                
                method = "put"
                id = "/"+$(nRow)[0].childNodes[0].innerHTML
                
                $.ajax({
                    method:"put",
                    headers: {
                        "Authorization": "Bearer "+localStorage.getItem('access_token')
                    },
                    url: base_url+"/api/unilevel"+id,
                    data:{
                        Amount     :$(nRow)[0].childNodes[2].innerHTML
                    },
                    success: function (data) {
                        // data = JSON.parse(data)
                        // console.log(data)
                        toastr['success'](data.messages.success, "Notifications")
                        
                        $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                        // Refresh when it is new to get the ID
                        // if( nNew ) 
                        RefreshTable('unilevel')
                    }
                    ,error: function(data) {
                        data = JSON.parse(data.responseText)
                        $.each( data.messages, function( key, value ) {
                            
                            toastr['error'](value, "Notifications")
                        });
                        $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                    }
                });
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
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
            url: base_url+"/api/unilevel",
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