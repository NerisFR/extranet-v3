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

class TdbbyhoursController extends Controller
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
    return view('tdb.byhours.tdbbyhours',compact('collabs','clients'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function getGraphHour($contratid, $annee)
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

    if($nb_mois < 12){
        
        $tdbhour = DB::select( DB::raw("SELECT D.ANNEE, (SELECT mois.nom_court FROM mois WHERE mois.id = D.MOIS) AS mois, (SELECT Round((contrats.volume/$nb_mois),2) FROM contrats WHERE ((contrats.id)='$contratid')) AS prevu, N.Temps_realise, N.Temps_realise-(SELECT Round((contrats.volume-contrats.volume/$base_sem*3)/10,2) FROM contrats WHERE (((contrats.id)='$contratid'))) AS ecart, (@s := @s + (N.Temps_realise-(SELECT Round((contrats.volume-contrats.volume/$base_sem*3)/10,2) FROM contrats WHERE (((contrats.id)='$contratid'))))) AS cumul
            FROM (
                SELECT MONTH(calendrier.Jour) AS MOIS, Year(calendrier.Jour) AS ANNEE
                FROM calendrier 
                WHERE ((calendrier.Jour) BETWEEN '$date_deb' AND '$date_fin') 
                GROUP BY Month(calendrier.Jour), Year(calendrier.Jour) 
                ORDER BY Year(calendrier.Jour), MONTH(calendrier.Jour) ASC) AS D 
            LEFT JOIN (
                SELECT MONTH(reports.Jour) AS MOIS, Year(reports.Jour) AS ANNEE, If(isnull(Sum(reports.TPS_TOTAL)),0,Sum(reports.TPS_TOTAL)) AS Temps_realise
                FROM (clients INNER JOIN contrats ON clients.Id = contrats.id_client) INNER JOIN (users INNER JOIN (contrat_collaborateur INNER JOIN reports ON contrat_collaborateur.id = reports.id_affect) ON users.id = contrat_collaborateur.id_collab) ON contrats.id = contrat_collaborateur.id_contrat
                WHERE (((contrats.id)='$contratid') AND ((reports.Jour) BETWEEN '$date_deb' AND '$date_fin') AND (reports.type_heure='Normale'))
                GROUP BY Month(reports.Jour), Year(reports.Jour)) AS N 
            ON (D.ANNEE=N.ANNEE) AND (D.MOIS=N.MOIS), (SELECT @s := 0) dm
            ORDER BY D.ANNEE, D.MOIS") );
    }
    else{
        $tdbhour = DB::select( DB::raw("SELECT D.ANNEE, (SELECT mois.nom_court FROM mois WHERE mois.id = D.MOIS) AS mois, (If(D.MOIS=8,'0',If(D.MOIS=12,(SELECT Round(contrats.volume/$base_sem*3,2) FROM contrats WHERE ((contrats.id)='$contratid')),(SELECT Round((contrats.volume-contrats.volume/$base_sem*3)/10,2) FROM contrats WHERE (((contrats.id)='$contratid')))))) AS prevu, N.Temps_realise, N.Temps_realise-(SELECT Round((contrats.volume-contrats.volume/$base_sem*3)/10,2) FROM contrats WHERE (((contrats.id)='$contratid'))) AS ecart, (@s := @s + (N.Temps_realise-(SELECT Round((contrats.volume-contrats.volume/$base_sem*3)/10,2) FROM contrats WHERE (((contrats.id)='$contratid'))))) AS cumul
            FROM (
                SELECT MONTH(calendrier.Jour) AS MOIS, Year(calendrier.Jour) AS ANNEE
                FROM calendrier 
                WHERE ((calendrier.Jour) BETWEEN '$date_deb' AND '$date_fin') 
                GROUP BY Month(calendrier.Jour), Year(calendrier.Jour) 
                ORDER BY Year(calendrier.Jour), MONTH(calendrier.Jour) ASC) AS D 
            LEFT JOIN (
                SELECT MONTH(reports.Jour) AS MOIS, Year(reports.Jour) AS ANNEE, If(isnull(Sum(reports.TPS_TOTAL)),0,Sum(reports.TPS_TOTAL)) AS Temps_realise
                FROM (clients INNER JOIN contrats ON clients.Id = contrats.id_client) INNER JOIN (users INNER JOIN (contrat_collaborateur INNER JOIN reports ON contrat_collaborateur.id = reports.id_affect) ON users.id = contrat_collaborateur.id_collab) ON contrats.id = contrat_collaborateur.id_contrat
                WHERE (((contrats.id)='$contratid') AND ((reports.Jour) BETWEEN '$date_deb' AND '$date_fin') AND (reports.type_heure='Normale'))
                GROUP BY Month(reports.Jour), Year(reports.Jour)) AS N 
            ON (D.ANNEE=N.ANNEE) AND (D.MOIS=N.MOIS), (SELECT @s := 0) dm
            ORDER BY D.ANNEE, D.MOIS") );
    }
    
    //dd($tdbhour);
    return view('tdb.byhours.graphhour', compact('tdbhour'));
    
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
