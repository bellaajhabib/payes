@extends('layout')



@section('content')

    <div id="page-wrapper">
        <div class="row">

            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class="">Table Jouranl Paie IRPP</h1>
                </div>

            </div> <!-- /.col-lg-12 -->
        </div><!-- div row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                   Jouranl Paie
                    </div>
                    <!-- /.panel-heading -->

                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Poste</th>
                                    <th>Nom & Prénom</th>
                                    <th>Salaire impossable</th>
                                    <th>Salaire impossable annuel</th>
                                    <th>Abttement</th>
                                    <th>Déduction</th>
                                    <th>Salaire impossable 2</th>
                                    <th>IRPP Annuel</th>
                                    <th>IRPP Mensuel</th>

                                </tr>
                                </thead><div class="row">
                                @foreach ($jpirpp as $ct)
                                    <tr>

                                        <td>{{$ct->post}}   </td>
                                        <td> {{$ct->prenom}} {{$ct->nom}} </td>
                                        <td>{{$ct->jpIrpp->salaire_impossable}} </td>
                                        <td>{{$ct->jpIrpp->salaire_impossable_annuel}}  </td>
                                        <td>{{$ct->jpIrpp->abttement}}  </td>
                                        <td> {{$ct->jpIrpp->deduction}}  </td>
                                        <td> {{$ct->jpIrpp->salaire_impossable_2}}</td>
                                        <td> {{$ct->jpIrpp->irrp_annuel}}</td>
                                        <td> {{$ct->jpIrpp->irrp_mensuel}}</td>




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
        <!-- /#page-wrapper -->




@endsection
