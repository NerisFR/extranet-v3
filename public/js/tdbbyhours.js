(function(){

    // if (myadmin==0){
    //     document.getElementById('collab').disabled = 'false';
    //     document.getElementById('collab').disabled = 'true';
    // };

    $(document).on('change','.collab_tdbh',function (){
        $('.client_tdbh').empty();
        var collab_id = $('.collab_tdbh').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getByCollab/" + collab_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.client_tdbh').empty();
                $('.client_tdbh').append('<option value="0">Sélectionnez une valeur</option>');
                var list_client = $.parseJSON(data);
                nb = 0;
                $.each(list_client, function() {
                    $('.client_tdbh').append('<option value="'+ list_client[nb].id +'">'+ list_client[nb].nom +'</option>');
                    nb++;
                });
            }
        });
    });

    $(document).on('change','.client_tdbh',function (){
        var collab_id = $('.collab_tdbh').val();
        var client_id = $('.client_tdbh').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/getByClientCollab/" + client_id + "/" + collab_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.contrat_tdbh').empty();
                $('.contrat_tdbh').append('<option value="0">Sélectionnez une valeur</option>');
                var list_contrat = $.parseJSON(data);
                nb = 0;
                $.each(list_contrat, function() {
                    $('.contrat_tdbh').append('<option value="'+ list_contrat[nb].id +'">'+ list_contrat[nb].description +'</option>');
                    nb++;
                });
            }
        });
    });

    $(document).on('change','.contrat_tdbh',function (){
        var contrat_id = $('.contrat_tdbh').val();
        var list_annee;
        $.ajax({
            type: "POST",
            url: "forms/tdb/hour/req_tdb_heures_annee.php",
            data: "&contrat_id="+contrat_id, // on envoie $_GET['go']
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.annee_tdbh').empty();
                var list_annee = $.parseJSON(data);
                nb = 0;
                $.each($.parseJSON(data), function(value) {
                    $('.annee_tdbh').append('<option>'+ list_annee[nb] +'</option>');
                    nb++;
                });
            }
        });
    });
   
    $(document).on('click','#bt_affich',function (){
        var collab_id = $('.collab_tdbh').val();
        var client_id = $('.client_tdbh').val();
        var contrat_id = $('.contrat_tdbh').val();
        var annees = $('.annee_tdbh').val();
        $.ajax({
            type: "POST",
            url: "forms/tdb/hour/req_tdb_heures.php",
            data: "collab_id="+collab_id+"&client_id="+client_id+"&contrat_id="+contrat_id+"&annees="+annees, // on envoie $_GET['go']
            datatype: "html", // on veut un retour HTML
            success: function(data) {
                $('.afficher').html(data);
                $('#icon-hour').removeClass('fa-chevron-down');
                $('#icon-hour').addClass('fa-chevron-up');
                $('#table-hour').addClass('hide');
                $('#table-bilan-hour').addClass('hide');
                $('#icon-bilan-hour').removeClass('fa-chevron-down');
                $('#icon-bilan-hour').addClass('fa-chevron-up');
            }
        });
        
        
    });

    $(document).on('click','#icon-hour',function (){
    	$('#icon-hour').toggleClass('fa-chevron-down');
        $('#icon-hour').toggleClass('fa-chevron-up');
        $('#table-hour').toggleClass("hide");
        $('#table-hour').toggleClass("show");
    });
    
    $(document).on('click','#icon-bilan-hour',function (){
    	$('#icon-bilan-hour').toggleClass('fa-chevron-down');
        $('#icon-bilan-hour').toggleClass('fa-chevron-up');
        $('#table-bilan-hour').toggleClass("hide");
        $('#table-bilan-hour').toggleClass("show");
    });
})(jQuery);

