<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html">Gestion de paies</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>


    <ul class="nav navbar-right navbar-top-links">

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> Admin <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user ">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Utilisateur</a>

                <li class="divider"></li>
                <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Déconnecter</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="{{URL::to('dashborad')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#">Personnels<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{URL::to('personnel')}}">Etat Personnel</a>
                        </li>
                        <li>
                            <a href="{{URL::to('salaire')}}">Calcul du salaire Brut</a>
                        </li>
                        <li>
                            <a href="{{URL::to('typeDeContrat')}}">Type de Contrat</a>
                        </li>
                        <li>
                            <a href="{{URL::to('conges')}}">Congés</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{URL::to('JournalPaieCoutTotal')}}"><i class="fa fa-table fa-fw"></i> Journal de paie (Coût Total)</a>
                </li>
                <li>
                    <a href="{{URL::to('JournalPaieIrpp')}}"><i class="fa fa-table fa-fw"></i> Journal de paie (IRPP)</a>
                </li></a>
                </li>
                <li>
                    <a href="{{URL::to('cnss')}}"><i class="fa fa-edit fa-fw"></i> CNSS</a>
                </li>
                <li>
                    <a href="forms.html"><i class="fa fa-pencil fa-fw"></i> Plage de salaire imposable</a>
                </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav in" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="index.html" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="flot.html">Flot Charts</a>
                        </li>
                        <li>
                            <a href="morris.html">Morris.js Charts</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                </li>
                <li>
                    <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                </li>


            </ul>
        </div>
    </div>
</nav>