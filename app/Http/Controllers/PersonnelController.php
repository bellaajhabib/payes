<?php

namespace App\Http\Controllers;

use App\Cnss;
use App\Conges;
use App\JournalPaieCoutTotal;
use App\JournalPaieIrpp;
use App\Personnels;
use App\Prime;
use App\TypeContrat;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

//coefficion retenus cnss
define("COEFFICIENT_RETENUE_CNSS", 0.0918);
//coefficion Calcule Retenue Charge Patronal
define("COEFFICIENT_CHARGE_PATRONAl", 0.1607);
define("COEFFICIENT_TFP", 0.2);
define("COEFFICIENT_FOPROLOS", 0.1);
define("COEFFICIENT_ACCIDENT_TRAVAIL", 0.005);
//Nombre du Mois
define("NOMBERDUMOIS", 12);
// Déduction fix de Salaire imposable 1
define("DEDUCTIONFIX", 0.1);

// Déduction sur nomber d'enfants
define("DEDUCTION_NB_ENFANTS_1", 90);
define("DEDUCTION_NB_ENFANTS_2", 165);
define("DEDUCTION_NB_ENFANTS_3", 225);
define("DEDUCTION_NB_ENFANTS_4", 270);
// Nomber de jour de Conges
define("COEFFICIENT_NB_CONGEE", 2);

