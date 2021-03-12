var Form_IT = function () {

    var handleMultiSelect = function () {
        $('#hardware_data').multiSelect();
        $('#software_installation_data').multiSelect();
        $('#nit_data').multiSelect();
    }

    var countWords = function (){
        var limit = 255;
        $("#other").keyup(function(){
            var count = $("#other").val().length;
            $('#limit').text((limit-count)+" Character(s) Remaining")
        })
        
    }

    var detect_others = function(){
        hard_counter = 0;
        soft_counter = 0;
        nit_counter  = 0;

        /**
         * check if there is others selected after the page was submit or reload.
         */
        $.each($("#hardware_data option:selected"), function( index, value ) {
            if( value.text == "Others" || value.text == "others" ){
                hard_counter = 1
            }
        });
        $.each($("#software_installation_data option:selected"), function( index, value ) {
            if( value.text == "Others" || value.text == "others" ){
                soft_counter = 1
            }
        });
        $.each($("#nit_data option:selected"), function( index, value ) {
            if( value.text == "Others" || value.text == "others" ){
                nit_counter = 1
            }
        });

        /**
         * dectect "others"
         */


        $("#hardware_data").on('change',function(){
            detect = parseInt($('#others_detect').val(),10)
            var raw = $("#hardware_data option:selected")
            see_other = false
            console.log(raw)
            $.each(raw, function( index, value ) {
                console.log(value.text)
                if( value.text == "Others" || value.text == "others" ){
                    see_other = true
                }
            });

            if(see_other && hard_counter == 0){
                hard_counter = 1
                $('#others_detect').val(detect+1);
            }
            else if( !see_other && hard_counter == 1 ){
                hard_counter = 0
                $('#others_detect').val(detect-1);
            }            
        })

        $("#software_installation_data").on('change',function(){
            detect = parseInt($('#others_detect').val(),10)
            var raw = $("#software_installation_data  option:selected")
            see_other = false
            $.each(raw, function( index, value ) {
                if( value.text == "Others" || value.text == "others" ){
                    see_other = true
                }
            });

            if(see_other && soft_counter == 0){
                soft_counter = 1
                $('#others_detect').val(detect+1);
            }
            else if( !see_other && soft_counter == 1 ){
                soft_counter = 0
                $('#others_detect').val(detect-1);
            }         
        })

        $("#nit_data").on('change',function(){
            detect = parseInt($('#others_detect').val(),10)
            var raw = $("#nit_data  option:selected")
            see_other = false
            $.each(raw, function( index, value ) {
                if( value.text == "Others" || value.text == "others" ){
                    see_other = true
                }
            });

            if(see_other && nit_counter == 0){
                nit_counter = 1
                $('#others_detect').val(detect+1);
            }
            else if( !see_other && nit_counter == 1 ){
                nit_counter = 0
                $('#others_detect').val(detect-1);
            }            
        })

    }


    return {
        //main function to initiate the module
        init: function () {
           
            handleMultiSelect();
            countWords();
            detect_others();
        }
    };

}();