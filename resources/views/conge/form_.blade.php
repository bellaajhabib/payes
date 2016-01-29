<div class="panel-body">

    <div class="row">
        <!--  tab  content-->
        <div class="tab-content">
            <!-- General tab-->
            <div class="tab-pane active" id="tab-general">

                    <div class="col-lg-8 col-lg-offset-2">


                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group  {{ $errors->has('nb_jour_conges') ? 'has-error' : '' }}">
                        {!! Form::label('Nomber des jours du conges') !!}
                        <div class="controls">
                            {!! Form::text('nb_jouer_conge_demander', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('nb_jour_conges', ':message') }}</span>
                        </div>
                    </div>

                        <div class="form-group  {{ $errors->has('date_de_debut_conge') ? 'has-error' : '' }}" id="groupDebutConge">
                            {!! Form::label('Date debut conges') !!}
                            <div class="controls">
                                {!! Form::text('date_de_debut_conge', null, array('class' => 'form-control','id'=>'dateDebutConge')) !!}
                                <span class="help-block">{{ $errors->first('date_de_debut_conge', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group  {{ $errors->has('date_de_fin_conge') ? 'has-error' : '' }}" id="groupFindConge">
                            {!! Form::label('Date fin conges') !!}
                            <div class="controls">
                                {!! Form::text('date_de_fin_conge', null, array('class' => 'form-control','id'=>'dateFinConge')) !!}
                                <span class="help-block">{{ $errors->first('date_de_fin_conge', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group  {{ $errors->has('conge_description') ? 'has-error' : '' }}" id="groupConge_descritption">
                            {!! Form::label('Description') !!}
                            <div class="controls">
                                {!! Form::textarea('description', null, array('class' => 'form-control','id'=>'conge_description','rows'=>"3")) !!}
                                <span class="help-block">{{ $errors->first('conge_description', ':message') }}</span>
                            </div>
                        </div>

                    </div>  <!-- /.col-lg-6-->
            </div>     <!-- tab pane -->
        </div> <!--tab content -->

        <div class="col-lg-12">
            <div class="col-lg-3 col-lg-push-3">
                <button type="reset" class="btn btn-danger btn-block">Anuuler</button>
                </button>
            </div>
            <div class="col-lg-3  col-lg-push-3">
                            {!! Form::submit($submitButtonText,['class'=>
                            'btn btn btn-success btn-block']) !!}



            </div>
        </div>

    </div><!-- /div row -->

</div><!-- /panel-body -->