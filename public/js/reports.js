(function(){
	
    // Affich_NDS();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        endDate: "today",
        language: 'fr',
        autoclose: true
    });

    $(document).on('change','.collab',function (){
        $('.client').empty();
        var collab_id = $('.collab').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getByCollab/" + collab_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.client').empty();
                $('.client').append('<option value="0">Sélectionnez une valeur</option>');
                var list_client = $.parseJSON(data);
                nb = 0;
                $.each(list_client, function() {
                    $('.client').append('<option value="'+ list_client[nb].id +'">'+ list_client[nb].nom +'</option>');
                    nb++;
                });
            }
        });
    });

    $(document).on('change','.client',function (){
        var collab_id = $('.collab').val();
        var client_id = $('.client').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/contrat/getByClientCollab/" + client_id + "/" + collab_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.contrat').empty();
                $('.contrat').append('<option value="0">Sélectionnez une valeur</option>');
                var list_contrat = $.parseJSON(data);
                nb = 0;
                $.each(list_contrat, function() {
                    $('.contrat').append('<option value="'+ list_contrat[nb].id +'">'+ list_contrat[nb].description +'</option>');
                    nb++;
                });
            }
        });
    });

    $(document).on('change','.collab_consult',function (){
    	$('.client_consult').empty();
        var datedeb = $('.date_debut').val().split("/").reverse().join("-");
        var datefin = $('.date_fin').val().split("/").reverse().join("-");
        var collab_id = $('.collab_consult').val();
        var type_heure = $('.type_heure_consult').val();
        // alert(APP_URL + "/client/getByCollab/" + collab_id + "/" + datedeb + "/" + datefin);
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getByCollab/" + collab_id,
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.client_consult').empty();
                $('.client_consult').append('<option value="0">Sélectionnez une valeur</option>');
                var list_client = $.parseJSON(data);
                nb = 0;
                $.each(list_client, function() {
                    $('.client_consult').append('<option value="'+ list_client[nb].id +'">'+ list_client[nb].nom +'</option>');
                    nb++;
                });
            }
        });
        $('#listNDS').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: APP_URL + "/report/getByCollab/" + collab_id + "/" + datedeb + "/" + datefin + "/" + type_heure,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
        
    });

    $(document).on('change','.client_consult',function (){
    	$('.contrat_consult').empty();
        var datedeb = $('.date_debut').val().split("/").reverse().join("-");
        var datefin = $('.date_fin').val().split("/").reverse().join("-");
        var collab_id = $('.collab_consult').val();
        var client_id = $('.client_consult').val();
        var type_heure = $('.type_heure_consult').val();
        $.ajax({
        	type: "GET",
			url: APP_URL + "/contrat/getByClientCollab/" + client_id + "/" + collab_id,
			datatype: "json", // on veut un retour JSON
			success: function(data) {
				$('.contrat_consult').empty();
				$('.contrat_consult').append('<option value="0">Sélectionnez une valeur</option>');
				var list_contrat = $.parseJSON(data);
				nb = 0;
				$.each(list_contrat, function() {
				    $('.contrat_consult').append('<option value="'+ list_contrat[nb].id +'">'+ list_contrat[nb].description +'</option>');
				    nb++;
				});
			}
        });
        $('#listNDS').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: APP_URL + "/report/getByClientCollab/" + client_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('change','.contrat_consult',function (){
        var collab_id = $('.collab_consult').val();
        var contrat_id = $('.contrat_consult').val();
        var datedeb = $('.date_debut').val().split("/").reverse().join("-");
        var datefin = $('.date_fin').val().split("/").reverse().join("-");
        var type_heure = $('.type_heure_consult').val();
        $.ajax({
            type: "GET",
            url: APP_URL + "/report/getByContratCollab/" + contrat_id + "/" + collab_id + "/" + datedeb + "/" + datefin + "/" + type_heure,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('change','.type_heure_consult',function (){
        var collab_id = $('.collab_consult').val();
        var datedeb = $('.date_debut').val().split("/").reverse().join("-");
        var datefin = $('.date_fin').val().split("/").reverse().join("-");
        var type_heure = $('.type_heure_consult').val();
        if ($('.client_consult').selectedIndex = 0){
            $url = APP_URL + "/report/getByCollab/" + collab_id + "/" + datedeb + "/" + datefin + "/" + type_heure;
            // alert($url);
        }
        else if ($('.client_consult').selectedIndex != '0'){
            var client_id = $('.client_consult').val();
            $url = APP_URL + "/report/getByClientCollab/" + client_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure;
            // alert($url);
        }
        else {
            var contrat_id = $('.contrat_consult').val();
            $url = APP_URL + "/report/getByContratCollab/" + contrat_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure;
            // alert($url);
        }
        var contrat_id = $('.contrat_consult').val();
        $('#listNDS').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: $url,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('changeDate','.date_debut',function (){
        var collab_id = $('.collab_consult').val();
        var datedeb = $('.date_debut').val().split("/").reverse().join("-");
        var datefin = $('.date_fin').val().split("/").reverse().join("-");
        var type_heure = $('.type_heure_consult').val();
        if ($('.client_consult').selectedIndex = '0'){
            $url = APP_URL + "/report/getByCollab/" + collab_id + "/" + datedeb + "/" + datefin + "/" + type_heure;
            // alert($url);
        }
        else if ($('.client_consult').selectedIndex != '0'){
            var client_id = $('.client_consult').val();
            $url = APP_URL + "/report/getByClientCollab/" + client_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure;
            // alert($url);
        }
        else {
            var contrat_id = $('.contrat_consult').val();
            $url = APP_URL + "/report/getByContratCollab/" + contrat_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure;
            // alert($url);
        }
        var contrat_id = $('.contrat_consult').val();
        $('#listNDS').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: $url,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('changeDate','.date_fin',function (){
        var collab_id = $('.collab_consult').val();
        var datedeb = $('.date_debut').val().split("/").reverse().join("-");
        var datefin = $('.date_fin').val().split("/").reverse().join("-");
        var type_heure = $('.type_heure_consult').val();
        if ($('.client_consult').selectedIndex = '0'){
            $url = APP_URL + "/report/getByCollab/" + collab_id + "/" + datedeb + "/" + datefin + "/" + type_heure;
            // alert($url);
        }
        else if ($('.client_consult').selectedIndex != '0'){
            var client_id = $('.client_consult').val();
            $url = APP_URL + "/report/getByClientCollab/" + client_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure;
            // alert($url);
        }
        else {
            var contrat_id = $('.contrat_consult').val();
            $url = APP_URL + "/report/getByContratCollab/" + contrat_id + "/" + collab_id + "/" + datedeb + "/" + datefin+ "/" + type_heure;
            // alert($url);
        }
        var contrat_id = $('.contrat_consult').val();
        $('#listNDS').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: $url,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });
    
    Number.prototype.padLeft = function(base,chr){
        var  len = (String(base || 10).length - String(this).length)+1;
        return len > 0? new Array(len).join(chr || '0')+this : this;
        }

    $(document).on('dblclick','#listNDS tr',function (){
        var nds_id = this.id;
        $.ajax({
            type: "GET",
            url: APP_URL + "/report/" + nds_id + "/edit",
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('#saisie').empty();
                $('#saisie').append(data);
            }
        });
        $("#saisie").modal("show");
    });

    $("#bt_impr").on('click',function(){
        var nds_id = document.getElementById('num_id').value;
        window.open("forms/nds/consult/print_nds.php?nds_id="+nds_id);
        setTimeout(function(){
            $("#saisie").modal("hide");
            RAZ_saisie();
        }, 1500);
        return false;
    });

    $('#btn-add').on('click',function(){
        $.ajax({
            type: "GET",
            url: APP_URL + "/report/create",
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('#saisie').empty();
                $('#saisie').append(data);
            }
        });
        $("#saisie").modal("show");
    });

    $(document).on('click','#bt_del',function (){
        var nds_id = document.getElementById('num_id').value
        $("#saisie").modal("hide");
        $("#alert").modal("show");
        document.getElementById('id_suppr').value=nds_id;
        document.getElementById("text_suppr").firstChild.data = "Etes-vous sur de vouloir supprimer la note de synthese n°"+nds_id;
        return false;
    });

    $(document).on('click','.close',function(){
        document.getElementById('collab').value = myid;
        RAZ_saisie();
    });

    // $(document).on('click','#bt_alert_suppr',function (){
    //     var nds_id = $('#id_suppr').val();
    //     $.ajax({
    //         type: "POST",
    //             url: APP_URL + "/report/create",
    //             data: "nds_id="+nds_id, // on envoie $_GET['go']
    //             datatype: "html", // on veut un retour JSON
    //             success: function(data) {
    //                     document.getElementById("text_success").html(data);
    //             }
    //     });
    //     $("#alert").modal("hide");
    //     $("#success").modal("show");
    //     document.getElementById("text_success").firstChild.data = "La note de synthese n°"+nds_id+" a bien été supprimée.";
    //     setTimeout(function(){
    //         $("#success").modal("hide");
    //         Affich_NDS();
    //     }, 1500);
    //     return false;
    // });

    //detection si enregistre ou mettre a jour
    // $(document).on('click','#bt_modif',function (){
    //     if (document.getElementById("bt_modif").innerHTML == "Enregistrer"){
    //         var collab_id = $('.collab').val();
    //         var client_id = $('.client').val();
    //         var contrat_id = $('.contrat').val();
    //         var type_heure = $('.type_heure').val();
    //         var jour = $('#jour').val();
    //         var h_debut = $('.h_debut').val();
    //         var h_fin = $('.h_fin').val();
    //         var TPS_ADM = $('.TPS_ADM').val();
    //         var TPS_PROJ = $('.TPS_PROJ').val();
    //         var TPS_MAINT = $('.TPS_MAINT').val();
    //         var TPS_DEV = $('.TPS_DEV').val();
    //         var TPS_PARC = $('.TPS_PARC').val();
    //         var TPS_REUNION = $('.TPS_REUNION').val();
    //         var TPS_PRIX = $('.TPS_PRIX').val();
    //         var TPS_DEP = $('.TPS_DEP').val();
    //         var TPS_INST = $('.TPS_INST').val();
    //         var TPS_CTRL = $('.TPS_CTRL').val();
    //         var TPS_ASSIST = $('.TPS_ASSIST').val();
    //         var TPS_AUTRE = $('.TPS_AUTRE').val();
    //         var TPS_FORM = $('.TPS_FORM').val();
    //         if($('.CTRL_LOG').is(":checked")){
    //             var CTRL_LOG = 'true';
    //         }
    //         else{
    //             var CTRL_LOG = 'false';
    //         }
    //         if($('.CTRL_MAJ_OS').is(":checked")){
    //             var CTRL_MAJ_OS = 'true';
    //         }
    //         else{
    //             var CTRL_MAJ_OS = 'false';
    //         }
    //         if($('.CTRL_HDD').is(":checked")){
    //             var CTRL_HDD = 'true';
    //         }
    //         else{
    //             var CTRL_HDD = 'false';
    //         }
    //         if($('.CTRL_MAJ_HARD').is(":checked")){
    //             var CTRL_MAJ_HARD = 'true';
    //         }
    //         else{
    //             var CTRL_MAJ_HARD = 'false';
    //         }
    //         if($('.CTRL_RAID').is(":checked")){
    //             var CTRL_RAID = 'true';
    //         }
    //         else{
    //             var CTRL_RAID = 'false';
    //         }
    //         if($('.CTRL_MAJ_SOFT').is(":checked")){
    //             var CTRL_MAJ_SOFT = 'true';
    //         }
    //         else{
    //             var CTRL_MAJ_SOFT = 'false';
    //         }
    //         if($('.CTRL_BACKUP').is(":checked")){
    //             var CTRL_BACKUP = 'true';
    //         }
    //         else{
    //             var CTRL_BACKUP = 'false';
    //         }
    //         if($('.CTRL_ANTIVIRUS').is(":checked")){
    //             var CTRL_ANTIVIRUS = 'true';
    //         }
    //         else{
    //             var CTRL_ANTIVIRUS = 'false';
    //         }
    //         if($('.VOLUM_BACKUP').is(":checked")){
    //             var VOLUM_BACKUP = 'true';
    //         }
    //         else{
    //             var VOLUM_BACKUP = 'false';
    //         }
    //         if($('.MAJ_ANTIVIRUS').is(":checked")){
    //             var MAJ_ANTIVIRUS = 'true';
    //         }
    //         else{
    //             var MAJ_ANTIVIRUS = 'false';
    //         }
    //         if($('.MAJ_BACKUP').is(":checked")){
    //             var MAJ_BACKUP = 'true';
    //         }
    //         else{
    //             var MAJ_BACKUP = 'false';
    //         }
    //         var TPS_TOTAL = TPS_ADM+TPS_PROJ+TPS_MAINT+TPS_DEV+TPS_PARC+TPS_REUNION+TPS_PRIX+TPS_DEP+TPS_INST+TPS_CTRL+TPS_ASSIST+TPS_AUTRE+TPS_FORM;
    //         if (TPS_TOTAL <= 0){
    //             document.getElementById("reussi").style.backgroundColor='#e6585f';
    //             $('.reussi').html('Veuillez renseigner votre temps de travail dans au moins une des taches!!!').slideDown(1000);
    //             return;
    //         }
    //         var comment = document.getElementById('comment').value;
    //         $.post('forms/nds/req_saisie.php',{collab_id:collab_id,client_id:client_id,contrat_id:contrat_id,type_heure:type_heure,jour:jour,h_debut:h_debut,h_fin:h_fin,TPS_ADM:TPS_ADM,TPS_PROJ:TPS_PROJ,
    //             TPS_MAINT:TPS_MAINT,TPS_DEV:TPS_DEV,TPS_PARC:TPS_PARC,TPS_REUNION:TPS_REUNION,TPS_PRIX:TPS_PRIX,TPS_DEP:TPS_DEP,TPS_INST:TPS_INST,TPS_CTRL:TPS_CTRL,TPS_ASSIST:TPS_ASSIST,TPS_AUTRE:TPS_AUTRE,
    //             TPS_FORM:TPS_FORM,CTRL_LOG:CTRL_LOG,CTRL_MAJ_OS:CTRL_MAJ_OS,CTRL_HDD:CTRL_HDD,CTRL_MAJ_HARD:CTRL_MAJ_HARD,CTRL_RAID:CTRL_RAID,CTRL_MAJ_SOFT:CTRL_MAJ_SOFT,CTRL_BACKUP:CTRL_BACKUP,CTRL_ANTIVIRUS:CTRL_ANTIVIRUS,
    //             VOLUM_BACKUP:VOLUM_BACKUP,MAJ_ANTIVIRUS:MAJ_ANTIVIRUS,MAJ_BACKUP:MAJ_BACKUP,comment:comment},function(data) {
    //                 $("#saisie").modal("hide");
    //                 $('#text_success').html(data);
    //                 $("#success").modal("show");
    //             });
    //         setTimeout(function(){
    //             RAZ_saisie();
    //             $("#success").modal("hide");
    //             Affich_NDS();
    //         }, 1500);

    //         return false;
       
    // }
    //     else if (document.getElementById("bt_modif").innerHTML == "Mettre à jour") {
    //         var collab_id = $('.collab').val();
    //         var client_id = $('.client').val();
    //         var contrat_id = $('.contrat').val();
    //         var type_heure = $('.type_heure').val();
    //         var jour = $('#jour').val();
    //         var h_debut = $('.h_debut').val();
    //         var h_fin = $('.h_fin').val();
    //         var TPS_ADM = $('.TPS_ADM').val();
    //         var TPS_PROJ = $('.TPS_PROJ').val();
    //         var TPS_MAINT = $('.TPS_MAINT').val();
    //         var TPS_DEV = $('.TPS_DEV').val();
    //         var TPS_PARC = $('.TPS_PARC').val();
    //         var TPS_REUNION = $('.TPS_REUNION').val();
    //         var TPS_PRIX = $('.TPS_PRIX').val();
    //         var TPS_DEP = $('.TPS_DEP').val();
    //         var TPS_INST = $('.TPS_INST').val();
    //         var TPS_CTRL = $('.TPS_CTRL').val();
    //         var TPS_ASSIST = $('.TPS_ASSIST').val();
    //         var TPS_AUTRE = $('.TPS_AUTRE').val();
    //         var TPS_FORM = $('.TPS_FORM').val();
    //         if($('.CTRL_LOG').is(":checked")){
    //             var CTRL_LOG = 'true';
    //         }
    //         else{
    //             var CTRL_LOG = 'false';
    //         }
    //         if($('.CTRL_MAJ_OS').is(":checked")){
    //             var CTRL_MAJ_OS = 'true';
    //         }
    //         else{
    //             var CTRL_MAJ_OS = 'false';
    //         }
    //         if($('.CTRL_HDD').is(":checked")){
    //             var CTRL_HDD = 'true';
    //         }
    //         else{
    //             var CTRL_HDD = 'false';
    //         }
    //         if($('.CTRL_MAJ_HARD').is(":checked")){
    //             var CTRL_MAJ_HARD = 'true';
    //         }
    //         else{
    //             var CTRL_MAJ_HARD = 'false';
    //         }
    //         if($('.CTRL_RAID').is(":checked")){
    //             var CTRL_RAID = 'true';
    //         }
    //         else{
    //             var CTRL_RAID = 'false';
    //         }
    //         if($('.CTRL_MAJ_SOFT').is(":checked")){
    //             var CTRL_MAJ_SOFT = 'true';
    //         }
    //         else{
    //             var CTRL_MAJ_SOFT = 'false';
    //         }
    //         if($('.CTRL_BACKUP').is(":checked")){
    //             var CTRL_BACKUP = 'true';
    //         }
    //         else{
    //             var CTRL_BACKUP = 'false';
    //         }
    //         if($('.CTRL_ANTIVIRUS').is(":checked")){
    //             var CTRL_ANTIVIRUS = 'true';
    //         }
    //         else{
    //             var CTRL_ANTIVIRUS = 'false';
    //         }
    //         if($('.VOLUM_BACKUP').is(":checked")){
    //             var VOLUM_BACKUP = 'true';
    //         }
    //         else{
    //             var VOLUM_BACKUP = 'false';
    //         }
    //         if($('.MAJ_ANTIVIRUS').is(":checked")){
    //             var MAJ_ANTIVIRUS = 'true';
    //         }
    //         else{
    //             var MAJ_ANTIVIRUS = 'false';
    //         }
    //         if($('.MAJ_BACKUP').is(":checked")){
    //             var MAJ_BACKUP = 'true';
    //         }
    //         else{
    //             var MAJ_BACKUP = 'false';
    //         }
    //         var comment = document.getElementById('comment').value;
    //         var nds_id = document.getElementById('num_id').value;
    //         $.post('forms/nds/req_saisie_modif.php',{nds_id:nds_id,collab_id:collab_id,client_id:client_id,contrat_id:contrat_id,type_heure:type_heure,jour:jour,h_debut:h_debut,h_fin:h_fin,TPS_ADM:TPS_ADM,TPS_PROJ:TPS_PROJ,
    //             TPS_MAINT:TPS_MAINT,TPS_DEV:TPS_DEV,TPS_PARC:TPS_PARC,TPS_REUNION:TPS_REUNION,TPS_PRIX:TPS_PRIX,TPS_DEP:TPS_DEP,TPS_INST:TPS_INST,TPS_CTRL:TPS_CTRL,TPS_ASSIST:TPS_ASSIST,TPS_AUTRE:TPS_AUTRE,
    //             TPS_FORM:TPS_FORM,CTRL_LOG:CTRL_LOG,CTRL_MAJ_OS:CTRL_MAJ_OS,CTRL_HDD:CTRL_HDD,CTRL_MAJ_HARD:CTRL_MAJ_HARD,CTRL_RAID:CTRL_RAID,CTRL_MAJ_SOFT:CTRL_MAJ_SOFT,CTRL_BACKUP:CTRL_BACKUP,CTRL_ANTIVIRUS:CTRL_ANTIVIRUS,
    //             VOLUM_BACKUP:VOLUM_BACKUP,MAJ_ANTIVIRUS:MAJ_ANTIVIRUS,MAJ_BACKUP:MAJ_BACKUP,comment:comment},function(data) {
    //                 $('#text_success').html(data);
    //                 $("#saisie").modal("hide");
    //                 $("#success").modal("show");
    //             });
    //         setTimeout(function(){
    //             RAZ_saisie();
    //             $("#success").modal("hide");
    //             Affich_NDS();
    //         }, 1500);
    //         return false;
    //     }
    // });

    

    
    
    $(document).on('click','#bt_annul',function (){
        RAZ_saisie();
    });

    function RAZ_saisie () {
        document.getElementById('client').value = 0;
        document.getElementById('contrat').length =0;
        document.getElementById('type_heure').value = "Normale";
        document.getElementById('jour').value = "";
        document.getElementById('h_debut').value = "";
        document.getElementById('h_fin').value = "";
        document.getElementById('TPS_ADM').value = "";
        document.getElementById('TPS_PROJ').value = "";
        document.getElementById('TPS_MAINT').value = "";
        document.getElementById('TPS_DEV').value = "";
        document.getElementById('TPS_PARC').value = "";
        document.getElementById('TPS_REUNION').value = "";
        document.getElementById('TPS_PRIX').value = "";
        document.getElementById('TPS_DEP').value = "";
        document.getElementById('TPS_INST').value = "";
        document.getElementById('TPS_CTRL').value = "";
        document.getElementById('TPS_ASSIST').value = "";
        document.getElementById('TPS_AUTRE').value = "";
        document.getElementById('TPS_FORM').value = "";
        document.getElementById('CTRL_LOG').checked = false;
        document.getElementById('CTRL_MAJ_OS').checked = false;
        document.getElementById('CTRL_HDD').checked = false;
        document.getElementById('CTRL_MAJ_HARD').checked = false;
        document.getElementById('CTRL_RAID').checked = false;
        document.getElementById('CTRL_MAJ_SOFT').checked = false;
        document.getElementById('CTRL_BACKUP').checked = false;
        document.getElementById('CTRL_ANTIVIRUS').checked = false;
        document.getElementById('VOLUM_BACKUP').checked = false;
        document.getElementById('MAJ_ANTIVIRUS').checked = false;
        document.getElementById('MAJ_BACKUP').checked = false;
        document.getElementById('comment').value = "";
        document.getElementById('collab').disabled = false;
        document.getElementById('client').disabled = false;
        document.getElementById('contrat').disabled = false;
        document.getElementById('type_heure').disabled = false;
        document.getElementById('jour').disabled = false;
        document.getElementById('h_debut').disabled = false;
        document.getElementById('h_fin').disabled = false;
        document.getElementById('TPS_ADM').disabled = false;
        document.getElementById('TPS_PROJ').disabled = false;
        document.getElementById('TPS_MAINT').disabled = false;
        document.getElementById('TPS_DEV').disabled = false;
        document.getElementById('TPS_PARC').disabled = false;
        document.getElementById('TPS_REUNION').disabled = false;
        document.getElementById('TPS_PRIX').disabled = false;
        document.getElementById('TPS_DEP').disabled = false;
        document.getElementById('TPS_INST').disabled = false;
        document.getElementById('TPS_CTRL').disabled = false;
        document.getElementById('TPS_ASSIST').disabled = false;
        document.getElementById('TPS_AUTRE').disabled = false;
        document.getElementById('TPS_FORM').disabled = false;
        document.getElementById('CTRL_LOG').disabled = false;
        document.getElementById('CTRL_MAJ_OS').disabled = false;
        document.getElementById('CTRL_HDD').disabled = false;
        document.getElementById('CTRL_MAJ_HARD').disabled = false;
        document.getElementById('CTRL_RAID').disabled = false;
        document.getElementById('CTRL_MAJ_SOFT').disabled = false;
        document.getElementById('CTRL_BACKUP').disabled = false;
        document.getElementById('CTRL_ANTIVIRUS').disabled = false;
        document.getElementById('VOLUM_BACKUP').disabled = false;
        document.getElementById('MAJ_ANTIVIRUS').disabled = false;
        document.getElementById('MAJ_BACKUP').disabled = false;
        document.getElementById('comment').disabled = false;
        document.getElementById("bt_impr").style.opacity = 1;
        document.getElementById("bt_modif").innerHTML = "Enregistrer";
    };
    
    
})(jQuery);

