


  <div class='row'>
    <div class='col-xs-12'>
      <div class='box'>
        <div class='box-header'>
          <h3 class='box-title pull-left'>Liste des notes de synthèse</h3>
<!--         <h3><abbr title='Télécharger la vue'><i id='download_nds' style='cursor:pointer;color:#3c8dbc' class='glyphicon glyphicon-cloud-download pull-right'></i></abbr></h3>
-->      </div>
        <div class='box-body'>
          <table id='listNDS' class='table table-bordered table-striped table-hover display nowrap' cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class='hide'>Date_tri</th>
                <th class='col-xs-2' style='text-align:center'>Date</th>
                <th style='text-align:center'>Collab.</th>
                <th style='text-align:center'>Client</th>
                <th style='text-align:center'>Contrat</th>
                <th style='text-align:center'>Type d'heure</th>
                <th style='text-align:center'>Arrivée</th>
                <th style='text-align:center'>Départ</th>
                <th style='text-align:center'>Tps</th>
                <th>Commentaire</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($reports as $report)
              <tr id={{ $report->id }} title='Double-clic pour ouvrir'>
                <td class='hide'>{{ $report->jour }}</td>
                <td>{{ date('D d M Y', strtotime($report->jour)) }}</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->nom }}</td>
                <td>{{ $report->description }}</td>
                <td>{{ $report->type_heure }}</td>
                <td>{{ $report->arrivee }}</td>
                <td>{{ $report->depart }}</td>
                <td>{{ $report->tps_total }}</td>
                <td style='text-overflow:ellipsis'>{{ $report->commentaire }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>

<!-- Bootstrap 3.3.2 JS -->
<script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

<!-- DATA TABES SCRIPT -->
<script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.js') }}"></script>


<script type='text/javascript'>
      $(function () {
        $('#listNDS').DataTable({
            language: {
                lengthMenu: "_MENU_ résutats par page",
                zeroRecords: "Aucun résultat - Désolé",
                info: "page _PAGE_ sur _PAGES_",
                infoEmpty: "Aucun enregistrement",
                infoFiltered: "(filtrage sur un total de _MAX_ enregistrement)",
                search: "Recherche"
            },
            responsive: {
                details: {
                    renderer: function ( api, rowIdx ) {
                    // Select hidden columns for the given row
                    var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                        var header = $( api.column( cell.column ).header() );
 
                        return '<tr>'+
                                '<td>'+
                                    header.text()+':'+
                                '</td> '+
                                '<td>'+
                                    api.cell( cell ).data()+
                                '</td>'+
                            '</tr>';
                    } ).toArray().join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                    }
                }
            },
            dom: '<"row"<"col-xs-4"l><"col-xs-4"f><"col-xs-4"<"pull-right"T>>><t>ip',
            /*'dom': 'TBfrtip',*/
            tableTools: {
                sSwfPath: "./plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                aButtons: [
                   /* "copy",
                    "print",*/
                    {
                        sExtends:    "collection",
                        sButtonText: "Enregistrer",
                        aButtons:    [ "csv", "xls", "pdf" ]
                    }
                ]
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tout"]],
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            order: [[ 0, "desc" ]],
            info: true   
        });
      });
</script>
