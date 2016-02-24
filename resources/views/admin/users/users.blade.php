@extends('accueil')

@section('content')
<!-- DATA TABLES -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" >

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="col-xs-6 box-title">Gestions des collaborateurs</h3>
      <h3 class="col-xs-6 box-title add" id="btn-add-collab" style="text-align: right;cursor:Pointer"><i class='glyphicon-plus'></i>Ajouter</h3>
    </div><!-- /.box-header -->
</div>

<div class="box box-primary">
    <form role="form" action="#" class="clients" id="clients">
        <div class="box-body">
            <div class="form-group">
                <div class="row">
                    <table align="center">
                        <tr>
                            <td width="90">Département</td>
                            <td ><select name="departement" id="departement" class="form-control departement">
                                <option value="0">Sélectionnez une valeur</option>
                            	@foreach ($departements as $dep)
                            		<option value={{ $dep->id }}>{{ $dep->num }} - {{ $dep->nom }}</option>
    							@endforeach
                                </select>
                            </td>
                            <td width="50"></td>
                            <td width="60">Région</td>
                            <td><select name="region" id="region" class="form-control region">
                                <option value="0">Sélectionnez une valeur</option>
                            	@foreach ($regions as $region)
                            		<option value={{ $region->id }}>{{ $region->region }}</option>
    							@endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="afficher container-fluid">
    @include('admin.users.listusers')
</div>


<div class="modal fade" id="saisieUSER" tabindex="-1" role="dialog">
    
</div>    

<div class="modal fade" id="alert_collab" tabindex="-1" role="dialog">
    <div class="modal-danger">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            
            <h4 class="modal-title">Attention</h4>
          </div>
          <div class="modal-body">
            <p id="text_suppr_cli">One fine body&hellip;</p>
            <span style='opacity:0'><input id="id_suppr"></input></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="bt_alert_annul_collab">Annuler</button>
            <button type="button" class="btn btn-outline" id="bt_alert_suppr_collab">Suppr.</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div><!-- /.example-modal -->

<div class="modal fade" id="success_collab" tabindex="-1" role="dialog">
    <div class="modal-success">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            
            <h4 class="modal-title">Opération réussie</h4>
          </div>
          <div class="modal-body">
            <p id="text_success_collab">One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-right" data-dismiss="modal" id="bt_success_collab">Ok</button>
            <!--<button type="button" class="btn btn-outline" id="bt_alert_suppr">Suppr.</button>-->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div><!-- /.example-modal -->

<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript" src="{{ asset('js/users.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            autoclose: true
        });
      });
      
    
</script>

@endsection
