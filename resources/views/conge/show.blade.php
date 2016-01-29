@extends('layout')



@section('content')
    <div id="page-wrapper">

        @if(!($Listconges->isEmpty()))
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{{$Listconges->get(0)->nom}} {{$Listconges->get(0)->prenom}}</h1>

            </div>
            <!-- /.col-lg-12

             -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-lg-push-2">
                <div class="panel panel-default">
                    <div class="panel-heading heading-conges-lists">

                        <div class="row">
                            <div class="col-lg-6 col-xs-6"> Détails Congés</div>
                            <div class="col-lg-6 col-xs-6">
                                <div class="col-lg-8 col-lg-push-4 col-md-8 col-md-push-6   col-sm-6 col-sm-push-6 col-xs-6 col-xs-push-6">
                                    <div class="pull-left">Congés restants: {{$Listconges->last()->nb_jour_de_conge_reste}} <small>Jours</small></div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th>Debut conge</th>
                                    <th>Fin conge</th>
                                    <th>Conge demander</th>
                                    <th>Description </th>
                                    <th>Modifier </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($Listconges as $key => $ls)
                                <tr class="{{$key%2==0?'danger':'warning'}}">
                                    <td>{{$ls->date_de_debut_conge}}</td>
                                    <td>{{$ls->date_de_fin_conge}}</td>
                                    <td>{{$ls->nb_jouer_conge_demander}} <small>Jours</small></td>
                                    <td>{{ ($ls->description)}}</td>
                                    <td>   <a  href="{!! URL::to('conges/updateCongee/'.$ls->id) !!}" class="btn btn-link btn-sm"><i class="fa fa fa-pencil"> </i></a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->


                </div>
                <!-- /.panel -->
            </div>

        </div>

        @else
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-lg-push-3">
                    <h1 class="page-header">Aucune congé demande</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.row -->
        @endif
    </div>





@stop