class PersonnelController extends Controller
{    static $order_primes = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $personnels = Personnels::where('deleted_at', '0')->get();
        // ***************  get value of montant_prime in table pivote   personnels_primem declare ************************
       // dd (  $personnels->primes[0]->pivot->montant_prime);
        //(array('id','post', 'nom','prenom','cin','cf','nbEnfant','dateNaissance' ,'dateEntree','typeDeContrat_id','dateDeFinDuContrat','NumCnss'));
        // $typeCont= \App\TypeContrat::where('id', $personnels->typeDeContrat_id)->get()->pluck('typeDeContrat');
        // $typeCont=TypeContrat::where( $personnels->typeDeContrat_id,'=','id');
        //   dd($personnels);
        // dd($personnels->getAttributes());
        return view('personnel/index', compact('personnels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $typedecontrat = TypeContrat::lists('type_de_contrat', 'id')->toArray();

        return view('personnel/create', compact('typedecontrat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());->input('name');
        $date_de_fin_du_contrat_request = $request->input('date_de_fin_du_contrat');

        $date_de_fin_du_contrat_request = $date_de_fin_du_contrat_request == '' ? '00/00/0000' : $request->input(
            'date_de_fin_du_contrat'
        );
        // remplace le valuer date_fin_du_contrat par la valuer date_de_fin_du_contrat_request
        $request->merge(array('date_de_fin_du_contrat' => $date_de_fin_du_contrat_request));
        // dd($request->all());
        $personnel = Personnels::create($request->all());

        $journalPaie = new JournalPaieCoutTotal ();
        $journalIrpp = new JournalPaieIrpp ();
        $conge = new Conges();
        $cnss = new Cnss();
        /******************************************************CALCUL IRPP  **************************************/
        // CALCUL Salaier Brut
        $SB = $journalPaie->salaire_brut = $this->getSalaireBrut(($request->nb_jour), ($request->salaire_du_jour));

        // CALCUL Retenue CNSS
        $RCNSS = $journalPaie->retenu_cnss = $this->getRetenueCNSS($SB);
        $cnss->retenue_cnss = $RCNSS;
        $chargePatronal = $this->getChargePatronal($SB);
        $journalPaie->charage_patronal = $chargePatronal;
        $cnss->charge_patronale = $chargePatronal;
        // Cacule Accident de travail
        $accidentTravail = $this->getAccidentTravail($SB);
        $cnss->accident_de_travail = $accidentTravail;

        // Calcul Total cnss
        $totaCnss = $this->getTotalCNSS($RCNSS, $chargePatronal, $accidentTravail);
        $cnss->cout_total_mensuel = $totaCnss;
        $cnss->cout_total_trimestriel = ($totaCnss / 4);
        // Cacule Salaire imposable 1
        $SIMP1 = $this->getSIMP1($SB, $RCNSS);

        // CALCUL Abattement
        $Abattement = $this->getAbattement($SIMP1);
        $journalIrpp->abttement = $Abattement;

        // ******************Cacule Déduction************************
        $DEDUCTION = 0;
        $cf = $personnel->cf;
        $nbenfant = ($personnel->nb_enfant);

        $DEDUCTION = $this->getSituation($cf, $nbenfant);
        $journalIrpp->deduction = $DEDUCTION;
        //*************************************************************
        // CALCUL Salaire imposable 2
        $SIMP2 = $this->getSIMP2($SIMP1, $Abattement, $DEDUCTION);
        $SIMP2 = ceil($SIMP2);
        $journalIrpp->salaire_impossable_2 = $SIMP2;
        // CALCUL Totaux
        $toteaux = $this->getTotaux($SIMP2);

        //CALCUL IRPP
        $irpp = $toteaux;
        $journalPaie->retenue_irpp = $irpp;
        $journalIrpp->irrp_annuel = $irpp;
        $journalIrpp->irrp_mensuel = ($irpp / NOMBERDUMOIS);
        //Salaire Imposable
        $SIMPFinal = $SB - $RCNSS;
        $journalPaie->salaier_imposable = $SIMPFinal;
        $journalIrpp->salaire_impossable = ($SIMPFinal / NOMBERDUMOIS);
        $journalIrpp->salaire_impossable_annuel = $SIMPFinal;
        //Salaire Net
        $salaierNet = $journalPaie->salaier_net = ($SB - ($RCNSS + $irpp));
        //CALCUL TFP
        $tfp = $journalPaie->tfp = $this->getTfp($SB);
        //CALCUL foprolos
        $foprolos = $journalPaie->foprolos = $this->getFoprolos($SB);
        // Sauvegarde les donnes dans la table journal_paie_cout_totals
        $journalCoutTotals = $journalPaie->Personnels()->associate($personnel);
        $journalCoutTotals->save();

        // Sauvegarde les donnes dans la table journal_paie_irpps
        $journalIrpp = $journalIrpp->Personnels()->associate($personnel);
        $journalIrpp->save();

        // Sauvegarde les donnes dans la table cnss
        $cnssSave = $cnss->Personnels()->associate($personnel);
        $cnssSave->save();
        // Sauvegarde  les conges
        $congeSave = $conge->Personnels()->associate($personnel);

        $date_entree = $personnel->getOriginal('date_entree');
        $mDate = Carbon::parse($date_entree);
        $diff = $mDate->diffInMonths();

        $congeSave->nb_jour_conges = $diff * COEFFICIENT_NB_CONGEE;
        $congeSave->date_demande_conge = ($mDate);
        $congeSave->save();

        return redirect(route('personnel.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personnels = Personnels::findOrFail($id);

        if (is_null($personnels)) {
            abort(404);
        }

        return view(
            'personnel.show',
            compact('personnels')
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personnel = Personnels::findOrFail($id);

        $typedecontrat = TypeContrat::lists('type_de_contrat', 'id')->toArray();

        return view('personnel.edit', compact('personnel', 'typedecontrat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // infomation personnel
        $personnel = Personnels::findOrFail($id);
       //Information journal paie
        $jpct = JournalPaieCoutTotal::where('personnels_id',$id)->first();
        $RCNSS=$jpct->getOriginal('retenu_cnss');
        //
        $irrp=JournalPaieIrpp::where('personnels_id',$id)->first();
        $SB=$jpct->getOriginal('salaire_brut');
        $Abattement=$irrp->getOriginal('abttement');

        $SIMP1=$irrp->salaire_impossable_annuel;

        // CALCUL Salaire imposable 2
        $DEDUCTION = $this->getSituation($request->cf, $request->nb_enfant);
        $SIMP2 = $this->getSIMP2($SIMP1, $Abattement, $DEDUCTION);

        $SIMP2 = ceil($SIMP2);

        // CALCUL Totaux
        $toteaux = $this->getTotaux($SIMP2);

        //CALCUL IRPP
        $irpp = $toteaux;
// Calcule salaiernet
        $salaierNet = ($SB - ($RCNSS + $irpp));



        //  update IRRP
        $updateJournalIrpp = array(

            'deduction' => $DEDUCTION,
            'salaire_impossable_2' => $SIMP2,
            'irrp_annuel' => $irpp,
            'irrp_mensuel' => ($irpp / NOMBERDUMOIS),

        );
       // Misse Ajour Déduction
        JournalPaieIrpp::where('personnels_id', '=', $id)
            ->update($updateJournalIrpp);
        // updateCoutTotal
        $updateJournalPaie = array(

            'retenue_irpp' => $irpp,
            'salaier_net' => $salaierNet,

        );
        JournalPaieCoutTotal::where('personnels_id', '=', $id)
            ->update($updateJournalPaie);

        $personnel->update($request->all());
        $date_entree = $personnel->getOriginal('date_entree');
        $mDate = Carbon::parse($date_entree);
        $diff = $mDate->diffInMonths();


        $updateConges = array(
            'nb_jour_conges' => $diff * COEFFICIENT_NB_CONGEE,

        );

        Conges::where('id', '=', $id)
            ->update($updateConges);

        return redirect('personnel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $personnel = Personnels::findOrFail($id);

        return view('personnel.delete', compact('personnel'));
    }

    public function supprimerPersonnel($id)
    {
        $personnel = Personnels::findOrFail($id);
        $personnel->deleted_at = 1;
        $personnel->save();

        return redirect('personnel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    /*******************************Function Calculate***************************/

    //Calcule Salaire Brut
    public function getSalaireBrut($NJ, $SJ, $sommePrime = 0)
    {

        return ((($NJ * $SJ) * NOMBERDUMOIS) + ($sommePrime * NOMBERDUMOIS));
    }

    //Calcule Retenue CNSS
    public function getRetenueCNSS($SB, $sommeExnereeCnss = 0)
    {

        return ((($SB - $sommeExnereeCnss * NOMBERDUMOIS) * (COEFFICIENT_RETENUE_CNSS)));
    }

    //Calcule Retenue Charge Patronal
    public function getChargePatronal($SB)
    {

        return $SB * (COEFFICIENT_CHARGE_PATRONAl);
    }

    //Calcule Abattement
    public function getAbattement($SIMP1)
    {
        return $SIMP1 * DEDUCTIONFIX;

    }

    //Calcule Salaire  Imposable 2
    public function getSIMP2($RIRPP, $Abattement, $DEDUCTION)
    {
        return $RIRPP - ($Abattement + $DEDUCTION);

    }

    //Calcule Salaire imposable 1
    public function getSIMP1($SB, $RCNSS)
    {
        return (($SB - $RCNSS));
    }

    public function getEnAnnuel($valMensuel)
    {
        return ($valMensuel * NOMBERDUMOIS);
    }
    // Calcule Totaux
    /****************************************************************************/
    public function getTotaux($SIMP2)
    {
        $totaux = 0;

        if ($SIMP2 > 1500) {
            $totaux = (1500 - 0) * 0;
        } else {
            $totaux = ($SIMP2 - 0) * 0;

            return $totaux;
        }

        if ($SIMP2 > 5000) {
            $totaux += (5000 - 1500) * 0.15;
        } else {
            $totaux += ($SIMP2 - 1500) * 0.15;

            return $totaux;
        }

        if ($SIMP2 > 10000) {
            $totaux += (10000 - 5000) * 0.2;
        } else {
            $totaux += ($SIMP2 - 5000) * 0.2;

            return $totaux;
        }

        if ($SIMP2 > 20000) {
            $totaux += (20000 - 10000) * 0.25;
        } else {
            $totaux += ($SIMP2 - 10000) * 0.25;

            return $totaux;
        }

        if ($SIMP2 > 50000) {
            $totaux += (50000 - 20000) * 0.3;
        } else {
            $totaux += ($SIMP2 - 20000) * 0.3;

            return $totaux;
        }

        if ($SIMP2 > 50001) {
            $totaux += ($SIMP2 - 50000) * 0.35;

            return $totaux;
        }

    }


    /****************************************************************************/
    public function getSituation($cf, $nbenfant)
    {
        $DEDUCTION = 0;
        if ($cf == 0) {
            return $DEDUCTION;
        } else {
            if ($cf == 1) {
                $DEDUCTION = 150;
                switch ($nbenfant):
                    case 0:
                        return $DEDUCTION;
                        break;
                    case 1:
                        return $DEDUCTION + DEDUCTION_NB_ENFANTS_1;
                        break;
                    case 2:
                        return $DEDUCTION + DEDUCTION_NB_ENFANTS_2;
                        break;
                    case 3:
                        return $DEDUCTION + DEDUCTION_NB_ENFANTS_3;
                        break;
                    case 4:
                        return $DEDUCTION + DEDUCTION_NB_ENFANTS_4;
                        break;
                    default:
                        return $DEDUCTION;
                        break;
                endswitch;

            }
        }

    }

    /*******************************************************************************************/
    public function getTfp($SB)
    {
        return $SB * COEFFICIENT_TFP;
    }

    /*******************************************************************************************/
    public function getFoprolos($SB)
    {
        return $SB * COEFFICIENT_FOPROLOS;
    }

    /*********************************Accident de Travail**********************************************************/
    public function getAccidentTravail($SB)
    {
        return ($SB * COEFFICIENT_ACCIDENT_TRAVAIL);
    }

    /*********************************Total CNSS*********************************************************/
    public function getTotalCNSS($RCNSS, $chargePatronal, $accidentTravail)
    {
        return ($RCNSS + $chargePatronal + $accidentTravail);
    }

    /**********************************salaier brut**************************************************************/


    public function calculeSalaire(Request $request)
    {   //varaible somme de prime
        $sommePrime = 0;
        $sommeExnereeCnss = 0;
        $k = 0;
        $order_primes=rand(0, 9999999) ;
        $mecnss = [];

        $personel_id = (Input::get('personnel_id'));
        $salaire_du_jour = (Input::get('salaire_du_jour'));
        $prime_id = (Input::get('prime_id'));
        $montant_prime = (Input::get('montant_prime'));
        $montant_prime_exoneree = (Input::get('montant_prime_exoneree'));

        /**********************get Data from personnel ****************************************/
        $personnels = Personnels::find(1)->where('id', '=', $personel_id)->get();

        foreach ($personnels as $personnel) {
            $cf = $personnel->cf;
            $nbenfant = $personnel->nbenfant;
        }

        /*********************************************************/
        if (!empty($montant_prime_exoneree)) {
            foreach ($montant_prime_exoneree as $value) {
                $mecnss[$k] = $value;

                $k++;
            }
        }

        // caclcule la somme des primes exnorée
        for ($i = 0; $i < sizeof($montant_prime); $i++) {

            Personnels::find($personel_id)->primes()->attach(
                $prime_id[$i],
                ['montant_prime' => $montant_prime [$i],
                    'exoneree' => $mecnss[$i],
                    'prime_order'=>$order_primes
                ]
            );
            if ($mecnss[$i] != -1) {
                $sommeExnereeCnss += $montant_prime [$i];
            }
            $sommePrime += $montant_prime [$i];
        }

        $journalPaie = new JournalPaieCoutTotal ();
        $journalIrpp = new JournalPaieIrpp ();
        $cnss = new Cnss();
        // ************************************* CALCUL Salaier Brut  *************************************************//
        $SB = $this->getSalaireBrut(($request->nb_jour), ($request->salaire_du_jour), $sommePrime);


        // ************************************* CALCUL Retenue CNSS  *************************************************//
        $RCNSS = ($this->getRetenueCNSS($SB, $sommeExnereeCnss));

        //**************************************************************************************************************//

        //**************************************************Salaire Imposable************************************************************//

        $SIMPFinal = ($SB - $RCNSS) + ($sommeExnereeCnss * NOMBERDUMOIS);

        //**************************************************************************************************************//
        // Cacule Salaire imposable 1
        $SIMP1 = $this->getSIMP1($SB, $RCNSS) + ($sommeExnereeCnss * NOMBERDUMOIS);

        // CALCUL Abattement
        $Abattement = $this->getAbattement($SIMP1);
        // CALCUL Salaire imposable 2
        $DEDUCTION = $this->getSituation($cf, $nbenfant);
        $SIMP2 = $this->getSIMP2($SIMP1, $Abattement, $DEDUCTION);
        $SIMP2 = ceil($SIMP2);

        // CALCUL Totaux
        $toteaux = $this->getTotaux($SIMP2);

        //CALCUL IRPP
        $irpp = $toteaux;
        $salaierNet = ($SB - ($RCNSS + $irpp));

        //**************************************************************************************************************//

        //************************************************Charge Patronam*************************************************//
        $chargePatronal = $this->getChargePatronal($SB);
        //**************************************************************************************************************//

        //************************************************ CALCUL TFP*************************************************//

        $tfp = $this->getTfp($SB);
        //**************************************************************************************************************//

        //************************************************CALCUL foprolos*************************************************//
        $foprolos = $journalPaie->foprolos = $this->getFoprolos($SB);
        //**************************************************************************************************************//

        //************************************************CALCUL Cout Total Journal de paie ****************************//
        $coutTotalJournalPaies = $SB + $chargePatronal + $tfp + $foprolos;
        //**************************************************************************************************************//


        /********************** CNSS : Accident de travail********************************************************/
        $accidentTravail = $this->getAccidentTravail($SB);
        // Calcul Total cnss
        $totaCnss = $this->getTotalCNSS($RCNSS, $chargePatronal, $accidentTravail);
        //*******************************************Salaier Net****************************************************************//


        $updateJournalPaie = array(
            'salaire_brut' => $SB,
            'retenu_cnss' => $RCNSS,
            'salaier_imposable' => $SIMPFinal,
            'retenue_irpp' => $irpp,
            'salaier_net' => $salaierNet,
            'charage_patronal' => $chargePatronal,
            'tfp' => $tfp,
            'foprolos' => $foprolos,
            'cout_total' => $coutTotalJournalPaies,
        );

        $updateJournalIrpp = array(
            'salaire_impossable' => ($SIMPFinal),
            'salaire_impossable_annuel' => $SIMPFinal,
            'abttement' => $Abattement,
            'deduction' => $DEDUCTION,
            'salaire_impossable_2' => $SIMP2,
            'irrp_annuel' => $irpp,
            'irrp_mensuel' => ($irpp / NOMBERDUMOIS),
        );

        $updateCnss = array(
            'retenue_cnss' => $RCNSS,
            'charge_patronale' => $chargePatronal,
            'accident_de_travail' => $accidentTravail,
            'cout_total_mensuel' => $totaCnss,
            'cout_total_trimestriel' => ($totaCnss / 4),

        );


        JournalPaieCoutTotal::where('id', '=', $personel_id)
            ->update($updateJournalPaie);

        JournalPaieIrpp::where('id', '=', $personel_id)
            ->update($updateJournalIrpp);

        Cnss::where('id', '=', $personel_id)
            ->update($updateCnss);

        //************************************************** update personnel
        $nb_jour = (Input::get('nb_jour'));
        $sb = $this->getSalaireBrut($salaire_du_jour, $nb_jour);
        $salaier = array('nb_jour' => $nb_jour,
                         'paiement_par'=>$request->paiement_par,
                         'avance'=>$request->avance,
                         'salaire_du_jour' => $salaire_du_jour,
                         'nomber_jour'=>$request->nb_jour,
                         'salaire_jour'=>$request->salaire_du_jour,
                          'prime'=>$order_primes
        );
        $pesonnel =
            Personnels::where('id', '=', $personel_id)
                ->update($salaier);
        $request->session()->flash('alert-success', 'Salaire brut était calculer !');

        return redirect("salaire");

    }

    public function salaire()
    {
        /*
         * Récupérer listes des personnels nom et prenom concaténée a traver la fonction getFullNameAttribute dans Model
         * Personnels et le id pour generais le balise select
         */
        $prime = Prime::all()->lists('description', 'id')->toArray();
        $personnels = (['aucunpersonnel' => '------'] + Personnels::where('deleted_at', '0')->get()->lists('full_name', 'id')->toArray());

        return view('salaire.index', compact('personnels', 'prime'));
    }
}
