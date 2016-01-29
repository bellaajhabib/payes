@extends('layout')



@section('content')

    <div id="page-wrapper">
        <div class="row">

            <div class="col-lg-12 page-header">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="col-lg-10 ">
                    <h1 class="">Calcul du salaire Brut</h1>

                </div>


            </div>
            {!! Form::open(['url' => route('clsalaire')])  !!}
            <div class="panel-body">

                <div class="row">

                    <div class="col-lg-8 col-lg-push-2 panel-heading">
                        <h1 class="page-header">Salaire  </h1>
                        <div class="panel panel-primary">
                            <div class="panel-heading">

                                <div class="panel-body">
                                    <div class="form-group">
                                        {!! Form::label('Personnel') !!}
                                        {!! Form::select('personnel_id',$personnels,null,['class'=>'form-control ']) !!}

                                    </div>
                                    <div class="form-group  {{ $errors->has('salaire_du_jour') ? 'has-error' : '' }}">
                                        {!! Form::label('Salaire par jour travaille') !!}
                                        <div class="controls">
                                            {!! Form::text('salaire_du_jour', null, array('class' => 'form-control')) !!}
                                            <span class="help-block">{{ $errors->first('salaire_du_jour', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('nb_jour') ? 'has-error' : '' }}">
                                        {!! Form::label('Nomber du Jours') !!}
                                        <div class="controls">
                                            {!! Form::text('nb_jour', null, array('class' => 'form-control')) !!}
                                            <span class="help-block">{{ $errors->first('nb_jour', ':message') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Moyen de paiement') !!}
                                        {!! Form::select('paiement_par',Config::get('paiement_par') ,null,['class'=>'form-control ']) !!}

                                    </div>
                                    <div class="form-group  {{ $errors->has('avance') ? 'has-error' : '' }}">
                                        {!! Form::label('avance') !!}
                                        <div class="controls">
                                            {!! Form::text('avance', null, array('class' => 'form-control')) !!}
                                            <span class="help-block">{{ $errors->first('avance', ':message') }}</span>
                                        </div>
                                    </div>

                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-lg-8 col-lg-push-2 panel-heading">

                          <h1 class="page-header">Primes</h1>

                          <div class="panel panel-primary">

                              <div class="panel-heading">
                                  <a href="{{URL::to('primes')}}" type="button" class="btn btn-warning span5 pull-right">Listes des primes</a>
                                  <div class="panel-body">

                                      <div class="form-group">
                                          {!! Form::label('prime') !!}
                                        {!! Form::select('prime_select[]',$prime,null,['id'=>'IDprime','class'=>'form-control ','multiple']) !!}

                                    </div>

                                    <div class="montant-prime">
                                        <h3>montant  prime</h3>
                                        <div class="container-montant-prime">
                                        </div>
                                    </div>

                                </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="col-lg-3 col-lg-push-3">
                        <button type="reset" class="btn btn-danger btn-lg btn-block">Anuuler</button>
                        </button>
                    </div>
                    <div class="col-lg-3  col-lg-push-3">
                        {!! Form::submit('Calcule',['class'=>
                        'btn btn btn-success btn-lg btn-block']) !!}



                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->




@endsection
