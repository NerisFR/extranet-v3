


    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Nouvelle note de synthese</h3>
        </div>
        <div class="modal-body">
          {!! Form::open(['url' => route('report.store')]) !!}
            
              <!-- <div class="reussi" id="reussi" style='width:700px'></div> -->
              <div class="col-xs-12">
                <h4 class="modal-title">Renseignement administratif</h4>
                <span style='opacity:0'><input id="num_id"></input></span>
              </div>

              <div class="col-xs-6">
                <span>Collab. : </span>
                <span>
                  <select required name="collab" id="collab" class="form-control collab">
                    <option value="0">Sélectionnez une valeur</option>
                      @foreach ($collabs as $collab)
                        @if ($collab->id == Auth::user()->id)
                          <option value={{ $collab->id }} selected="selected">{{ $collab->name }}</option>
                        @else
                          <option value={{ $collab->id }}>{{ $collab->name }}</option>
                        @endif
                      @endforeach
                  </select>
                </span>
              </div>
              <div class="col-xs-6">
                  <span>Date : </span>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('jour','',['class' => 'datepicker form-control pull-right']) !!}
                  </div>
              </div>
                 

              <div class="col-xs-6">
                <span>Client :</span>
                <span>
                  <select name="client" id="client" class="form-control client" required>
                    <option value="0" selected="selected">Sélectionnez une valeur</option>
                      @foreach ($clients as $client)
                          <option value={{ $client->id }}>{{ $client->nom }}</option>
                      @endforeach
                  </select>
                </span>
              </div>
              <div class="col-xs-6">
                <span>Heure d'arrivée :</span>
                <span>
                  <select name="h_debut" id="h_debut" class="form-control h_debut">
                    @foreach ($heures as $heure)
                        @if ($heure->heures == '09:00')
                          <option value={{ $heure->heures }} selected="selected">{{ $heure->heures }}</option>
                        @else
                          <option value={{ $heure->heures }}>{{ $heure->heures }}</option>
                        @endif
                      @endforeach
                  </select>
                </span>
              </div>

              <div class="col-xs-6">
                <span>Contrat :</span>
                <span>
                  <select name="contrat" id="contrat" class="form-control contrat" required>
                    <option value="0">Sélectionnez une valeur</option>
                  </select>
                  </select>
                </span>
              </div>
              <div class="col-xs-6">
                <span>Heure de départ :</span>
                <span>
                  <select name="h_fin" id="h_fin" class="form-control h_fin">
                    @foreach ($heures as $heure)
                      @if ($heure->heures == '17:00')
                        <option value={{ $heure->heures }} selected="selected">{{ $heure->heures }}</option>
                      @else
                        <option value={{ $heure->heures }}>{{ $heure->heures }}</option>
                      @endif
                    @endforeach
                  </select>
                </span>
              </div>

              <div class="col-xs-6">
                <span>Type d'heure :</span>
                <span><select required name="type_heure" id="type_heure" class="form-control type_heure">
                  
                    <option>Extra Time</option>
                    <option selected>Normale</option>
                  
                  </select></span>
              </div>
              <div class="col-xs-6">
                <span>&nbsp;</span>
                <span>&nbsp;</span>
              </div>

              <div class="col-xs-12">
                <h4 align="center" class="col-xs-6">Actions réalisées</h4>
                <h4 align="center" class="col-xs-6">Maintenance technique</h4>
              </div>

              <div  class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Admin. syst. : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_adm', null, ['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Suivi de proj. : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_proj', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div align="center" class="col-xs-6 col-md-6 col-lg-6">
                  <span>Serveur</span>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Maintenance : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_maint', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Etude &amp; dev. :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_dev', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6 col-md-6">
                      {!! Form::checkbox('ctrl_log') !!}
                      {!! Form::label('CTRL_LOG', 'Contrôle Log') !!}
                    </div>
                    <div class="col-xs-6 col-md-6">
                      {!! Form::checkbox('ctrl_maj_os') !!}
                      {!! Form::label('CTRL_MAJ_OS', 'MAJ OS') !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Suivi de parc :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_parc', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Réunion :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_reunion', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::checkbox('ctrl_hdd') !!}
                      {!! Form::label('CTRL_HDD', 'Disques') !!}
                    </div>
                    <div class="col-xs-6">
                      {!! Form::checkbox('ctrl_maj_hard') !!}
                      {!! Form::label('CTRL_MAJ_HARD', 'MAJ Hard') !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Etude de prix : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_prix', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Déplacement : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_dep', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::checkbox('ctrl_raid') !!}
                      {!! Form::label('CTRL_RAID', 'RAID') !!}
                    </div>
                    <div class="col-xs-6">
                      {!! Form::checkbox('ctrl_maj_soft') !!}
                      {!! Form::label('CTRL_MAJ_SOFT', 'MAJ Logiciel') !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Inst./param. : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_inst', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Ctrl journ. : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_ctrl', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div align="center" class="col-xs-6">
                      <span align="center">Sauvegarde</span>
                    </div>
                    <div align="center" class="col-xs-6">
                      <span >Antivirus</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Assist. util. :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_assist', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Autre : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_autre', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::checkbox('ctrl_backup') !!}
                      {!! Form::label('CTRL_BACKUP', 'Vérification') !!}
                    </div>
                    <div class="col-xs-6">
                      {!! Form::checkbox('ctrl_antivirus') !!}
                      {!! Form::label('CTRL_ANTIVIRUS', 'Vérification') !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-4 col-md-4">
                      <span>Formation :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_form', null,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::checkbox('volum_backup') !!}
                      {!! Form::label('VOLUM_BACKUP', 'Volumétrie') !!}
                    </div>
                    <div class="col-xs-6">
                      {!! Form::checkbox('maj_antivirus') !!}
                      {!! Form::label('MAJ_ANTIVIRUS', 'Mise à jour') !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-offset-6">
                </div>
                <div class="col-xs-3 col-xs-offset-6">
                  {!! Form::checkbox('maj_backup') !!}
                  {!! Form::label('MAJ_BACKUP', 'Mise à jour') !!}
                </div>
              </div>

              <div class="row">
                <div class="col-xs-3">
                  <span>Commentaires</span>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <span align="center">
                    {!! Form::textarea('commentaire', null,['class' => 'form-control', 'rows' => 3]) !!}
                    
                    
                </div>
              </div>
                <!-- <div align="center" style='line-height:20px;vertical-align:center'>
                    <input type="submit" width="50" height="20" id="bt_modif" class="bt_modif" style="border:3px solid;border-radius : 24px;" value="Mettre à jour"></input>
                </div> -->
            
            <!-- </div> -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" id="bt_annul" data-dismiss="modal">Annuler</button>
            <!-- <button type="submit" class="btn btn-primary" id="bt_impr">Imprimer</button> -->
            <button type="submit" class="btn btn-primary" id="bt_modif">Enregistrer</button>
          </div>
          {!! Form::close() !!}
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

<script type="text/javascript">
  $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            endDate: "today",
            language: 'fr',
            autoclose: true
        });
      
    
</script>