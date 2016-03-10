<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Contrat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class ContratController extends Controller {

  public function __construct()
    {
        $this->middleware('auth');
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $contrats = DB::table('contrats')
      ->join('clients','clients.id','=','contrats.id_client')
      ->select('contrats.id','contrats.numero','contrats.description',DB::raw('DATE_FORMAT(contrats.demarrage, "%d %M %Y") as demarrage'),'clients.nom')
      ->get();
    $departements = DB::table('departements')->orderBy('num', 'asc')->get();
    $regions = DB::table('regions')->orderBy('region', 'asc')->get();
    $clients = DB::table('clients')->orderBy('nom','asc')->get();
    return view('admin.contrats.contrats', compact('contrats','departements','regions','clients')); 
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getByClientCollab($idclient,$idcollab)
  {
    $cont = DB::table('contrats')
      ->join('contrat_collaborateur','contrat_collaborateur.id_contrat','=','contrats.id')
      ->where('contrats.id_client', '=', $idclient)
      ->where('contrat_collaborateur.id_collab', '=', $idcollab)
      ->orderBy('description', 'asc')
      ->select('contrats.id','contrats.description')
      ->get();
    
    return json_encode($cont);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getAnneeContrat($idcontrat)
  {
    $contrats = DB::table('contrats')
      ->where('contrats.id', '=', $idcontrat)
      ->select('contrats.demarrage', 'contrats.base_sem', 'contrats.nb_mois')
      ->get();
    $demarrage = $contrats[0]->demarrage;
    $base_sem = $contrats[0]->base_sem;
    $nb_mois = $contrats[0]->nb_mois;
    $annee_dem = intval(date("Y", strtotime($demarrage)));
    $mois_dem = intval(date("m", strtotime($demarrage)));

    $mois_courant = intval(date("m"));

    //si le mois de démarrage est janvier
    if($mois_dem == 1){
        $j=0;
        for($i=date("Y");$i>=$annee_dem;$i--){
            $annees[$j]=$i;
            $j++;
        }
    }
    //si le mois de démarrage est sup. au mois courant (annee N-1 et N)
    elseif($mois_dem > $mois_courant){
        if($nb_mois <> 12){
            $j=0;
            if(($mois_dem+$nb_mois) <= 13){
                for($i=date("Y");$i>=$annee_dem;$i--){
                    $annees[$j]=$i;
                    $j++;
                }
            }
            else{
                for($i=date("Y");$i>=$annee_dem;$i--){
                    $annees[$j]=($i-1)."-".$i;
                    $j++;
                }
            } 
        }
        else{
            $j=0;
            for($i=date("Y");$i>=$annee_dem;$i--){
                $annees[$j]=($i-1)."-".$i;
                $j++;
            } 
        }
    }
    //si le mois de démarrage est inf. au mois courant (annee N et N+1)
    else {
        if($nb_mois <> 12){
            $j=0;
            if(($mois_dem+$nb_mois) <= 13){

                for($i=date("Y");$i>=$annee_dem;$i--){
                    $annees[$j]=$i;
                    $j++;
                }
            }
            else{
                for($i=date("Y");$i>=$annee_dem;$i--){
                    $annees[$j]=$i."-".($i+1);
                    $j++;
                }
            }
        }
        else{
            $j=0;
            for($i=date("Y");$i>=$annee_dem;$i--){
                $annees[$j]=$i."-".($i+1);
                $j++;
            } 
        }
    }
    
  return json_encode($annees);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getByClient($idclient)
  {
    $contrats = DB::table('contrats')
      ->join('clients','clients.id','=','id_client')
      ->where('contrats.id_client', '=', $idclient)
      ->select('contrats.id','contrats.numero','contrats.description',DB::raw('DATE_FORMAT(contrats.demarrage, "%d %M %Y") as demarrage'),'clients.nom')
      ->orderBy('description', 'asc')
      ->get();
    return view('admin.contrats.listcontrats', compact('contrats','departements','regions'));
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getByRegion($idregion)
  {
      $contrats = DB::table('contrats')
        ->select('contrats.id','contrats.numero','contrats.description',DB::raw('DATE_FORMAT(contrats.demarrage, "%d %M %Y") as demarrage'),'clients.nom')
        ->join('clients','clients.id','=','id_client')
        ->join('departements', 'departements.id', '=', 'clients.id_dep')
        ->join('regions', 'regions.id', '=', 'departements.id_region')
        ->where('regions.id','=',$idregion)
        ->get();
      $departements = DB::table('departements')->orderBy('num', 'asc')->get();
      $regions = DB::table('regions')->orderBy('region', 'asc')->get();
      return view('admin.contrats.listcontrats', compact('contrats','departements','regions'));    
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getByDep($iddep)
  {
      $contrats = DB::table('contrats')
        ->select('contrats.id','contrats.numero','contrats.description',DB::raw('DATE_FORMAT(contrats.demarrage, "%d %M %Y") as demarrage'),'clients.nom')
        ->join('clients','clients.id','=','id_client')
        ->where('id_dep','=',$iddep)
        ->get();
      $departements = DB::table('departements')->orderBy('num', 'asc')->get();
      $regions = DB::table('regions')->orderBy('region', 'asc')->get();
      return view('admin.contrats.listcontrats', compact('contrats','departements','regions'));    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $clients = DB::table('clients')->orderBy('nom', 'asc')->get();
    return view('admin.contrats.createcontrats', compact('clients'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(request $request)
  {
    $contrat = new contrat();
    $contrat->description = $request->description;
    $contrat->numero = $request->numero;
    $contrat->volume = $request->volume;
    $contrat->signature = date("Y-m-d", strtotime(str_replace('/', '-', $request->signature)));
    $contrat->demarrage = date("Y-m-d", strtotime(str_replace('/', '-', $request->demarrage)));
    if (date("Y-m-d", strtotime(str_replace('/', '-', $request->date_fin_mission))) == '1970-01-01'){
      $contrat->date_fin_mission = null;
    }
    else{
      $contrat->date_fin_mission = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_fin_mission)));
    }
    $contrat->preavis = $request->preavis;
    $contrat->base_sem = $request->base_sem;
    $contrat->nb_mois = $request->nb_mois;
    $contrat->id_client = $request->cli;
    // dd($contrat);
    $contrat->save();
    return redirect(route('contrat.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $contrat = contrat::findOrFail($id);
    $clients = DB::table('clients')->orderBy('nom', 'asc')->get();
    // dd($contrat);
    return view('admin.contrats.editcontrats', compact('contrat','clients'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
    $contrat = contrat::findOrFail($id);
    $contrat->description = $request->description;
    $contrat->numero = $request->numero;
    $contrat->volume = $request->volume;
    $contrat->signature = date("Y-m-d", strtotime(str_replace('/', '-', $request->signature)));
    $contrat->demarrage = date("Y-m-d", strtotime(str_replace('/', '-', $request->demarrage)));
    if (date("Y-m-d", strtotime(str_replace('/', '-', $request->date_fin_mission))) == '1970-01-01'){
      $contrat->date_fin_mission = null;
    }
    else{
      $contrat->date_fin_mission = date("Y-m-d", strtotime(str_replace('/', '-', $request->date_fin_mission)));
    }
    
    $contrat->preavis = $request->preavis;
    $contrat->base_sem = $request->base_sem;
    $contrat->nb_mois = $request->nb_mois;
    $contrat->id_client = $request->cli;

    // dd($contrat);
    $contrat->save();
    return redirect(route('contrat.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $contrat = contrat::findOrFail($id);
    $contrat->delete();
    return redirect(route('contrat.index'));
  }
  
}

?>