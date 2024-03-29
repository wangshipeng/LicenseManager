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
                $.each(item.tpe_software,function(j,jtem){
                    $("#tableBodyTpe").append('<tr class="rowResult" id="'+item.tpe_id+'"><td>'+item.tpe_serial_number+'</td>' +
                        '<td>'+jtem.software.software_name+'</td><td>'+jtem.software_license_number+'</td>'+
                        '<td>'+item.info_sup0+'</td><td>'+item.info_sup1+'</td>' +
                        '<td>'+item.info_sup2+'</td>' +
                        '<td>'+item.tpe_type+'</td><td>'+item.tpe_is_cless+'</td><td>'+item.tpe_is_bt+'</td>' +
                        '<td>'+item.tpe_is_gprs+'</td><td>'+item.tpe_is_wifi+'</td><td>'+jtem.software_apn+'</td>' +
                        '<td>'+jtem.software_login+'</td><td>'+jtem.software_pwd+'</td></tr>');

                    $("#"+item.tpe_id).on('click',function(){
                        console.log('toto');
                    });
                });
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

