<div class="panel-body">

    <div class="row">
        <!--  tab  content-->
        <div class="tab-content">
            <!-- General tab-->
            <div class="tab-pane active" id="tab-general">
                <div class="col-lg-6">


                        <input type="hidden" name="_token" value="{{csrf_token()}}">




                <div class="form-group  {{ $errors->has('post') ? 'has-error' : '' }}">
                    {!! Form::label('Poste') !!}
                    <div class="controls">
                        {!! Form::text('post', null, array('class' => 'form-control','id'=>'post')) !!}
                        <span class="help-block">{{ $errors->first('post', ':message') }}</span>
                    </div>
                </div>
                    <div class="form-group  {{ $errors->has('nom') ? 'has-error' : '' }}">
                        {!! Form::label('Nom') !!}
                        <div class="controls">
                            {!! Form::text('nom', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('nom', ':message') }}</span>
                        </div>
                    </div>

                    <div class="form-group  {{ $errors->has('prenom') ? 'has-error' : '' }}">
                        {!! Form::label('Prénom') !!}
                        <div class="controls">
                            {!! Form::text('prenom', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('prenom', ':message') }}</span>
                        </div>
                    </div>

                    <div class="form-group  {{ $errors->has('cin') ? 'has-error' : '' }}">
                        {!! Form::label('Cin') !!}
                        <div class="controls">
                            {!! Form::text('cin', null, array('class' => 'form-control','id'=>'cin')) !!}
                            <span class="help-block">{{ $errors->first('cin', ':message') }}</span>
                        </div>
                    </div>

                    <div class="form-group  {{ $errors->has('cf') ? 'has-error' : '' }}">
                        {!! Form::label('Cf') !!}
                        <div class="controls">
                            {!! Form::select('cf', Config::get('constants'), isset($personnel)? $personnel->cf : '0', array(
                            'class' => 'form-control',
                            'id'=>'CF')) !!}
                            <span class="help-block">{{ $errors->first('cf', ':message') }}</span>
                        </div>
                    </div>




                </div><!-- /.col-lg-6-->
                <div class="col-lg-6">
                    <div class="form-group  {{ $errors->has('date_naissance') ? 'has-error' : '' }}">
                        {!! Form::label('Date de Naissance') !!}
                        <div class="controls">
                            {!! Form::text('date_naissance', null, array('class' => 'form-control ','id'=>'dateNaissance')) !!}
                            <span class="help-block">{{ $errors->first('date_naissance', ':message') }}</span>
                        </div>
                    </div>

                    <div class="form-group  {{ $errors->has('date_entree') ? 'has-error' : '' }}">
                        {!! Form::label('Date d entrée') !!}
                        <div class="controls">
                            {!! Form::text('date_entree', null, array('class' => 'form-control','id'=>'dateEntree')) !!}
                            <span class="help-block">{{ $errors->first('date_entree', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group  {{ $errors->has('type_de_contrat_id') ? 'has-error' : '' }}">
                        {!! Form::label('type de contrat','Type du Contrat', array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::select('type_de_contrat_id', $typedecontrat, isset($personnel)? $personnel->type_de_contrat_id : '1', array('class' => 'form-control','id'=>'contrat_id')) !!}
                            <span class="help-block">{{ $errors->first('type_de_contrat_id', ':message') }}</span>
                        </div>
                    </div>


                    <div class="form-group  {{ $errors->has('date_de_fin_du_contrat') ? 'has-error' : '' }}" id="groupFindContrat">
                        {!! Form::label('Date de Fin du cortrat') !!}
                        <div class="controls">
                            {!! Form::text('date_de_fin_du_contrat', null, array('class' => 'form-control','id'=>'dateFinDuContrat')) !!}
                            <span class="help-block">{{ $errors->first('date_de_fin_du_contrat', ':message') }}</span>
                        </div>
                    </div>


                    <div class="form-group  {{ $errors->has('num_cnss') ? 'has-error' : '' }}">
                        {!! Form::label('N Cnss') !!}
                        <div class="controls">
                            {!! Form::text('num_cnss', null, array('class' => 'form-control','id'=>'cnss')) !!}
                            <span class="help-block">{{ $errors->first('num_cnss', ':message') }}</span>
                        </div>
                    </div>

                    <div class="form-group  {{ $errors->has('nb_enfant') ? 'has-error' : '' }}">
                        {!! Form::label('Nb enfant') !!}
                        <div class="controls">

                            {!!  Form::selectRange('nb_enfant', 0, 4,0,[
                            'class' => 'form-control',
                            'id'=>'NBENFANTS']) !!}
                            <span class="help-block">{{ $errors->first('nb_enfant', ':message') }}</span>
                        </div>
                    </div>




                </div>  <!-- /.col-lg-6-->
            </div>     <!-- tab pane -->
        </div> <!--tab content -->

        <div class="col-lg-12">
            <div class="col-lg-3 col-lg-push-3">
                <button type="reset" class="btn btn-danger btn-lg btn-block">Anuuler</button>
                </button>
            </div>
            <div class="col-lg-3  col-lg-push-3">
                            {!! Form::submit($submitButtonText,['class'=>
                            'btn btn btn-success btn-lg btn-block']) !!}



            </div>
        </div>

    </div><!-- /div row -->

</div><!-- /panel-body -->
