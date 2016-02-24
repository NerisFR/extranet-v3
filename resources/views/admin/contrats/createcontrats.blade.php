<div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Nouveau contrat</h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('contrat.store')]) !!}
                    <div class="col-xs-12">
                        <span class='list'>Description : </span>
                        <span class='list'>
                            {!! Form::text('description','',['class' => 'form-control form-group']) !!}
                        </span>
                        <span style='opacity:0' class="entete"><input id="num_id_cont"></input></span>
                    </div>
                    
                    <div class="col-xs-6">
                        <span class='list'>Numéro : </span>
                        <span class='list'>
                            {!! Form::text('numero','',['class' => 'form-control form-group']) !!}
                        </span>
                    </div>
                    <div class="col-xs-6">
                        <span class='list'>Volume horaire: </span>
                        <span class='list'>
                            {!! Form::text('volume','',['class' => 'form-control form-group']) !!}
                        </span>
                    </div>

                    <div class="col-xs-6">
                        <span class='list'>Date de sign. : </span>
                        <span class='list'>
                            {!! Form::text('signature','',['class' => 'datepicker form-control pull-right']) !!}
                        </span>
                    </div>
                    <div class="col-xs-6">
                        <span class='list'>Date de dém. : </span>
                        <span class='list'>
                            {!! Form::text('demarrage','',['class' => 'datepicker form-control pull-right']) !!}
                        </span>
                    </div>
                    
                    <div class="col-xs-6">
                        <span class='list'>Date de fin de mission : </span>
                        <span class='list'>
                            {!! Form::text('date_fin_mission','',['class' => 'datepicker form-control pull-right']) !!}
                        </span>
                    </div>
                    <div class="col-xs-6">
                            <span class='list'>Durée du préavis : </span>
                            <span class='list'>
                                {!! Form::text('preavis','',['class' => 'form-control form-group']) !!}
                            </span>
                    </div>

                    <div class="col-xs-12 checkbox">
                        <label>
                            <input type='checkbox' id="marche" value="true" class="minimal"/> Marché public
                        </label>
                        <label>
                            <input type='checkbox' id="tacite" value="true" class="minimal"/> Reconduction tacite
                        </label>                      
                    </div>
                    
                    <div class="col-xs-6">
                        <span class='list'>Client : </span>
                        <span class='list'>
                            <select class="form-control" name="cli" id="cli">
                                <option value="0" selected="selected">Sélectionnez une valeur</option>
                                    @foreach ($clients as $client)
                                        <option value={{ $client->id }}>{{ $client->nom }}</option>
                                    @endforeach
                            </select>
                        </span>
                    </div>
                    <div class="col-xs-6">
                        <span>&nbsp;</span>
                        <span >
                            <input style='opacity:0' class="form-control" name="test"></input>
                        </span>
                    </div>
                    
                    <div class="col-xs-6">
                        <span class='list'>Base de calcul (nb semaine) : </span>
                        <span class='list'>
                            <select class="form-control" name="base_sem" id="base_sem">
                                @for ($i = 0; $i < 53; $i++)
                                    @if ($i == 45)
                                        <option value={{ $i }} selected>{{ $i }}</option>
                                    @else
                                        <option value={{ $i }} >{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </span>
                    </div>
                    <div class="col-xs-6">
                        <span>Durée en mois : </span>
                        <span>
                            <select style="width:150px" class="form-control" name="nb_mois" id="nb_mois">
                                @for ($i = 0; $i < 13; $i++)
                                    @if ($i == 12)
                                        <option value={{ $i }} selected>{{ $i }}</option>
                                    @else
                                        <option value={{ $i }} >{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </span>
                    </div>
                    
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" id="bt_annul_cont" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary pull-right" id="bt_modif_cont">Enregistrer</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.example-modal -->        
    <!-- datepicker -->

<!-- jQuery 2.1.4 -->
<script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<!-- datepicker -->
<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            autoclose: true
        });
    });
      
    
</script>