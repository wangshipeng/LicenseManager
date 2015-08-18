/**
 * Created by cedric on 22/10/2014.
 */

$.getCityFromZipCode = function(field,autocompleteField){

    var suggestions = [];
    if(field.value.length > 2)
    {
        var data = field.value;

        if(data.length < 5)
        {
            for(var i = data.length;i < 5;i++)
            {
                data = data+"0";
            }
        }

        $.ajax({
            url: "http://api.zippopotam.us/fr/" + data,
            cache: false,
            dataType: "json",
            type: "GET",
            success: function(result, success) {
                while(suggestions.length > 0){
                    suggestions.pop();
                }
                for ( ii in result['places']){
                    suggestions.push(result['places'][ii]['place name'].toUpperCase());
                }
                autocompleteField.autocomplete({
                    source: suggestions,
                    minLength: 0
                }).on('focus', function() { $(this).keydown(); });;

            }
        });
    }
};

$.removeElement = function(action){
    $( "#dialog" ).dialog({
        dialogClass: "no-close",
        modal: true,
        title: "SUPPRESSION",
        buttons: [
            {
                text: "OK",
                click: function() {
                    //$( this ).dialog( "close" );
                    window.location.href = action ;
                }
            },
            {
                text: "ANNULER",
                click: function(){
                    $( this ).dialog( "close" );
                }
            }

        ]
    }).html('Etes-vous sur de vouloir supprimer l\'élément séléctionné ?');

};

$.autoLoadCard = function(val,url,result){
    $.ajax({
        type : 'POST', // envoi des données en GET ou POST
        url : url , // url du fichier de traitement
        data : 'searchCard='+val, // données à envoyer en  GET ou POST
        content: 'json',
        success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
            //console.log($.parseJSON(data));
            var suggestion = [];
            $.each($.parseJSON(data), function(i, item) {
                suggestion.push(item.cardNumber);
            });
            cardContainer.autocomplete({
                source : suggestion,
                select : function(event, ui){
                    if(result)
                        selectResults(monthContainer.value,dateStartContainer.value,dateStopContainer.value,this.value,clientContainer.value,storeContainer.value,url,null);
                    else
                        $.selectGreenFee();
                }
            });
        }
    });
};


$.autoLoadClient = function(val,url,result){
    $.ajax({
        type : 'POST', // envoi des données en GET ou POST
        url : url , // url du fichier de traitement
        data : 'searchClient='+val, // données à envoyer en  GET ou POST
        content: 'json',
        success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
            //console.log($.parseJSON(data));
            var suggestion = [];
            $.each($.parseJSON(data), function(i, item) {
                suggestion.push(item.clientName + "\t"+ item.clientFirstName);
            });
            clientContainer.autocomplete({
                source : suggestion,
                select: function(event,ui){
                    if(result)
                        selectResults(monthContainer.value,dateStartContainer.value,dateStopContainer.value,cardContainer.value,this.value,storeContainer.value,url,null)
                    else
                        $.selectGreenFee();
                }
            });
        }

    });
};

$.displayLinkPages = function(page,totalPages,range,itemPerPage,greenFee){

    var pages = 0;
    var pageCount = 0;

    if(totalPages < page)
        pages = page = totalPages;

    if(range > totalPages)
        range = totalPages;

    var delta = Math.ceil(range/2);

    if(page - delta > totalPages - range)
    {
        pageCount = _.range(totalPages - range + 1, totalPages + 1);
    }
    else
    {
        if(page-delta < 0)
            delta = page;

        var offset = page - delta;
        pageCount = _.range(offset+1,(offset+range)+1);
    }

    var proximity = Math.floor(range/2);

    var startPage = page-proximity;
    var stopPage =  page+proximity;

    if(startPage < 1){
        stopPage = Math.min(stopPage + (1 - startPage),totalPages);
        startPage = 1;
    }
    if (stopPage > totalPages) {
        startPage = Math.max(startPage - (stopPage - totalPages), 1);
        stopPage = totalPages;
    }

    $.each(pageCount,function(i,item){
        if(page == item)
            pagesContainer.append('<a href="#" id="page'+item+'" class="linkPages" style="text-decoration: underline">'+ item +'&nbsp;</a>');
        else
            pagesContainer.append('<a href="#" id="page'+item+'" class="linkPages">'+ item +'&nbsp;</a>');
        if(!greenFee){
            $("#page"+item).on('click',function(){
                selectResults(monthContainer.value,dateStartContainer.value,dateStopContainer.value,cardContainer.value,this.value,storeContainer.value,url,item)
            });
        }
        else{
            $("#page"+item).on('click',function(){
                $.selectGreenFee(item);
            });
        }

    });
};