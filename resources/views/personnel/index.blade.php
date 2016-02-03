
<?php header('Access-Control-Allow-Origin: *'); ?>
@extends('layout')


@section('content')

            <!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Avance</h4>
            </div>
            <div class="modal-body">

                <input type="text" class="form-control" id="montant-avance" value= "0" >
                <input type="hidden" class="form-control" id="id-personnel" value="0" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="ajout-avance">Ajouter</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

<div id="page-wrapper">
    <div class="row">

        <div class="col-lg-12 page-header">
            <div class="col-lg-10 ">
                <h1 class="">Table Personnel</h1>
                <div id="target">
                    Click here
                </div>
            </div>
            <div class="col-lg-2 ">
                <div class="pull-right ">

                    <a href="{!! URL::to('personnel/create') !!} " class="btn btn-primary btn-primary-header  ">
                        Ajouter
                    </a>
                </div>
            </div>
        </div> <!-- /.col-lg-12 -->
    </div><!-- div row -->
    <!-- /.row -->
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
                                <th>Poste</th>
                                <th>Nom & Prénom</th>
                                {{--<th>Finger ID</th>--}}
                                <th>CIN</th>
                                <th>CF</th>
                                {{--<th>Nbre D'enfant</th>--}}
                                <th>Date de Naissance</th>
                                <th>Date d'entrée</th>
                                <th> Contrat</th>
                                <th> N° CNSS</th>
                                <th> Nombre du jour</th>
                                <th> Salaire du jour</th>
                                <th></th>
                                <th> Avance</th>
                                <th> Primes</th>
                                {{--<th>Date Fin du Contrat</th>--}}

                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <div class="row">
                                @foreach ($personnels as $personnel)



                                    <tr>

                                        <td> {{($personnel->post)}} </td>
                                        <td> {{($personnel->nom)}} {{($personnel->prenom)}}  </td>
                                        {{--<td> </td>--}}
                                        <td> {{($personnel->cin)}} </td>


                                        <td>  {{Config::get('constants')[$personnel->cf] }} </td>
                                        {{--<td> {{($personnel->nbEnfant)}} </td>--}}
                                        <td> {{(($personnel->date_naissance))}} </td>
                                        <td> {{($personnel->dateEntree)}} </td>

                                        <td> {{($personnel->maContrat->type_de_contrat)}} </td>

                                        {{--<td> {{($personnel->dateDeFinDuContrat)}} </td>--}}
                                        <td> {{($personnel->num_cnss)}} </td>
                                        <td> {{($personnel->nomber_jour)}} </td>
                                        <td> {{($personnel->salaire_jour)}} </td>
                                        <td>
                                            <div type="button" id="avance" class="btn btn-info test"  val="{{$personnel->id }}" >ajouter avance
                                            </div>
                                        </td>
                                        <td> {{($personnel->avance)}} </td>
                                        <td>

                                            @foreach ($personnel->primes as $primes)
                                            @if ($personnel->prime == $primes->pivot->prime_order)
                                            </br>
                                            - {{$primes->description}} :
                                            {{$primes->pivot->montant_prime}}


                                            @endif




                                            @endforeach</td>

                                        <td>
                                            <a href="{!! URL::to('personnel/'.$personnel->id.'/edit') !!}"><i
                                                            class="fa fa-pencil"> </i></a>
                                        </td>
                                        <td>
                                            <a href="{!! URL::to('personnel/delete/'.$personnel->id) !!}"
                                               class="btn btn-danger  btn-sm"><i class="fa fa-times-circle-o"> </i></a>
                                        </td>
                                        <td>
                                            <a href="{{route('personnel.show', ['name' => $personnel->id])}}"
                                               class="btn btn-warning  btn-sm"><i class="fa fa-building-o"> </i></a>
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


</div>

@endsection
