$(function() {


 	$(document).on('change','.departement',function (){
            id_dep = $('.departement').val();
            document.getElementById('region').selectedIndex=0;
            //document.location.href = APP_URL + '/client/getByDep/' + id_dep;

        $.ajax({
            type: "GET",
            url: APP_URL + "/client/getViewByDep/" + id_dep,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });
    });

    $(document).on('change','.region',function (){
        id_region = $('.region').val();
        // document.getElementById('departement').selectedIndex=0;
        //document.location.href = APP_URL + '/client/getByRegion/' + id_region;
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
            url: APP_URL + "/client/getViewByRegion/" + id_region,
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').empty();
                $('.afficher').append(data);
            }
        });  
    });

    $(document).on('dblclick','#listCLI tr',function (){
        var client_id = this.id;
        $.ajax({
            type: "GET",
            url: APP_URL + "/client/" + client_id + "/edit",
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('#saisieCLI').empty();
                $('#saisieCLI').append(data);
            }
        });
        $("#saisieCLI").modal("show");
    });

 	// $(document).on('click','.del-cli',function(){
  //           $("#alert_cli").modal("show");
  //           var client_id = this.id;
  //           $.ajax({
  //               type: "POST",
  //               url: "forms/admin/client/req_gest_client_id.php",
  //               data: "client_id="+ client_id, // on envoie $_GET['go']
  //               datatype: "json", // on veut un retour JSON
  //               success: function(data) {
  //                   var list_client = JSON.parse(data);
  //                   var nom_cli = list_client["nom"];
  //                   document.getElementById('text_suppr_cli').innerHTML = "Etes-vous sur de vouloir supprimer le client : "+nom_cli+"? <span><input style='opacity:0' id='id_cli_suppr' value='"+client_id+"'></input></span>";
  //               }
  //           });
  //           Affich_clients();
  //       });

 	// $(document).on('click','.edit-cli',function(){
  //           $("#client").modal("show");
  //           var client_id = this.id;
  //           $.ajax({
  //               type: "POST",
  //               url: "forms/admin/client/req_gest_client_id.php",
  //               data: "client_id="+ client_id, // on envoie $_GET['go']
  //               datatype: "json", // on veut un retour JSON
  //               success: function(data) {
  //                   var list_client = JSON.parse(data);
  //                   document.getElementById('nom_client').value = list_client["nom"];
  //                   document.getElementById('cp').value = list_client["cp"];
  //                   document.getElementById('adresse').value = list_client["adresse"];
  //                   document.getElementById('ville').value = list_client["ville"];
  //                   document.getElementById('dep').value = list_client["id_dep"];
  //                   // document.getElementById('region').value = list_client["region"];
  //                   document.getElementById('tel').value = list_client["tel"];
  //                   document.getElementById('web').value = list_client["web"];
  //                   document.getElementById('mail').value = list_client["mail"];
  //                   document.getElementById('fax').value = list_client["fax"];
  //                   document.getElementById('num_id_cli').value = list_client["id"];
  //                   document.getElementById('bt_modif_cli').innerHTML = "Mettre à jour";
  //               }
  //           });
  //       });

	// $(document).on('click','.view-cli',function(){
 //        $("#client").modal("show");
 //        });

// 	$(document).on('click','#bt_modif_cli',function(){
//             if (document.getElementById("bt_modif_cli").innerHTML == "Mettre à jour"){
// //                Test OK
//                 var nom_client = $('#nom_client').val();
//                 var cp_client = $('#cp').val();
//                 var adresse_client = $('#adresse').val();
//                 var ville_client = $('#ville').val();
//                 var SIRET_client = $('#siret').val();
//                 var dep_client = $('#dep').val();
//                 var tel_client = $('#tel').val();
//                 var web_client = $('#web').val();
//                 var mail_client = $('#mail').val();
//                 var fax_client = $('#fax').val();
//                 var id_client = document.getElementById('num_id_cli').value;
//                 $.post('forms/admin/client/modif_cli.php',{id_client:id_client,nom_client:nom_client,cp_client:cp_client,adresse_client:adresse_client,ville_client:ville_client,dep_client:dep_client,tel_client:tel_client,
//                 web_client:web_client,mail_client:mail_client,fax_client:fax_client,SIRET_client:SIRET_client},function(data) {
//                     $("#client").modal("hide");
//                     $('#text_success_cli').html(data);
//                     $("#success_cli").modal("show");
//                 });
//                 setTimeout(function(){	
//                     RAZ_client();
//                     $("#success_cli").modal("hide");
//                     Affich_clients();
//                 }, 2000);
                
