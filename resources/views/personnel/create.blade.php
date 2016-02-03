@extends('layout')



@section('content')

    <div id="page-wrapper">
        <!--header tab -->
        <div class="row">

            <div class="col-lg-12 page-header">
                <div class="col-lg-10 ">
                    <h1 class="">Personnel</h1>
                </div>
                <div class="col-lg-2   ">
                    <div class="pull-right ">

                        <a href="{!! URL::to('personnel') !!} " class="btn btn-primary btn-primary-header  ">
                            Back
                        </a>
                    </div>
                </div>
            </div> <!-- /.col-lg-12 -->
        </div><!-- div row -->
        <!-- end header tab -->

        <!--container Tab -->
        <div class="row"><!-- /.row -->
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Création personnel
                    </div>
                    {!! Form::open(['url' => route('personnel.store'),'files'=> true])  !!}
                    @include('personnel.form_',['submitButtonText'=>'Ajouter ']);
                    {!! Form::close() !!}
                </div><!-- /div panel- panel-default-->
            </div><!--col-lg-12 -->
        </div><!-- row -->
        <!--end container tab -->
    </div><!-- container tab -->

    </div>  <!-- /#page-wrapper -->







@endsection
