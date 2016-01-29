<?php

namespace App\Http\Controllers;

use App\Personnels;
use App\Prime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

//Nombre du Mois
define("NOMBERDUMOIS", 12);

class PrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $primes = Prime::get();


        return view('prime/index', compact('primes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prime/create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $primes = Prime::create($request->all());

        return redirect(route('primes.index'));
        /*
         *
         *    $personel_id=( Input::get('personnel_id'));
          $salaire_du_jour=( Input::get('salaire_du_jour'));
           $nb_jour=( Input::get('nb_jour'));
           $sb=$this->getSalaireBrut($salaire_du_jour,$nb_jour);
          $salaier=array('nb_jour' => $nb_jour,'salaire_du_jour' => $salaire_du_jour);
          $pesonnel=
              Personnels::where('id', '=', $personel_id)
              ->update($salaier);
            dd($pesonnel);
         */


    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prime = Prime::findOrFail($id);

        $prime->delete();


        return redirect(route('primes.index'));
    }

    /*******************************Function Calculate***************************/

    //Calcule Salaire Brut
    public function getSalaireBrut($NJ, $SJ)
    {

        return (($NJ * $SJ) * NOMBERDUMOIS);
    }
}
