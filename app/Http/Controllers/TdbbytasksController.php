<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Report;
use App\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TdbbytasksController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
  	$collabs = DB::table('users')->get();
  	$clients = DB::table('clients')->get();
    return view('tdb.bytask.tdbbytasks',compact('collabs','clients'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function getGraphTask($contratid, $annee)
  {

    $contrats = DB::table('contrats')
      ->where('contrats.id', '=', $contratid)
      ->select('contrats.demarrage', 'contrats.base_sem', 'contrats.nb_mois')
      ->get();
    $demarrage = $contrats[0]->demarrage;
    $base_sem = $contrats[0]->base_sem;
    $nb_mois = $contrats[0]->nb_mois;


    if(strlen($annee)>5){
        $annee_deb = substr($annee, 0, 4);
        $annee_fin = substr($annee, -4, 4);
        $date_deb =  $annee_deb."/".date("m", strtotime($demarrage))."/".date("d", strtotime($demarrage));
        $date_fin =  $annee_fin."/".date("m", strtotime($demarrage))."/".date("d", strtotime($demarrage));
        }
    else{
        $annee_deb = $annee;
        $annee_fin = $annee+1;
        $date_deb =  $annee_deb."/".date("m", strtotime($demarrage))."/".date("d", strtotime($demarrage));
        $date_fin =  $annee_fin."/".date("m", strtotime($demarrage))."/".date("d", strtotime($demarrage));
        }

    
    $tdbtask = DB::select( DB::raw("SELECT  D.ANNEE,(SELECT mois.nom_court FROM mois WHERE mois.id = D.MOIS) AS mois, ADM_SYS, MAINTENANCE, GEST_PARC, ETUDE_PRIX, INSTALL, ASSISTANCE, FORMATION, PROJET, DEVELOPPEMENT, REUNION, DEPLACEMENT, CONTROLE, AUTRE
            FROM (SELECT MONTH(calendrier.Jour) AS MOIS, Year(calendrier.Jour) AS ANNEE
            FROM calendrier 
            WHERE ((calendrier.Jour) BETWEEN '$date_deb' AND '$date_fin') 
            GROUP BY Month(calendrier.Jour), Year(calendrier.Jour) 
            ORDER BY Year(calendrier.Jour), MONTH(calendrier.Jour) ASC)  AS D LEFT JOIN (SELECT MONTH(reports.Jour) AS MOIS, Year(reports.Jour) AS ANNEE, If(isnull(Sum(reports.TPS_ADM)),0,Sum(reports.TPS_ADM)) AS ADM_SYS, If(isnull(Sum(reports.TPS_MAINT)),0,Sum(reports.TPS_MAINT)) AS MAINTENANCE, If(isnull(Sum(reports.TPS_PARC)),0,Sum(reports.TPS_PARC)) AS GEST_PARC, If(isnull(Sum(reports.TPS_PRIX)),0,Sum(reports.TPS_PRIX)) AS ETUDE_PRIX, If(isnull(Sum(reports.TPS_INST)),0,Sum(reports.TPS_INST)) AS INSTALL, If(isnull(Sum(reports.TPS_ASSIST)),0,Sum(reports.TPS_ASSIST)) AS ASSISTANCE, If(isnull(Sum(reports.TPS_FORM)),0,Sum(reports.TPS_FORM)) AS FORMATION, If(isnull(Sum(reports.TPS_PROJ)),0,Sum(reports.TPS_PROJ)) AS PROJET, If(isnull(Sum(reports.TPS_DEV)),0,Sum(reports.TPS_DEV)) AS DEVELOPPEMENT, If(isnull(Sum(reports.TPS_REUNION)),0,Sum(reports.TPS_REUNION)) AS REUNION, If(isnull(Sum(reports.TPS_DEP)),0,Sum(reports.TPS_DEP)) AS DEPLACEMENT, If(isnull(Sum(reports.TPS_CTRL)),0,Sum(reports.TPS_CTRL)) AS CONTROLE, If(isnull(Sum(reports.TPS_AUTRE)),0,Sum(reports.TPS_AUTRE)) AS AUTRE
            FROM (clients INNER JOIN contrats ON clients.Id = contrats.id_client) INNER JOIN (users INNER JOIN (contrat_collaborateur INNER JOIN reports ON contrat_collaborateur.id = reports.id_affect) ON users.id = contrat_collaborateur.id_collab) ON contrats.id = contrat_collaborateur.id_contrat
            WHERE (((contrats.id)=$contratid) AND ((reports.Jour) BETWEEN '$date_deb' AND '$date_fin'))
            GROUP BY Month(reports.Jour), Year(reports.Jour))  AS N ON (D.ANNEE=N.ANNEE) AND (D.MOIS=N.MOIS)
            ORDER BY D.ANNEE, D.MOIS"));

    $tdbtasktotal = DB::select( DB::raw("SELECT  sum(tps_adm) AS ADM_SYS, sum(tps_maint) AS MAINTENANCE, sum(tps_parc) AS GEST_PARC, sum(tps_prix) AS ETUDE_PRIX, sum(tps_inst) AS INSTALL, sum(tps_assist) AS ASSISTANCE, sum(tps_form) AS FORMATION, sum(tps_proj) AS PROJET, sum(tps_dev) AS DEVELOPPEMENT, sum(tps_reunion) AS REUNION, sum(tps_dep) AS DEPLACEMENT, sum(tps_ctrl) AS CONTROLE, sum(tps_autre) AS AUTRE
            FROM (clients INNER JOIN contrats ON clients.Id = contrats.id_client) INNER JOIN (users INNER JOIN (contrat_collaborateur INNER JOIN reports ON contrat_collaborateur.id = reports.id_affect) ON users.id = contrat_collaborateur.id_collab) ON contrats.id = contrat_collaborateur.id_contrat
            WHERE (((contrats.id)=$contratid) AND ((reports.Jour) BETWEEN '$date_deb' AND '$date_fin'))"));
    
    //dd($tdbtasktotal);
    return view('tdb.bytask.graphtask', compact('tdbtask', 'tdbtasktotal'));
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    
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
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}
