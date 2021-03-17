var members_listTable = function () {
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
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
            jqTds[6].innerHTML = '<a class="edit btn btn-primary" function="Save" href=""><span class="fa fa-save"></span> Save</a> <a class="cancel btn btn-warning" href=""><span class="fa fa-undo"></span> Cancel</a>';
            // jqTds[7].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            // oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 5, false);
            oTable.fnUpdate('<a class="edit btn btn-success" href=""><span class="fa fa-edit"></span> Edit</a> '+
            '<a class="delete btn btn-danger" href=""><span class="fa fa-trash-o"></span> Delete</a>', nRow, 6, false);
            oTable.fnDraw();
        }


        var table = $('#member_table');

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
                "url": base_url+"/api/members",
                "contentType": "application/json",
               
                "data": function ( d ) {
                    
                    console.log(d)
                  return JSON.stringify( d );
                }
              }
        });

        var tableWrapper = $("#member_table_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#btn_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            oTable.fnDeleteRow(nRow);
            $.ajax({
                method:"delete",
                headers: {
                    "Authorization": "Bearer "+localStorage.getItem('access_token')
                },
                url: base_url+"/api/package/"+$(nRow)[0].childNodes[0].innerHTML,
                
                success: function (data) {
                    // data = JSON.parse(data)
                    console.log(data)
                    toastr['success'](data.messages.success, "Notifications")
                    
                    $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                    // Refresh when it is new to get the ID
                    // if( nNew ) 
                    RefreshTable('package_table')
                }
                ,error: function(data) {
                    data = JSON.parse(data.responseText)
                    var error = ''
                    $.each( data.messages, function( key, value ) {
                        // console.log(key + ": " + value)
                        // error +=value+'<br>'
                        
                        toastr['error'](value, "Notifications")
                    });
                    $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                    // RefreshTable('package_table')
                }
            });
        });

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
                if( nNew ){
                    method = "post"
                }else{
                    method = "put"
                    id = "/"+$(nRow)[0].childNodes[0].innerHTML
                }
                $.ajax({
                    method:method,
                    headers: {
                        "Authorization": "Bearer "+localStorage.getItem('access_token')
                    },
                    url: base_url+"/api/package"+id,
                    data:{
                        Name       :$(nRow)[0].childNodes[1].innerHTML,
                        Amount     :$(nRow)[0].childNodes[2].innerHTML,
                        Direct     :$(nRow)[0].childNodes[3].innerHTML,
                        Indirect   :$(nRow)[0].childNodes[4].innerHTML,
                        Developer  :$(nRow)[0].childNodes[5].innerHTML
                    },
                    success: function (data) {
                        // data = JSON.parse(data)
                       
                        toastr['success'](data.messages.success, "Notifications")
                        
                        $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                        // Refresh when it is new to get the ID
                        // if( nNew ) 
                        RefreshTable('package_table')
                    }
                    ,error: function(data) {
                        data = JSON.parse(data.responseText)
                        var error = ''
                        $.each( data.messages, function( key, value ) {
                            // console.log(key + ": " + value)
                            // error +=value+'<br>'
                            
                            toastr['error'](value, "Notifications")
                        });
                        $(document.body).css({'cursor' : 'default'}); // return to normal cursor
                        // RefreshTable('package_table')
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
            url: base_url+"/api/package",
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