@extends('layout')



@section('content')

    <div id="page-wrapper">
        <div class="row">

            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class="">CNSS</h1>
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
                                    <th>Retenu CNSS</th>
                                    <th>Charge Patronale</th>
                                    <th>Accident De travail</th>
                                    <th>Coût Total Mensuel</th>
                                    <th>Coût Total Trimestriel</th>
                                </tr>
                                </thead><div class="row">
                                @foreach ($cnss as $ct)
                                    <tr>

                                        <td>{{$ct->post}}   </td>
                                        <td> {{$ct->prenom}} {{$ct->nom}} </td>
                                        <td>{{$ct->cnss->retenue_cnss}} </td>
                                        <td>{{$ct->cnss->charge_patronale}}  </td>
                                        <td>{{$ct->cnss->accident_de_travail}}  </td>
                                        <td>{{$ct->cnss->cout_total_mensuel}}  </td>
                                        <td>{{$ct->cnss->cout_total_trimestriel}}  </td>



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
