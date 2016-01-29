<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    body {
        font-size: 12pt;

    }

    .container {
        width: 720px;
        height: auto;
        margin: 0 auto;

    }

    .page-break {
        background: red;
    }

    h2 {
        margin-left: 278px;
        border: 1px solid #000;
        padding: 20px;
        background: #E0E0E0;
        text-align: center;
        width: 400px;
        font-size: 24px;

    }

    .tab-top {
        border-collapse: collapse;
        margin-left: 123px;
        margin-top: 50px;
        font-size: small;

    }

    .tab-top, td, th {

        width: 100px;
        font-size: x-small;
    }

    .tab-top td {
        text-align: center;

    }

    tr.titre td {
        border: 1px solid black;

    }

    td.cin {
        width: 140px;

    }

    .tab-top th[colspan="3"] {

        border: 1px solid black;
    }

    .tab-top th[colspan="2"] {

        border-top: 1px solid black;

    }

    th[colspan="2"].annee {
        border-right: 1px solid black;
    }

    .container-tab-ligne {
        margin-left: 69px;

    }

    .tab-ligne {

        border: 1px solid black;
        width: 650px;

    }

    .tab-ligne tr {

        padding: 0px;
    }

    .emargement-societe {
        padding-top: 5px;
        text-align: center;
        margin-top: 20px;
        height: 100px;
        width: 250px;
        border: 1px dotted #000000;

    }

    .non-prenom {
        position: relative;
        left: 374px;
        top: -110px;
        padding-top: 5px;
        padding-left: 5px;
        height: 60px;
        width: 340px;
        border: 1px dotted #000000;

    }

    .paie-top {

        height: 30px;
        width: 719px;
        border: 1px dotted #000000;

    }

    .paie {

        height: 500px;
        width: 100%;
        border: 1px solid #000000;
    }

    .table-paie th {

        border-left: 1px solid #000000;
        border-bottom: 1px solid #000000;
        color: #000000;

        text-align: center;
    }

    .table-paie td {
        height: 20px;
        border-right: 1px solid #000000;

        color: #000000;

        text-align: center;
    }

    .table-paie {
        border-collapse: collapse;
        border-spacing: 0;

    }

    .table-paie td {

        padding: 5px 10px;
        vertical-align: top;
    }

    .table-paie th {
        vertical-align: center;

    }

    .table-slaier {
        border-collapse: collapse;
        border-spacing: 0;
        border-top: 1px solid #000000;
        width: 50px;
        position: relative;
        top: -1px;
    }

    .table-slaier th {

        border-right: 1px solid #000000;
        border-bottom: 1px solid #000000;

        text-align: center;
    }

</style>


<html>
<body>
<div class="container">
    <h2>BULLTEN DE PAIE</h2>

    <table class="tab-top">
        <tr>
            <th colspan="3">MOIS</th>
            <th colspan="2">{{Config::get('monthFr')[$currentdate->month]}}</th>
            <th colspan="2" class="annee"> {{$currentdate->year}}</th>
        </tr>
        <tr class="titre">
            <td>S.C.P
                <small>(j)</small>
            </td>
            <td class="cin">CIN/N affil.Assur.Grp</td>
            <td>Régim</td>
            <td colspan="2">N Sécu</td>
            <td colspan="2">Date D'embauche</td>
        </tr>
        <tr>
            <td>{{ ($pe->conges->somme_conge_demander) }}</td>
            <td class="cin">{{ ($pe->cin) }}</td>
            <td>{{ ($pe->maContrat->type_de_contrat) }}</td>
            <td colspan="2">{{ ($pe->num_cnss) }}</td>
            <td colspan="2">{{ ($pe->date_entree) }}</td>
        </tr>
    </table>
    <div class="container-tab-ligne">
        <table class="tab-ligne">
            <tr>
                <td> Paiement par:</td>
                <td>R.I.B</td>
                <td>S.F: {{Config::get('constants')[$pe->cf] }}</td>
                <td>{{$pe->nb_enfant}} enfant</td>
            </tr>
        </table>

    </div>
    <div class="box">
        <div class="emargement-societe"> Emargement Sociéte</div>

        <div class="non-prenom">{{($pe->nom)}} {{($pe->prenom)}} </div>

    </div>
    <div class="paie-top"></div>
    <div class="paie">


        <table class="table-paie">

            <tbody>
            <tr>
                <th colspan="2" rowspan="2" width="100px" style=" border-left:none">Désignation</th>
                <th colspan="2" rowspan="2" width="70px">Nombre</th>
                <th colspan="2" rowspan="2" width="45px">Base</th>
                <th colspan="3" width="80px"> Part Salariale</th>
                <th colspan="3" width="80px">Part Patronale</th>
            </tr>

            <tr>
                <th width="70px">Taux(%)</th>
                <th width="55px">Gain</th>
                <th width="60px">Retenue</th>
                <th width="62px">Taux (%)</th>
                <th width="80px">Retenue (+)</th>
                <th width="80px" style=" border-right:none">Retenue (-)</th>
            </tr>

            <tr>

                <td colspan="2">Salaire de Base</td>
                <td colspan="2" width="45px">100000</td>
                <td colspan="2" width="45px">100.000.</td>
                <td></td>
                <!-- salaire de base Gain-->
                <td  width="20px">{{ ($pe->nomber_jour)
                    *($pe->salaire_jour) }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td style=" border-right:none"></td>

            </tr>
            <tr>

                <td colspan="2">Salaire Brut</td>
                <td colspan="2" width="45px"></td>
                <td colspan="2"></td>
                <td></td>
                <!-- salaire brut -->
                <td  width="55px">{{ $pe->jpCoutTotals->salaire_brut }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td style=" border-right:none"></td>

            </tr>

            </tbody>
        </table>
        <table class="table-slaier">

            <tr>
                <th width="50px">Salaire Brut</th>
                <th width="50px">Salaire <br>Net</th>
                <th width="70px">Charges Salariales</th>
                <th width="60px"> Charges Patronales</th>
                <th width="70px">Salaire imposable</th>
                <th width="73px">I.R.P.P</th>
                <th width="60px">Avance</th>
                <th width="62px">Coût Toal</th>
                <th width="162px" style=" border-right:none">NET A PAYER</th>

            </tr>
            <tr>
                <th width="58px">{{ ($pe->jpCoutTotals->salaire_brut) }}</th>
                <th width="57.5px">{{ ($pe->jpCoutTotals->salaier_net) }}</th>
                <th width="70px">Charges Salariales</th>
                <th width="60px"> {{ ($pe->jpCoutTotals->charage_patronal) }}</th>
                <th width="70px">{{ ($pe->jpIrpp->salaire_impossable_2) }}</th>
                <th width="73px">{{ ($pe->jpIrpp->irrp_mensuel) }}</th>
                <th width="60px">{{ ($pe->avance) }}<</th>
                <th width="62px">{{ ($pe->jpCoutTotals->cout_total) }}</th>
                <th width="162px" style=" border-right:none">{{ ($pe->jpCoutTotals->salaier_net)
                    -($pe->avance) }}
                </th>

            </tr>


        </table>
    </div>
</div>
</body>
</html>



