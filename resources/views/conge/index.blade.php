@extends('layout')



@section('content')

    <div id="page-wrapper">
        <div class="row">

            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class=""> Gestion des congés</h1>
                </div>

            </div> <!-- /.col-lg-12 -->
        </div><!-- div row -->
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Liste du personnl
                    </div>
                    <!-- /.panel-heading -->

                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Post</th>
                                    <th>Nom & Prénom</th>
                                    <th>Congé payé consommé  </th>
                                    <th>Congé payé restants</th>
                                    <th>Jour de entree</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                                </thead><div class="row">
                                    @foreach ($conges as $ct)
                                        <tr>
                                            <td>{{$ct->post}}   </td>
                                            <td> {{$ct->prenom}} {{$ct->nom}} </td>
                                            <td> {{$ct->conges->somme_conge_demander}} <small>Jours</small></td>
                                            <td> {{$ct->conges->nb_jour_de_conge_reste}} <small>Jours</small></td>
                                            <td> {{$ct->date_entree}} </td>
                                            <td><a href="{!! URL::to('conges/'.$ct->id.'/edit/' ) !!}" type="button" class="btn btn-primary btn-sm center">Demande conges</a></td>
                                            <td>
                                                <a  href="{!! URL::to('conges/') !!}" class="btn btn-link btn-sm"><i class="fa fa fa-pencil"> </i></a>
                                            </td>
                                            <td>
                                                <a href="{{route('conges.show', ['id' => $ct->id])}}" class="btn btn-warning  btn-sm"><i class="fa fa-building-o"> </i></a>
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
        <!-- /#page-wrapper -->




@endsection
