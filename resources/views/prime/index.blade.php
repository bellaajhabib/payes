@extends('layout')



@section('content')



    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class="">    Listes des primes</h1>
                </div>
                <div class="col-lg-2 ">
                    <div class="pull-right ">

                        <a href="{{URL::to('primes/create')}}"
                           class="btn btn-primary btn-primary-header  ">Ajouter</a>

                    </div>
                </div>
            </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Prime</th>
                                        <th></th>
                                    </tr>

                                    </thead><div class="row">
                                        @foreach ($primes as $pr)
                                            <tr>

                                                <td> {{$pr->description}} </td>
                                                <td class="col-lg-1">

                                                    @if($pr->id!=1)
                                                    {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('primes.destroy', $pr->id))) !!}



                                                    {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}


                                                    {!! Form::close() !!}

                                                    @endif
                                                </td>

                                            </tr>


                                        @endforeach
                                    </div>

                                </table>
                            </div>
                            <!-- /.table-responsive -->

                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>


                <!-- /.row -->
            </div>
        </div>


    </div>





@endsection
