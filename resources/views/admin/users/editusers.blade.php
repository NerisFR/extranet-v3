<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Nouveau collaborateur</h3>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'put','url' => route('user.update', $collab)]) !!}
                <div class="row">
                    <div class="col-xs-6">
                        <span>Nom : </span>
                        <span>
                            {!! Form::text('nom',$collab->nom,['class' => 'form-control form-group']) !!}
                        </span>
                    </div>
                    <div class="col-xs-6">
                        <span>Prénom : </span>
                        <span>
                            {!! Form::text('prenom',$collab->prenom,['class' => 'form-control form-group']) !!}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <span>Fonction : </span>
                        <span>
                            {!! Form::text('fonction',$collab->function,['class' => 'form-control form-group']) !!}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <span>Date d'embauche : </span>
                        <span>
                            @if ($collab->embauche == '0000-00-00')
                                {!! Form::text('embauche', '',['class' => 'datepicker form-control form-group']) !!}
                            @else
                                {!! Form::text('embauche', date('d/m/Y', strtotime($collab->embauche)),['class' => 'datepicker form-control form-group']) !!}
                            @endif
                        </span>
                    </div>
                    <div class="col-xs-6">
                        <span>Date de sortie : </span>
                        <span>
                            @if ($collab->debauche == '0000-00-00'  || $collab->debauche == '')
                                {!! Form::text('debauche', '',['class' => 'datepicker form-control form-group']) !!}
                            @else
                                {!! Form::text('debauche', date('d/m/Y', strtotime($collab->debauche)),['class' => 'datepicker form-control form-group']) !!}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <span>Loggin (Email) :</span>
                        <span>
                            {!! Form::text('email',$collab->email,['class' => 'form-control form-group']) !!}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <span>Profil d'accès :</span>
                        <span>
                            <select name="profil" id="profil" class="form-control profil">
                                
                            </select>
                        </span>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" id="bt_annul_collab" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary pull-right" id="bt_modif_collab">Enregistrer</button>
                </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.example-modal -->        

<!-- jQuery 2.1.4 -->
<!-- <script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script> -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- datepicker -->
<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.fr.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'fr',
            autoclose: true
        });
    });
</script>