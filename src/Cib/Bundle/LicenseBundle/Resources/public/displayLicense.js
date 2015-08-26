/**
 * Created by cedric on 20/08/2015.
 */

var headTable = $("#headTable");
var srcLoader = $('#divResult').attr("class");

$(document).ready(function(){

    }
);

$(".clientRow").on('click',function(){
    $.ajax({
        type : 'POST',
        url : Routing.generate('getTpeFromClient',{clientId: this.id}),
        content:'json',
        success : function(data){
            $('.modal').hide();
            $.each(JSON.parse(data), function(i,item){
                var test = (item.tpe_software);
                $.each(test,function(j,jtem){
                   console.log(jtem) ;
                });

                $("#tableBodyTpe").append('<tr class="rowResult" id="'+item.tpe_id+'"><td>'+item.tpe_serial_number+'</td>' +
                    '<td>'+item.tpe_software.software.software_name+'</td>'+'<td>'+item.info_sup0+'</td><td>'+item.info_sup1+'</td><td>'+item.info_sup2+'</td>' +
                    '<td>'+item.tpe_type+'</td><td>'+item.tpe_is_cless+'</td><td>'+item.tpe_is_bt+'</td>' +
                    '<td>'+item.tpe_is_gprs+'</td><td>'+item.tpe_is_wifi+'</td></tr>')
            });
            $(".modalLoading").hide();
        },
        beforeSend: function(){
            $(".rowResult").remove();
            $(".modalLoading").show();
        },
        error: function(){
            $(".modalLoading").hide();
        }


    })
});

$(".rowResult").on('click',function(){
   console.log('toto');
});
