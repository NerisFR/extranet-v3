


    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Nouvelle note de synthese</h3>
        </div>
        <div class="modal-body">
          {!! BootForm::open() !!}
            
              <!-- <div class="reussi" id="reussi" style='width:700px'></div> -->
              <div class="col-xs-12">
                <h4 class="modal-title">Renseignement administratif</h4>
                <span style='opacity:0'><input id="num_id"></input></span>
              </div>

              <div class="col-xs-6">
                <span>Collab. : </span>
                <span><select required name="collab" id="collab" class="form-control collab">
                    
                  </select></span>
              </div>
              <div class="col-xs-6">
                  <span>Date : </span>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control datepicker pull-right" id="jour" value="" />
                  </div>
              </div>
                 

              <div class="col-xs-6">
                <span>Client :</span>
                <span><select name="client" id="client" class="form-control client" required>
                  <option value="">             </option>

                  </select></span>
              </div>
              <div class="col-xs-6">
                <span>Heure d'arrivée :</span>
                <span><select name="h_debut" id="h_debut" class="form-control h_debut">
                  
                  </select></span>
              </div>

              <div class="col-xs-6">
                <span>Contrat :</span>
                <span><select name="contrat" id="contrat" class="form-control contrat" required>
                  <option>             </option>
                  </select>
                </span>
              </div>
              <div class="col-xs-6">
                <span>Heure de départ :</span>
                <span><select name="h_fin" id="h_fin" class="form-control h_fin">
                  
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
                    <div class="col-xs-3 col-md-3">
                      <span>Admin. syst. : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Admin. syst. :','tps_adm',$report->tps_adm)->hideLabel() !!}</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>Suivi de proj. : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Suivi de proj. :','tps_proj',$report->tps_proj)->hideLabel() !!}</span>
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
                    <div class="col-xs-3 col-md-3">
                      <span>Maintenance : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Maintenance :','tps_maint',$report->tps_maint,['class' => 'form-control'])->hideLabel() !!}</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>Etude &amp; dev. :</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Etude &amp; dev. :','tps_dev',$report->tps_dev)->hideLabel() !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      <!-- <span style='width:20px'>&nbsp;</span> -->
                      <span><input type="checkbox" name="CTRL_LOG" id="CTRL_LOG" class="CTRL_LOG" value="true" />
                        <label for="CTRL_LOG">Contrôle Log </label></span>
                    </div>
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_MAJ_OS" id="CTRL_MAJ_OS" class="CTRL_MAJ_OS" value="true"/>
                        <label for="CTRL_LOG">MAJ OS</label></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-3 col-md-3">
                      <span>Suivi de parc :</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Suivi de parc :','tps_parc',$report->tps_parc)->hideLabel() !!}</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>Réunion :</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Réunion :','tps_reunion',$report->tps_reunion)->hideLabel() !!}</span>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_HDD" id="CTRL_HDD" class="CTRL_HDD" value="true"/>
                        <label for="CTRL_LOG2">Disques</label></span>
                    </div>
                    <div class="col-xs-6">
                      <span><input type="checkbox" name="CTRL_MAJ_HARD" id="CTRL_MAJ_HARD" class="CTRL_MAJ_HARD" value="true"/>
                        <label for="CTRL_LOG5">MAJ Hard</label></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="row">
                    <div class="col-xs-3 col-md-3">
                      <span>Etude de prix : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Etude de prix :','tps_prix',$report->tps_prix)->hideLabel() !!}</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>Déplacement : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Déplacement :','tps_dep',$report->tps_dep)->hideLabel() !!}</span>
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
                    <div class="col-xs-3 col-md-3">
                      <span>Inst./param. : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Inst./param. :','tps_inst',$report->tps_inst)->hideLabel() !!}</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>Ctrl journ. : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Ctrl journ. :','tps_ctrl',$report->tps_ctrl)->hideLabel() !!}</span>
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
                    <div class="col-xs-3 col-md-3">
                      <span>Assist. util. :</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Assist. util. :','tps_assist',$report->tps_assist)->hideLabel() !!}</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>Autre : </span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Autre : ','tps_autre',$report->tps_autre)->hideLabel() !!}</span>
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
                    <div class="col-xs-3 col-md-3">
                      <span>Formation :</span>
                    </div>
                    <div class="col-xs-3 col-md-3">
                      <span>{!! BootForm::text('Formation :','tps_form',$report->tps_form)->hideLabel() !!}</span>
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
                    {!! BootForm::text('Commentaire :','commentaire',$report->commentaire)->hideLabel() !!}
                    
                </div>
              </div>
                <!-- <div align="center" style='line-height:20px;vertical-align:center'>
                    <input type="submit" width="50" height="20" id="bt_modif" class="bt_modif" style="border:3px solid;border-radius : 24px;" value="Mettre à jour"></input>
                </div> -->
            
            <!-- </div> -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" id="bt_annul" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary" id="bt_impr">Imprimer</button>
            <button type="submit" class="btn btn-primary" id="bt_modif">Enregistrer</button>
            <button type="submit" style="opacity:0" class="btn btn-primary" id="bt_del">Supprimer</button>
          </div>
          {!! BootForm::close() !!}
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
