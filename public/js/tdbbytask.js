(function(){

    // if (myadmin==0){
    //     document.getElementById('collab').disabled = 'false';
    // document.getElementById('collab').disabled = 'true';
    // };

        $(document).on('change','.collab_tdbt',function (){
        $('.client_tdbt').empty();
        var collab_id = $('.collab_tdbt').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getByCollab/" + collab_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.client_tdbt').empty();
                $('.client_tdbt').append('<option value="0">Sélectionnez une valeur</option>');
                var list_client = $.parseJSON(data);
                nb = 0;
                $.each(list_client, function() {
                    $('.client_tdbt').append('<option value="'+ list_client[nb].id +'">'+ list_client[nb].nom +'</option>');
                    nb++;
                });
            }
        });
    });

    $(document).on('change','.client_tdbt',function (){
        var collab_id = $('.collab_tdbt').val();
        var client_id = $('.client_tdbt').val();
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
                    $('.contrat_tdbt').append('<option value="'+ list_contrat[nb].id +'">'+ list_contrat[nb].description +'</option>');
                    nb++;
                });
            }
        });
    });

    $(document).on('change','.contrat_tdbt',function (){
        var contrat_id = $('.contrat_tdbt').val();
        var list_annee;
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/getAnneeContrat/" + contrat_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.annee_tdbh').empty();
                var list_annee = $.parseJSON(data);
                nb = 0;
                $.each($.parseJSON(data), function(value) {
                    $('.annee_tdbt').append('<option>'+ list_annee[nb] +'</option>');
                    nb++;
                });
            }
        });
    });
   
    $(document).on('click','#bt_affich',function (){
        var collab_id = $('.collab_tdbt').val();
        var client_id = $('.client_tdbt').val();
        var contrat_id = $('.contrat_tdbt').val();
        var annees = $('.annee_tdbt').val();
        $.ajax({
            type: "GET",
                url: APP_URL + "/tdbbytasks/getGraphTask/" + contrat_id + "/" + annees,
                datatype: "html", // on veut un retour HTML
                success: function(data) {
                    $('.afficher').html(data);
                    $('#icon-task').removeClass('fa-chevron-down');
                    $('#icon-task').addClass('fa-chevron-up');
                    $('#table-task').addClass('hide');
                    $('#table-bilan-task').addClass('hide');
                    $('#icon-bilan-task').removeClass('fa-chevron-down');
                    $('#icon-bilan-task').addClass('fa-chevron-up');
                }
        });
    });

    $(document).on('click','#icon-task',function (){
    	$('#icon-task').toggleClass('fa-chevron-down');
        $('#icon-task').toggleClass('fa-chevron-up');
        $('#table-task').toggleClass("hide");
        $('#table-task').toggleClass("show");
    });

    $(document).on('click','#icon-bilan-task',function (){
    	$('#icon-bilan-task').toggleClass('fa-chevron-down');
        $('#icon-bilan-task').toggleClass('fa-chevron-up');
        $('#table-bilan-task').toggleClass("hide");
        $('#table-bilan-task').toggleClass("show");
    });
    
})(jQuery);

