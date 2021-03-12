var TableEditable = function () {
    if (!window.location.origin) {
        window.location.origin = window.location.protocol + "//" 
          + window.location.hostname 
          + (window.location.port ? ':' + window.location.port : '');
      }
    var base_url = window.location.origin;
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-bottom-left",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
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
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[5].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#request_list');

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
                [0, "desc"]
            ], // set first column as a default sort by asc
            "sAjaxSource": base_url+'/Request_Logs/api',
            "sAjaxDataProp": "data"
        });
        
        var tableWrapper = $("#request_list");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            if (confirm("Are you sure to CANCEL this job request ?") == false) {
                return;
            }
            $.ajax({
                method:"post",
                url: base_url+'/Request_Logs/api/cancel',
                data:{
                    JOB_REQ_ID:$(nRow)[0].cells[0].innerText
                },
                success: function (data) {
                    
                    data = JSON.parse(data)
                    if( !data.has_error) {
                        toastr['success'](data.message.err_msg, "Notifications") 
                        
                    } 
                    else toastr['error'](data.message.err_msg, "Notifications")

                    RefreshTable();
                   
                }
            });
            
            oTable.fnDeleteRow(nRow);
        });

        table.on('click', '.view', function (e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            $.ajax({
                method:"get",
                url: base_url+'/Request_Logs/api/details',
                data:{
                    JOB_REQ_ID:$(nRow)[0].cells[0].innerText
                },
                success: function (data) {

                    data = JSON.parse(data)
                    $('#req_number').text($(nRow)[0].cells[0].innerText)
                    $("#details_job").html(prepare_data(data))
                    $('.screenshot').attr("src", "data:image/png;base64,"+data.SCREENSHOT);
                    $('.screenshot_href').attr("href", "data:image/png;base64,"+data.SCREENSHOT);
                    
                   
                }
            });
            
            if($('.req_det').is(":visible")){
                $('.req_det').hide("slow");
                $('.req_det').show("slow")
            }else{
                $('.req_det').show("slow")
            }
        });

        function prepare_data(raw_data){
            var data = '<dt>REQUEST DESCRIPTION</dt>'
            if( _is_IT(raw_data.requests.LIS) ){
                data += '<dt><u>Hardware</u></dt>';
                data +=  raw_data.requests.LIT.length == 0?'<dd> - </dd>':'';
                $.each(raw_data.requests.LIT, function( index, value ) {
                    data +=  '<dd> - '+value.DESCRIPTION+'</dd>';
                });
                
                data += '<dt><u>Software Installation</u></dt>'
                data +=  raw_data.requests.LIS.length == 0?'<dd> - </dd>':'';
                $.each(raw_data.requests.LIS, function( index, value ) {
                    data +=  '<dd> - '+value.DESCRIPTION+'</dd>';
                });

                data += '<dt><u>Network / Internet / Telephone</u></dt>'
                data +=  raw_data.requests.LNIT.length == 0?'<dd> - </dd>':'';
                $.each(raw_data.requests.LNIT, function( index, value ) {
                    data +=  '<dd> - '+value.DESCRIPTION+'</dd>';
                });
            }
            else{
                data += '<dt><u>In-house Application System</u></dt>';
                i = 0;
                $.each(raw_data.requests, function( index, value ) {
                    data += '<dt> - '+index+'</dt>';
                    $.each(value, function( index, values ) {
                        data +=  '<dd> - + '+values.DESCRIPTION+'</dd>';
                    })
                });
            }
            data += '<dt><u>Specify Request</u></dt>'
            data += '<dd> - '+(raw_data.OTHERS != null?raw_data.OTHERS:'')+'</dd>'
            
            data += '<dt>------------------------------------</dt>'
            data += '<dt>REPAIR INFORMATION</dt>'
            data += '<dt><u>Findings</u></dt>'
            data += '<dd> - '+(raw_data.FINDINGS != null?raw_data.FINDINGS:'')+'</dd>'
            data += '<dt><u>Action/s Taken</u></dt>'
            data += '<dd> - '+(raw_data.ACTION_TAKEN != null?raw_data.ACTION_TAKEN:'')+'</dd>'
            data += '<dt><u>Accomplished by</u></dt>'
            data +=  raw_data.ACCOMPLISHED_BY.length == 0?'<dd> - </dd>':'';
            $.each(raw_data.ACCOMPLISHED_BY, function( index, value ) {
                data += '<dt> - '+value+'</dt>';
            });
            data += '<dt><u>Accomplished date</u></dt>'
            data += '<dd> - '+(raw_data.ACTION_TAKEN != null?raw_data.ACCOMPLISHED_DATE:'')+'</dd>'
            return data;
        }

        function _is_IT($data){
            return $data != undefined;
        }

        $('.reload').on('click', function(e){
            RefreshTable();
        })
    }

    var RefreshTable = function (){
        // base_url+'/active-def-trans-nature'
        $.ajax({
            method: "get",
            url: base_url+'/Request_Logs/api',
            success: function(json){
                table = $('#request_list').dataTable();
                oSettings = table.fnSettings();

                table.fnClearTable(this);
                json = JSON.parse(json)
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

    var queue = function(){
        
        setInterval(function(){ 
            RefreshTable();// reload the table
            $.ajax({
                method:"post",
                url: base_url+'/Request_Logs/api/Queue',
                
                success: function (data) {
                    json = JSON.parse(data)
                    $(".IS_QUEUE").html(json.IS_QUEUE);
                    $(".IT_QUEUE").html(json.IT_QUEUE);
                }
            });

            }, 3000);
        
    }
    return {

        //main function to initiate the module
        init: function () {
            handleTable();
            queue();
        }

    };

}();