//                 return false;
//             }
//             else if (document.getElementById("bt_modif_cli").innerHTML == "Imprimer"){
//                 RAZ_client();
//             }
//             else if (document.getElementById("bt_modif_cli").innerHTML == "Enregistrer"){
// //                alert("test");
// //                Test OK
//                 var nom_client = $('#nom_client').val();
//                 var cp_client = $('#cp').val();
//                 var adresse_client = $('#adresse').val();
//                 var ville_client = $('#ville').val();
//                 var SIRET_client = $('#siret').val();
//                 var dep_client = $('#dep').val();
//                 var tel_client = $('#tel').val();
//                 var web_client = $('#web').val();
//                 var mail_client = $('#mail').val();
//                 var fax_client = $('#fax').val();
                
//                 $.post('forms/admin/client/req_client_add.php',{nom_client:nom_client,cp_client:cp_client,adresse_client:adresse_client,ville_client:ville_client,dep_client:dep_client,tel_client:tel_client,
//                 web_client:web_client,mail_client:mail_client,fax_client:fax_client,SIRET_client:SIRET_client},function(data) {
//                     $("#client").modal("hide");
//                     $('#text_success_cli').html(data);
//                     $("#success_cli").modal("show");
//                 });
//                 setTimeout(function(){	
//                    RAZ_client();
//                    $("#success_cli").modal("hide");
//                    Affich_clients();
//                 }, 2000);
//                 return false;
//             }
//         });

	$('#btn-add').on('click',function(){
    $.ajax({
      type: "GET",
      url: APP_URL + "/client/create",
      datatype: "html", // on veut un retour JSON
      success: function(data) {
          $('#saisieCLI').empty();
          $('#saisieCLI').append(data);
      }
  });
  $("#saisieCLI").modal("show");
});

 	$(document).on('click','.close-cli',function(){
            RAZ_client();
 	});

 	$(document).on('click','#bt_annul_cli',function(){
            RAZ_client();
 	});
        
    $(document).on('click','#bt_alert_suppr_cli',function(){
        var client_id = document.getElementById('id_cli_suppr').value;
        $.ajax({
    	type: "POST",
            url: "forms/admin/client/req_client_del.php",
            data: "client_id="+ client_id, // on envoie $_GET['go']
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $("#alert_cli").modal("hide");
                $('#text_success_cli').html(data);
                $("#success_cli").modal("show");
            }
        });
        setTimeout(function(){	
            $("#success_cli").modal("hide");
            Affich_clients();
        }, 2000);
        return false;
 	});

        function RAZ_client(){
            document.getElementById('nom_client').value = "";
            document.getElementById('cp').value = "";
            document.getElementById('adresse').value = "";
            document.getElementById('ville').value = "";
            document.getElementById('dep').value = "";
            // document.getElementById('region').value = "";
            document.getElementById('tel').value = "";
            document.getElementById('web').value = "";
            document.getElementById('mail').value = "";
            document.getElementById('fax').value = "";
            document.getElementById('siret').value = "";
            document.getElementById('nom_client').disabled = false;
            document.getElementById('cp').disabled = false;
            document.getElementById('adresse').disabled = false;
            document.getElementById('ville').disabled = false;
            document.getElementById('dep').disabled = false;
            // document.getElementById('region').disabled = false;
            document.getElementById('tel').disabled = false;
            document.getElementById('web').disabled = false;
            document.getElementById('mail').disabled = false;
            document.getElementById('fax').disabled = false;
            document.getElementById('siret').disabled = false;
            document.getElementById('bt_modif_cli').innerHTML = "Enregistrer";
        }
        
    function Affich_clients(){
        var id_dep = $('.departement').val();
        alert(id_dep);
        var id_region = $('.region').val();
        // $.post('client',{id_dep:id_dep,id_region:id_region},function(data) {
            // $('.afficher').html(data);
            // secure_client();
        // });        
        $.ajax({
           url : 'client/index2', // La ressource ciblée
           // type : 'GET' // Le type de la requête HTTP.
           // data : 'id_dep=' + id_dep;
        });
    }
});