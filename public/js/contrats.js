(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: 'fr',
        autoclose: true
    });

    

    // $(document).on('change','input:radio',function (){
    //     var id_departement = $('.departement').val();
    //     var id_client = $('.client').val();
    //     var id_region = $('.region').val();
    //     status = $('input[type=radio][name=status]:checked').attr('value');
    //     $.ajax({
    //         type: "POST",
    //         url: "forms/admin/contrat/req_gest_contrat.php",
    //         data: "id_departement="+ id_departement+"&status="+status+"&id_client="+id_client+"&id_region="+id_region, // on envoie $_GET['go']
    //         datatype: "html", // on veut un retour JSON
    //         success: function(data) {
    //             $('.afficher').html(data);
    //         }
    //     });
    // });

    $(document).on('change','.departement',function (){
        var id_departement = $('.departement').val();
        document.getElementById('region').selectedIndex=0;
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getByDep/" + id_departement,
            datatype: "json",
            success: function(data) {
                $('.client').empty();
                $('.client').append('<option value="0">Sélectionnez une valeur</option>');
                var list_cli = $.parseJSON(data);
                nb = 0;
                $.each(list_cli, function() {
                    $('.client').append('<option value="'+ list_cli[nb].id +'">'+ list_cli[nb].nom +'</option>');
                    nb++;
                });
            }
        });
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/getByDep/" + id_departement,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('change','.client',function (){
        var id_client = $('.client').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/getByClient/" + id_client,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('change','.region',function (){
        id_region = $('.region').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/departement/getByRegion/" + id_region,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.departement').empty();
                $('.departement').append('<option value="0">Sélectionnez une valeur</option>');
                var list_dep = $.parseJSON(data);
                nb = 0;
                $.each(list_dep, function() {
                    $('.departement').append('<option value="'+ list_dep[nb].id +'">'+ list_dep[nb].nom +'</option>');
                    nb++;
                });
            }
        });
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getByRegion/" + id_region,
            datatype: "json",
            success: function(data) {
                $('.client').empty();
                $('.client').append('<option value="0">Sélectionnez une valeur</option>');
                var list_cli = $.parseJSON(data);
                nb = 0;
                $.each(list_cli, function() {
                    $('.client').append('<option value="'+ list_cli[nb].id +'">'+ list_cli[nb].nom +'</option>');
                    nb++;
                });
            }
        });
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/getByRegion/" + id_region,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });  
    });
    
    $(document).on('dblclick','#listCONT tr',function (){
        var contrat_id = this.id;
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/" + contrat_id + "/edit",
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('#saisieCONT').empty();
                $('#saisieCONT').append(data);
            }
        });

        $("#saisieCONT").modal("show");
    });

    Number.prototype.padLeft = function(base,chr){
        var  len = (String(base || 10).length - String(this).length)+1;
        return len > 0? new Array(len).join(chr || '0')+this : this;
    }

    // $(document).on('click','.del-cont',function(){
    //     var contrat_id = this.id;
    //     $("#alert_contrat").modal("show");
    //     document.getElementById("text_suppr_contrat").innerHTML = "Etes-vous sur de vouloir supprimer le contrat n°"+contrat_id+"</b> de la liste des contrats ? <span><input style='opacity:0' id='id_cont_suppr' value='"+contrat_id+"'></input></span>";
    // });

    $(document).on('click','#btn-add',function(){
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/create",
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('#saisieCONT').empty();
                $('#saisieCONT').append(data);
            } 
        });
        $("#saisieCONT").modal("show");
    });


    // $(document).on('click','#bt_alert_suppr_contrat',function(){
    //     var id_contrat = document.getElementById('id_cont_suppr').value;
    //         $.ajax({
    //         type: "POST",
    //             url: "forms/admin/contrat/req_contrat_suppr.php",
    //             data: "id_contrat="+id_contrat, // on envoie $_GET['go']
    //             datatype: "html", // on veut un retour JSON
    //             success: function(data) {
    //                 $("#alert_contrat").modal("hide");
    //                 $('#text_success_contrat').html(data);
    //                 $("#success_contrat").modal("show");
    //             }
    //         });
    //         setTimeout(function(){  
    //             $("#success_contrat").modal("hide");
    //             affich_contrat();
    //         }, 2000);
    //         return false;
    // });
    
})(jQuery);