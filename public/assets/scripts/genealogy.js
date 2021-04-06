var genealogy = function(){
    var base_url = window.location.origin;
    var get_nodes = function(node_id,foo){
        $.ajax({
            method:'get',
            headers: {
                "Authorization": "Bearer "+localStorage.getItem('access_token')
            },
            url: base_url+"/api/nodes/"+node_id,
            success: function (data) {
                foo(data)
            }
        });
    }

    var load_geneology = function(node_id){
        var target = $(".tree ul li");
        target.hide(100, function(){ target.remove(); });
        // $(".tree ul li").hide(200000).remove() // remove the content first before we load the neww node
        get_nodes(node_id,function(members){
            // console.log(members)
            var is_first_loop = 0
            members = JSON.parse(members);
            
            (function heya( sponsor_id ){
                
                // This is slow and iterates over each object everytime.
                // Removing each item from the array before re-iterating 
                // may be faster for large datasets.
                for(var i = 0; i < members.length; i++){
                    
                    var member = members[i];
                   
                    if(member.sponsor_id == sponsor_id){
                       
                        if( i  > 0 ){
                            if(sponsor_id){
                                $("div#containerFor" + sponsor_id).replaceWith(function() { 
                                    return "<ul id='containerFor" + sponsor_id + "'></ul>"; 
                                });
                            }
                              
                        }
                        var parent = sponsor_id ? $("#containerFor" + sponsor_id) : $(".tree ul"),
                        node_id = member.node_id
                            ,metaInfo = "<i class='icon-user'></i><br>"+ member.fullname + " <br>" + member.member_id ;
                        parent.append("<li "+(is_first_loop == 0?'style="margin: auto; display:none"':'')+" ><a href='#' class='"+(is_first_loop != 0?"member":'')+"' node-id='"+member.node_id+"'>" + metaInfo+"</a><div id='containerFor" + node_id + "'></div></li>");
                        is_first_loop++;
                        heya(node_id);
                    } 
                }
             }( 0 ));
             $(".tree ul li").show()
        });
    }

    var select_node = function(){
        var node_a = $(".member");

        node_a.live('click',function(e){
            e.preventDefault();
            // console.log($(this).attr('node-id'))
            load_geneology($(this).attr('node-id'))
        })

        $(".reload").on('click',function(){ 
            load_geneology($('#node_id').val())
        })
    }

   

    return{
        init: function () {
           
            load_geneology($('#node_id').val())

            select_node();
        }
    }
}();

// var members = [
//     {node_id : 1, sponsor_id:0, member_id:200, fullname:"blah"},
//     {node_id : 2, sponsor_id:1, member_id:300, fullname:"blah1"},
//     {node_id : 3, sponsor_id:1, member_id:400, fullname:"blah2"},
//     {node_id : 4, sponsor_id:3, member_id:500, fullname:"blah3"},
//     {node_id : 6, sponsor_id:1, member_id:600, fullname:"blah4"},
//     {node_id : 9, sponsor_id:4, member_id:700, fullname:"blah5"},
//     {node_id : 12, sponsor_id:2, member_id:800, fullname:"blah6"},
//     {node_id : 5,  sponsor_id:2, member_id:900, fullname:"blah7"},
//     {node_id : 13, sponsor_id:2, member_id:0,   fullname:"blah8"},
//     {node_id : 14, sponsor_id:2, member_id:800, fullname:"blah9"},
//     {node_id : 55, sponsor_id:2, member_id:250, fullname:"blah10"},
//     {node_id : 56, sponsor_id:3, member_id:10,  fullname:"blah11"},
//     {node_id : 57, sponsor_id:3, member_id:990, fullname:"blah12"},
//     {node_id : 58, sponsor_id:3, member_id:400, fullname:"blah13"},
//     {node_id : 59, sponsor_id:6, member_id:123, fullname:"blah14"},
//     {node_id : 54, sponsor_id:6, member_id:321, fullname:"blah15"},
//     {node_id : 53, sponsor_id:1, member_id:10000, fullname:"blah7"},
//     {node_id : 52, sponsor_id:2, member_id:47,  fullname:"blah17"},
//     {node_id : 51, sponsor_id:6, member_id:534, fullname:"blah18"},
//     {node_id : 50, sponsor_id:53, member_id:55943, fullname:"blah19"},
//     {node_id : 22, sponsor_id:9,  member_id:2,  fullname:"blah27"},
//     {node_id : 11, sponsor_id:22,  member_id:22,  fullname:"blah27"},
//     {node_id : 100, sponsor_id:11,  member_id:22,  fullname:"blah27"},
//     {node_id : 101, sponsor_id:100,  member_id:22,  fullname:"blah27"},
//     {node_id : 102, sponsor_id:1,  member_id:22,  fullname:"blah27"},
//     {node_id : 103, sponsor_id:1,  member_id:22,  fullname:"blah27"},
//     {node_id : 104, sponsor_id:102,  member_id:22,  fullname:"blah27"},
//     {node_id : 105, sponsor_id:103,  member_id:22,  fullname:"blah27"},
//     {node_id : 104, sponsor_id:102,  member_id:22,  fullname:"blah27"},
//     {node_id : 33, sponsor_id:53, member_id:-10,fullname:"blah677"}
    
// ];
// https://jsfiddle.net/vVmcC/4/
