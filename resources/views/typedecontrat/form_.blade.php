<div class="panel-body">

    <div class="row">
        <!--  tab  content-->
        <div class="tab-content">
            <!-- General tab-->
            <div class="tab-pane active" id="tab-general">

                    <div class="col-lg-8 col-lg-offset-2">


                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group  {{ $errors->has('type_de_contrat') ? 'has-error' : '' }}">
                        {!! Form::label('Type de Contrat') !!}
                        <div class="controls">
                            {!! Form::text('type_de_contrat', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('type_de_contrat', ':message') }}</span>
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