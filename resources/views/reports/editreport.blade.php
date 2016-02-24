


    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Nouvelle note de synthese</h3>
        </div>
        <div class="modal-body">
          {!! Form::open(['method' => 'put','url' => route('report.update', $report)]) !!}
            
              <!-- <div class="reussi" id="reussi" style='width:700px'></div> -->
              <div class="col-xs-12">
                <h4 class="modal-title">Renseignement administratif</h4>
                <span style='opacity:0'><input id="num_id" value={{ $report->id }}></input></span>
              </div>

              <div class="col-xs-6">
                <span>Collab. : </span>
                <span>
                  <select required name="collab" id="collab" class="form-control collab">
                    <option value="0">Sélectionnez une valeur</option>
                      @foreach ($collabs as $collab)
                        @if ($collab->id == $collab_current)
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
                    {!! Form::text('jour',date('d/m/Y', strtotime($report->jour)),['class' => 'datepicker form-control pull-right']) !!}
                    <!-- <input type="text" class="form-control datepicker pull-right" id="jour" name="jour" value="" /> -->
                  </div>
              </div>
                 

              <div class="col-xs-6">
                <span>Client :</span>
                <span>
                  <select name="client" id="client" class="form-control client" required>
                    <option value="0">Sélectionnez une valeur</option>
                      @foreach ($clients as $client)
                        @if ($client->id == $cli_current)
                          <option value={{ $client->id }} selected="selected">{{ $client->nom }}</option>
                        @else
                          <option value={{ $client->id }}>{{ $client->nom }}</option>
                        @endif
                      @endforeach
                  </select>
                </span>
              </div>
              <div class="col-xs-6">
                <span>Heure d'arrivée :</span>
                <span>
                  <select name="h_debut" id="h_debut" class="form-control h_debut">
                    @foreach ($heures as $heure)
                        @if ($heure->heures == $report->arrivee)
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
                      @foreach ($contrats as $contrat)
                        @if ($contrat->id == $contrat_current)
                          <option value={{ $contrat->id }} selected="selected">{{ $contrat->description }}</option>
                        @else
                          <option value={{ $contrat->id }}>{{ $contrat->description }}</option>
                        @endif
                      @endforeach
                  </select>
                  </select>
                </span>
              </div>
              <div class="col-xs-6">
                <span>Heure de départ :</span>
                <span>
                  <select name="h_fin" id="h_fin" class="form-control h_fin">
                    @foreach ($heures as $heure)
                      @if ($heure->heures == $report->depart)
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
                  @if ($report->type_heure == 'Normale')
                    <option>Extra Time</option>
                    <option selected>Normale</option>
                  @else
                    <option selected>Extra Time</option>
                    <option>Normale</option>
                  @endif
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
                      <span>{!! Form::text('tps_adm',$report->tps_adm,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Suivi de proj. : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_proj',$report->tps_proj,['class' => 'form-control form-group']) !!}</span>
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
                      <span>{!! Form::text('tps_maint',$report->tps_maint,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Etude &amp; dev. :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_dev',$report->tps_dev,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6 col-md-6">
                      {!! Form::checkbox('checkbox') !!}
                      {!! Form::label('CTRL_LOG', 'Contrôle Log') !!}
                    </div>
                    <div class="col-xs-6 col-md-6">
                      {!! Form::checkbox('checkbox') !!}
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
                      <span>{!! Form::text('tps_parc',$report->tps_parc,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Réunion :</span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_reunion',$report->tps_reunion,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::checkbox('checkbox') !!}
                      {!! Form::label('CTRL_HDD', 'Disques') !!}
                    </div>
                    <div class="col-xs-6">
                      {!! Form::checkbox('checkbox') !!}
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
                      <span>{!! Form::text('tps_prix',$report->tps_prix,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Déplacement : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_dep',$report->tps_dep,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_RAID" id="CTRL_RAID" class="CTRL_RAID" value="true"/>
                        <label for="CTRL_LOG3">RAID</label></span>
                    </div>
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_MAJ_SOFT" id="CTRL_MAJ_SOFT" class="CTRL_MAJ_SOFT" value="true"/>
                        <label for="CTRL_LOG6">MAJ Logiciel</label></span>
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
                      <span>{!! Form::text('tps_inst',$report->tps_inst,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Ctrl journ. : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_ctrl',$report->tps_ctrl,['class' => 'form-control form-group']) !!}</span>
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
                      <span>{!! Form::text('tps_assist',$report->tps_assist,['class' => 'form-control form-group']) !!}</span>
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <span>Autre : </span>
                    </div>
                    <div class="col-xs-2 col-md-2">
                      <span>{!! Form::text('tps_autre',$report->tps_autre,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_BACKUP" id="CTRL_BACKUP" class="CTRL_BACKUP" value="true"/>
                        <label for="CTRL_LOG7">Vérification</label></span>
                    </div>
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_ANTIVIRUS" id="CTRL_ANTIVIRUS" class="CTRL_ANTIVIRUS" value="true" />
                        <label for="CTRL_LOG10">Vérification</label></span>
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
                      <span>{!! Form::text('tps_form',$report->tps_form,['class' => 'form-control form-group']) !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="VOLUM_BACKUP" id="VOLUM_BACKUP" class="VOLUM_BACKUP" value="true" />
                      <label for="CTRL_LOG8">Volumétrie</label></span>
                    </div>
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="MAJ_ANTIVIRUS" id="MAJ_ANTIVIRUS" class="MAJ_ANTIVIRUS" value="true" />
                      <label for="CTRL_LOG11">Mise à jour</label></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-offset-6">
                </div>
                <div class="col-xs-3 col-xs-offset-6">
                  <span><input type="checkbox" name="MAJ_BACKUP" id="MAJ_BACKUP" class="MAJ_BACKUP" value="true"/>
                  <label for="CTRL_LOG9">Mise à jour</label></span>
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
                    {!! Form::textarea('commentaire', $report->commentaire, ['class' => 'form-control', 'rows' => 3]) !!}
                    
                    
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

            <button type="submit" style="opacity:100" class="btn btn-primary" id="bt_dele">Supprimer</button>
          </div>
          {!! Form::close() !!}
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->


    <script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.fr.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/reports.js') }}"></script>

    <script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            autoclose: true
        });
    });
    </script>