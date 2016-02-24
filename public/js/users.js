(function() {

    Number.prototype.padLeft = function(base,chr){
        var  len = (String(base || 10).length - String(this).length)+1;
        return len > 0? new Array(len).join(chr || '0')+this : this;
    }

 	// $(document).on('change','.departement',function (){
  //       id_dep = $('.departement').val();
  //       document.getElementById('region').selectedIndex=0;

  //       $.ajax({
  //           type: "GET",
  //           url: APP_URL + "/user/getViewByDep/" + id_dep,
  //           datatype: "html", // on veut un retour JSON
  //           success: function(data) {
  //               $('.afficher').empty();
  //               $('.afficher').append(data);
  //           }
  //       });
  //   });

  //   $(document).on('change','.region',function (){
  //       id_region = $('.region').val();
  //       $.ajax({
  //           type: "GET",
  //           url: APP_URL + "/departement/getByRegion/" + id_region,
  //           datatype: "json", // on veut un retour JSON
  //           success: function(data) {
  //               $('.departement').empty();
  //               $('.departement').append('<option value="0">Sélectionnez une valeur</option>');
  //               var list_dep = $.parseJSON(data);
  //               nb = 0;
  //               $.each(list_dep, function() {
  //                   $('.departement').append('<option value="'+ list_dep[nb].id +'">'+ list_dep[nb].nom +'</option>');
  //                   nb++;
  //               });
  //           }
  //       });
  //       $.ajax({
  //           type: "GET",
  //           url: APP_URL + "/user/getViewByRegion/" + id_region,
  //           datatype: "html", // on veut un retour JSON
  //           success: function(data) {
  //               $('.afficher').empty();
  //               $('.afficher').append(data);
  //           }
  //       });  
  //   });

	$(document).on('click','.del-collab',function(){
            $("#alert_collab").modal("show");
            var collab_id = this.id;
            $.ajax({
                type: "POST",
                url: "forms/admin/collab/req_gest_collab_id.php",
                data: "collab_id="+ collab_id, // on envoie $_GET['go']
                datatype: "json", // on veut un retour JSON
                success: function(data) {
                    var list_collab = JSON.parse(data);
                    var nom_collab = list_collab["nom_usage"];
                    document.getElementById('text_suppr_cli').innerHTML = "Etes-vous sur de vouloir supprimer <b>"+nom_collab+"</b> de la liste des collaborateurs ? <span><input style='opacity:0' id='id_collab_suppr' value='"+collab_id+"'></input></span>";
                }
            });
        });

    $(document).on('dblclick','#listUSERS tr',function (){
        var user_id = this.id;
        $.ajax({
            type: "GET",
            url: APP_URL + "/user/" + user_id + "/edit",
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('#saisieUSER').empty();
                $('#saisieUSER').append(data);
            }
        });
        $("#saisieUSER").modal("show");
    });

	$(document).on('click','.add',function(){
    $.ajax({
      type: "GET",
      url: APP_URL + "/user/create",
      datatype: "html", // on veut un retour JSON
      success: function(data) {
          $('#saisieUSER').empty();
          $('#saisieUSER').append(data);
      }
    });
    $("#saisieUSER").modal("show");
  });
        
        
        
        $(document).on('click','#bt_alert_suppr_collab',function(){
            var collab_id = document.getElementById('id_collab_suppr').value;
            $.ajax({
        	type: "POST",
                url: "forms/admin/collab/req_collab_del.php",
                data: "collab_id="+collab_id, // on envoie $_GET['go']
                datatype: "html", // on veut un retour JSON
                success: function(data) {
                    $("#alert_collab").modal("hide");
                    $('#text_success_collab').html(data);
                    $("#success_collab").modal("show");
                }
            });
            setTimeout(function(){	
                $("#success_collab").modal("hide");
            }, 2000);
            affich_collab();
            return false;
 	});

})(jQuery);