@extends('layout')



@section('content')

    <div id="page-wrapper" style="min-height: 184px;">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Supprimé le personnel: {{$personnel->nom}}  {{$personnel->prenom}}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-lg-push-2 text-center">
                <div class="panel panel-red">
                    <div class="panel-heading">
                       <h5>voulez-vous vraiment supprimer</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="col-lg-6 ">
                        <a href="{!! URL::to('personnel/supprimerPersonnel/'.$personnel->id) !!}" type="button" class="btn btn-danger btn-lg">Oui</a>
                                    </div>
                                <div class="col-lg-6 ">
                        <a href="{!! URL::to('personnel') !!}" type="button" class="btn  btn-info btn-lg">Non</a>
                                </div>
                      </div>
                         </div>
                    </div>

                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div>
@stop
