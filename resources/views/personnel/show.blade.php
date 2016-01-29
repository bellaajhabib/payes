@extends('layout')



@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$personnels->nom}} {{$personnels->prenom}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Information personnelle</h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>

                                <tr class="info">
                                    <td>Nom & prénom:</td>
                                    <td>{{$personnels->nom}} {{$personnels->prenom}} </td>

                                </tr>
                                <tr class="info">
                                    <td>CIN:</td>
                                    <td> {{$personnels->cin}} </td>

                                </tr>
                                <tr class="info">
                                    <td>Situation familiale:</td>
                                    <td> {{ Config::get('constants')[$personnels->cf]}} </td>

                                </tr>
                                <tr class="info">
                                    <td> Nombre d'enfants:</td>
                                    <td> {{$personnels->nb_enfant}} </td>

                                </tr>
                                <tr class="info">
                                    <td> Date de naissance:</td>
                                    <td> {{$personnels->date_naissance}} </td>

                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

                    </div>
                    <!-- .panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Information professionnelle</h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>

                                <tr class="success">
                                    <td>Post :</td>
                                    <td>{{$personnels->post}}  </td>

                                </tr>
                                <tr class="success">
                                    <td>Type du Contrat :</td>
                                    <td> {{$personnels->maContrat->type_de_contrat}} </td>

                                </tr>

                                <tr class="success">
                                    <td> Date d'entrée :</td>
                                    <td> {{$personnels->date_entree}} </td>

                                </tr>
                                <tr class="success">
                                    <td> Date de fin du contrat:</td>
                                    <td> {{$personnels->date_de_fin_du_contrat}} </td>

                                </tr>
                                <tr class="success">
                                    <td> Numéro CNSS:</td>
                                    <td> {{$personnels->num_cnss}} </td>

                                </tr>
                                <tr class="success">
                                    <td> Congée payé:</td>
                                    <td> {{$personnels->conges_paye}} </td>

                                </tr>
                                <tr class="success">
                                    <td> Salaire brut</td>
                                    <td> {{$personnels->nb_jour * $personnels->salaire_du_jour}} </td>

                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- .panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->

    </div>




    </div>
    </div>
@stop
