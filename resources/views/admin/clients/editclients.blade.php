<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Nouveau client</h3>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'put','url' => route('client.update', $client)]) !!}
            <div class="row">
                <div class="col-xs-6">
                    <span>Nom : </span>
                    <span>
                        {!! Form::text('nom',$client->nom,['class' => 'form-control form-group']) !!}
                        
                    </span>
                </div>
                <div class="col-xs-6">
                    <span>Adresse : </span>
                    <span>
                        {!! Form::text('adresse',$client->adresse,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <span>Code Postal : </span>
                    <span>
                        {!! Form::text('cp',$client->cp,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
                <div class="col-xs-6">
                    <span>Ville : </span>
                    <span>
                        {!! Form::text('ville',$client->ville,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
            </div>
            <div class="row">                
                <div class="col-xs-6">
                    <span>Département : </span>
                    <span>
                        <select name="dep" id="dep" class="form-control dep">
                            <option value="0">Sélectionnez une valeur</option>
                            @foreach ($departements as $dep)
                                @if ($client->id_dep == $dep->id)
                                    <option value={{ $dep->id }} selected="selected">{{ $dep->num }} - {{ $dep->nom }}</option>
                                @else
                                    <option value={{ $dep->id }}>{{ $dep->num }} - {{ $dep->nom }}</option>
                                @endif
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-xs-6">
                    <span>&nbsp;</span>
                    <span style='opacity:0'><input style='opacity:0' class="form-control" id="num_id_cli"></input></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <span>SIRET : </span>
                    <span>
                        {!! Form::text('siret',$client->siret,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
                <div class="col-xs-6">
                    <span>&nbsp;</span>
                    <span style='opacity:0'>
                        <input style='opacity:0' class="form-control" name="text"></input>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <span>Téléphone : </span>
                    <span>
                        {!! Form::text('tel',$client->tel,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
                <div class="col-xs-6">
                    <span>Fax : </span>
                    <span>
                        {!! Form::text('fax',$client->fax,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <span>Email : </span>
                    <span>
                        {!! Form::text('mail',$client->mail,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
                <div class="col-xs-6">
                    <span>Site Web : </span>
                    <span>
                        {!! Form::text('web',$client->web,['class' => 'form-control form-group']) !!}
                    </span>
                </div>
                <div class="col-xs-12">
                    <span>&nbsp;</span>
                </div>
            </div>
            <div class="row">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" id="bt_annul_cli" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="bt_modif_cli">Enregistrer</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.example-modal -->        