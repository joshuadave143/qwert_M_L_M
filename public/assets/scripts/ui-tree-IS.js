var UITree = function () {
    if (!window.location.origin) {
        window.location.origin = window.location.protocol + "//" 
          + window.location.hostname 
          + (window.location.port ? ':' + window.location.port : '');
      }
    var base_url = window.location.origin;
    var search = window.location.search;
     var ajaxTreeSample = function() {
       $("#tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }, 
                // so that create works
                "check_callback" : true,
                'data' : {
                        "dataType" : "json",
                        'url' : function (node) {
                        return 'IS/api';
                     },
                    'data' : function (node) {
                        return { 'parent' : node.id };
                     }
               },
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "search": {
                "case_insensitive": false,
                "show_only_matches" : true,
                fuzzy: false
            },
            "plugins" : [ "search","dnd", "types","state" ]
        }).bind("select_node.jstree", function (e, data) {
            var href = data.node.a_attr.href;
            var text = data.node.text;
            var parentId = data.node.a_attr.parent_id;
            console.log(data)
            if(href == '#')
            return '';
            $('#search').val(text)
            $('#appsid').val(href)
            // window.open(href);
            
        }).bind('ready.jstree', function(e, data) {
               // $('#tree_4').jstree().restore_state();
               // $('#tree_4').jstree().clear_state();
         })
      
        $('#tree_4').slimScroll({
            height: '200px'
        });

        $('#search').keyup(function(e){
            var code = e.which; // recommended to use e.which, it's normalized across browsers
            if(code==13)e.preventDefault();
            $('#tree_4').jstree('search', $(this).val());
            console.log($(this).val())
        });

        
    }

    var countWords = function (){
        var limit = 255;
        $("#other").keyup(function(){
            var count = $("#other").val().length;
            $('#limit').text((limit-count)+" Character(s) Remaining")
        })
        
    }

   var handleMultiSelect = function () {
      $('#ias_data').multiSelect();
   }

   var detect_others = function(){
        IS_counter = 0 

        /**
        * check if there is others selected after the page was submit or reload.
        */
       $.each($("#ias_data option:selected"), function( index, value ) {
           if( value.text == "Others" || value.text == "others" ){
                IS_counter = 1
           }
       });
       /**
       * dectect "others"
       */


      $("#ias_data").on('change',function(){
          detect = parseInt($('#others_detect').val(),10)
          var raw = $("#ias_data option:selected")
          see_other = false
          $.each(raw, function( index, value ) {
              if( value.text == "Others" || value.text == "others" ){
                  see_other = true
              }
          });

          if(see_other && IS_counter == 0){
            IS_counter = 1
              $('#others_detect').val(detect+1);
          }
          else if( !see_other && IS_counter == 1 ){
            IS_counter = 0
              $('#others_detect').val(detect-1);
          }            
      })
   }
    return {
        //main function to initiate the module
        init: function () {
            ajaxTreeSample();
            handleMultiSelect();
            countWords();
            detect_others();
            
            if((search.split("?")[1] || '').split("=")[0] == "error"  ){
               $('#tree_4').jstree(true).restore_state()
            }else{
               $('#tree_4').jstree(true).clear_state()
            }

        }

    };

}();