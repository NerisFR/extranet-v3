@extends('accueil')

@section('content')

<link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" >

<div class="box box-primary" id="zone-hour">
  <div class="box-header with-border">
      <h3 class="box-title">Paramètres</h3><i class="pull-right fa fa-fw fa-chevron-down" style="cursor:Pointer;text-align: right;" id="icon-hour"></i>
  </div>

  <div class="box-body" id="table-hour">
    <form role="form" action="#" class="consultNDS" id="consultNDS">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-3">Collaborateur :</div>
          <div class="col-xs-3">
            <select name="collab_consult" id="collab_tdbh" class="collab_tdbh">
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
              <select name="contrat" id="contrat_tdbh" class="contrat_tdbh" > 
                <option value="0"> </option>
              </select>
          </div>
        </div>    
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-3">Client :</div>
          <div class="col-xs-3">
            <select name="client" id="client_tdbh" class="client_tdbh">
              <option value="0">Sélectionnez une valeur</option>
                @foreach ($clients as $client)
                  <option value={{ $client->id }}>{{ $client->nom }}</option>
                @endforeach
            </select>
          </div>
          <div class="col-xs-3">Année :</div>
          <div class="col-xs-3">
            <select name="annee" id="annee_tdbh" class="annee_tdbh"> 
              <option> </option>
            </select>
          </div>
        </div>
      </div>
      <div  class="col-xs-offset-5 col-xs-2 text-center">
        <a type="button" class="btn btn-block btn-primary" id="bt_affich">Afficher</a>
      </div>
    </form>
  </div>
</div>

<br></br>

<div class="afficher"></div>

<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('js/tdbbyhours.js') }}"></script>

@endsection