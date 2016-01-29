<?php

namespace App\Http\Controllers;

use App\Conges;
use App\ListesDemandsConges;
use App\Personnels;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

// Nomber de jour de Conges
define("COEFFICIENT_NB_CONGEE_", 2);

class CongesController extends Controller
{
    /**
     * Display a listing of the resource.
     *           $date_entree=  $conge->getOriginal('date_entree') ;
     * $mDate = Carbon::parse($date_entree);
     * echo  $mDate->diffInMonths().'<br>';
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conges = Personnels::where('deleted_at', '=', 0)->with('conges')->get();


        foreach ($conges as $conge) {

            $date_entree = $conge->getOriginal('date_entree');
            $mDate = Carbon::parse($date_entree);
            $diff = $mDate->diffInMonths();
            $nb_jour_conges = $diff * COEFFICIENT_NB_CONGEE_;
            $nb_jour_de_conge_reste = $nb_jour_conges - $conge->conges->somme_conge_demander;
            $updateConges = array(
                'nb_jour_conges' => $nb_jour_conges,
                'nb_jour_de_conge_reste' => $nb_jour_de_conge_reste,
            );
            Conges::where('personnels_id', $conge->id)
                ->update($updateConges);

        }
        $conges = Personnels::where('deleted_at', '=', 0)->with('conges')->get();

        return view('conge/index', compact('conges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (!(ListesDemandsConges::get()->isEmpty())) {
            $Listconges = ListesDemandsConges::where('personnel_id', $id)
                ->orderBy('created_at', 'asc')
                ->get();


        } else {

            $Listconges = ListesDemandsConges::get();

        }

        return view('conge/show', compact('Listconges'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $conge = Personnels::where('deleted_at', '=', 0)->with('conges')->findOrFail($id);

        return view('conge/create', compact('conge'));
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
        $conge = Personnels::where('deleted_at', '=', 0)->with('conges')->findOrFail($id);


        $nbjourTotal = ($conge->conges->nb_jour_conges);
        $nb_jouer_conge_demander = $request->nb_jouer_conge_demander;
        $date_de_debut_conge = $request->date_de_debut_conge;
        $date_de_fin_conge = $request->date_de_fin_conge;
        $description = $request->description;


        $listPersonnel = ListesDemandsConges::where('personnel_id', $conge->id)->get();

        if ($listPersonnel->isEmpty()) {
            // Si personnel not exite in tab listes_demandes_conges
            $nb_jour_de_conge_reste = $nbjourTotal - $nb_jouer_conge_demander;
            $somme_conge_demander = $nb_jouer_conge_demander;
            $nb_jour_de_conge_obtenu = $nb_jouer_conge_demander;

        } else {
            // Si un personnal a déja demander un conge
            foreach ($listPersonnel as $lis) {
                $somme_conge_demander = +$lis->somme_conge_demander;
            }
            $somme_conge_demander = $somme_conge_demander + $nb_jouer_conge_demander;
            $nb_jour_de_conge_reste = $nbjourTotal - $somme_conge_demander;
            $nb_jour_de_conge_obtenu = $somme_conge_demander;


        }
        $arrayList = [
            'nom' => $conge->nom,
            'prenom' => $conge->prenom,
            'personnel_id' => $conge->id,
            'date_de_debut_conge' => $date_de_debut_conge,
            'date_de_fin_conge' => $date_de_fin_conge,
            'nb_jouer_conge_demander' => $nb_jouer_conge_demander,
            'nb_jouer_conge_demander' => $nb_jouer_conge_demander,
            'somme_conge_demander' => $somme_conge_demander,
            'nb_jour_de_conge_obtenu' => $nb_jour_de_conge_obtenu,
            'nb_jour_de_conge_reste' => $nb_jour_de_conge_reste,
            'description' => $description,


        ];
        $updateConges = array(
            'somme_conge_demander' => $somme_conge_demander,
            'nb_jour_de_conge_obtenu' => $nb_jour_de_conge_obtenu,
            'nb_jour_de_conge_reste' => $nb_jour_de_conge_reste,
        );
        Conges::where('personnels_id', $conge->id)
            ->update($updateConges);
        $list = ListesDemandsConges::create($arrayList);

        return redirect(route('conges.index'));
    }

    public function updateCongee(Request $request, $id)
    {
        //  $conge = Personnels::where('deleted_at', '=', 0)->with('conges')->findOrFail($id);
        $conge = ListesDemandsConges::where('id', $id)->first();


        return view('conge/edit', compact('conge'));

    }

    public function updateCongePersonnell(Request $request,$id)
    {
        $congeList = ListesDemandsConges::where('id', $id)->first();
        $personnels = Personnels::where('deleted_at', '=', 0)->with('conges')->findOrFail($congeList->personnel_id);
        $AllNbJour=($personnels->conges->nb_jour_conges);
        $AllNbJourReste=($personnels->conges->nb_jour_de_conge_reste);
        $Allsomme_conge_demander=($personnels->conges->somme_conge_demander);

        $TempsNbCongeObtenu=($congeList->nb_jour_de_conge_obtenu);

        $currentNomberDeJourDemander=($congeList->nb_jouer_conge_demander);

        $TempsSommeJourCongee=$Allsomme_conge_demander+$AllNbJourReste;

        $new_nb_jour_de_conge_reste=$TempsSommeJourCongee-$request->nb_jouer_conge_demander;



        $newSommeCongee=$AllNbJour- $new_nb_jour_de_conge_reste;


        $updateListsConges = array(
            'date_de_debut_conge' => $request->date_de_debut_conge,
            'date_de_fin_conge' => $request->date_de_fin_conge,
            'nb_jouer_conge_demander' => $request->nb_jouer_conge_demander,
            'somme_conge_demander' => $newSommeCongee,
            'nb_jour_de_conge_obtenu' => $currentNomberDeJourDemander,
            'nb_jour_de_conge_reste' => $new_nb_jour_de_conge_reste,
            'description' =>$request->description,
        );
        ListesDemandsConges::where('id', $id)
            ->update($updateListsConges);
        $congeLists = ListesDemandsConges::where('personnel_id', $congeList->personnel_id)->get();
        $newSommeCongeeAll=0;
        foreach ($congeLists as $congelist) {
            $newSommeCongeeAll+=$congelist->nb_jouer_conge_demander;
        }

        $updateConges = array(
            'somme_conge_demander' => $newSommeCongeeAll,
            'nb_jour_de_conge_obtenu' => $newSommeCongee,
            'nb_jour_de_conge_reste' => $AllNbJour-$newSommeCongeeAll,
        );
        Conges::where('personnels_id', $congeList->personnel_id)
            ->update($updateConges);

        return redirect('conges/'. $congeList->personnel_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
