@extends('accueil')

@section('content')

<!-- DATA TABLES -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" >

<link href="{{ asset('plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" >

<link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" >

<link href="{{ asset('plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" >


<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="col-xs-6 box-title">Mes notes de syntheses</h3>
      <div id="ajout-nds">
        <h3 class="col-xs-6 box-title add" id="btn-add" style="text-align: right;cursor:Pointer"><i class='glyphicon-plus'></i>Ajouter</h3>
      </div>
    </div><!-- /.box-header -->
</div>


<div class="box box-primary">
    <form role="form" action="#" class="consultNDS" id="consultNDS">
        <div class="box-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">Collaborateur :</div>
                    <div class="col-xs-3">
                        <select name="collab_consult" id="collab_consult" class="collab_consult">
                          <option value="0">Sélectionnez une valeur</option>
                          @foreach ($collabs as $collab)
                              @if ($collab->id == Auth::user()->id)
                                <option value={{ $collab->id }} selected="selected">{{ $collab->name }}</option>
                              @else
                                <option value={{ $collab->id }}>{{ $collab->name }}</option>
                              @endif
                          @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3">Contrat :</div>
                    <div class="col-xs-3">
                        <select name="contrat_consult" id="contrat_consult" class="contrat_consult" > 
                          
                        </select>
                    </div>
                </div>    
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-3">Client :</div>
                    <div class="col-xs-3">
                        <select name="client_consult" id="client_consult" class="client_consult">
                          <option value="0">Sélectionnez une valeur</option>
                            @foreach ($clients as $client)
                                  <option value={{ $client->id }}>{{ $client->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-3">Type d'heures :</div>
                    <div class="col-xs-3">
                        <select name="type_heure_consult" id="type_heure_consult" class="type_heure_consult">
                            <option selected>Toutes</option>
                            <option>Extra Time</option>
                            <option>Normale</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6" style="text-align: right; vertical-align:middle">
                        <div class="col-xs-offset-5 col-xs-4">Comprise entre le </div>
                        <div class="col-xs-3 input-group">
                            <input name="date_debut" class="form-control datepicker date_debut" id="date_debut" value="<?php echo date("d/m/Y", strtotime('-3 month')); ?>"></input>
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6" style="text-align: left">
                        <div class="col-xs-2"> et le </div>
                        <div class="col-xs-3 input-group">
                            <input name="date_fin" class="form-control datepicker date_fin" id="date_fin" value="<?php echo date("d/m/Y"); ?>"></input>
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div  class="col-xs-offset-5 col-xs-2 text-center">
                <a type="button" class="btn btn-block btn-primary" id="bt_affich_consult">Afficher</a>
            </div>
            
                
        </div>
    </form>
</div>

<div class="afficher container-fluid">
  @include('reports.listreports')
</div>

<div class="modal fade" id="saisie" tabindex="-1" role="dialog">
  
</div><!-- /.example-modal -->

<div class="modal fade" id="alert" tabindex="-1" role="dialog">
    <div class="modal-danger">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            
            <h4 class="modal-title">Attention</h4>
          </div>
          <div class="modal-body">
            <p id="text_suppr">One fine body&hellip;</p>
            <span style='opacity:0'><input id="id_suppr"></input></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="bt_alert_annul">Annuler</button>
            <button type="button" class="btn btn-outline" id="bt_alert_suppr">Suppr.</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div><!-- /.example-modal -->

<div class="modal fade" id="success" tabindex="-1" role="dialog">
    <div class="modal-success">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            
            <h4 class="modal-title">Opération réussie</h4>
          </div>
          <div class="modal-body">
            <p id="text_success">One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-right" data-dismiss="modal" id="bt_alert_annul">Ok</button>
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
    <script type="text/javascript" src="{{ asset('js/reports.js') }}"></script>
    <!-- datepicker -->
    <script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  
  


<script type="text/javascript">

      
    
</script>

@endsection