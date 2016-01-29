@extends('layout')



@section('content')

    <div id="page-wrapper">
        <div class="row">

            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class="">Table Jouranl Paie mensuel</h1>
                </div>

            </div> <!-- /.col-lg-12 -->
        </div><!-- div row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                   Jouranl Paie mensuel
                    </div>
                    <!-- /.panel-heading -->

                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Poste</th>
                                    <th>Nom & Prénom</th>
                                    <th>Salaire Brut</th>
                                    <th>Retenue CNSS</th>
                                    <th>Salaire Imposable</th>
                                    <th>Retenu IRPP</th>
                                    <th>Salaire Net</th>
                                    <th>Charge Patronal</th>
                                    <th>TFP</th>
                                    <th>FOPROLOS</th>
                                    <th>Coût Total</th>
                                </tr>
                                </thead><div class="row">
                                @foreach ($jpct as $ct)
                                    <tr>

                                        <td>{{$ct->post}}   </td>
                                        <td> {{$ct->prenom}} {{$ct->nom}} </td>
                                        <td>{{$ct->jpCoutTotals->salaire_brut}} </td>
                                        <td>{{$ct->jpCoutTotals->retenu_cnss}}  </td>
                                        <td>{{$ct->jpCoutTotals->salaier_imposable}}  </td>
                                        <td> {{$ct->jpCoutTotals->retenue_irpp}}  </td>
                                        <td> {{$ct->jpCoutTotals->salaier_net}}</td>
                                        <td> {{$ct->jpCoutTotals->charage_patronal}}</td>
                                        <td> {{$ct->jpCoutTotals->tfp}}</td>
                                        <td> {{$ct->jpCoutTotals->foprolos}}</td>
                                        <td>{{$ct->jpCoutTotals->cout_total}}</td>


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
