@extends('layout')



@section('content')


    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class=""> Type de contrat</h1>
                </div>
                <div class="col-lg-2 ">
                    <div class="pull-right ">

                        <a href="{{URL::to('typeDeContrat/create')}}"
                           class="btn btn-primary btn-primary-header  ">Ajouter</a>

                    </div>
                </div>
            </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Tables de contrat
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Nom de Contrat</th>
                                        <th>Nomber de Personnels</th>
                                    </tr>
                                    </thead><div class="row">
                                        @foreach ($typedeContrats as $typedeContrat)
                                            <tr>

                                                <td> {{$typedeContrat->type_de_contrat}}</td>
                                                <td> <?php echo($typedeContrat->personnel->count());?></td>
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
