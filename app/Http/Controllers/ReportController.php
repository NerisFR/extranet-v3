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

class ReportController extends Controller {

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
    // user::create(['email'=>'a.loche@neris.fr','password'=>hash::make('Scirpaceus17')]);
    $datedeb = date("Y-m-d", strtotime('-3 month'));
    $datefin = date("Y-m-d");
    $user = Auth::user();
    $collabs = DB::table('users')->get();
    $clients = DB::table('clients')->get();
    $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',Auth::user()->id)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    //return view('reports.reports', compact('collabs','clients'));
    return view('reports.reports', compact('reports','collabs','clients','user'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getByCollab($idcollab,$datedeb,$datefin,$typeheure)
  {

    if ($typeheure == 'Toutes'){
      $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',$idcollab)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    }
    else{
      $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',$idcollab)
      ->where('reports.type_heure','=',$typeheure)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    }
   
    // user::create(['email'=>'a.loche@neris.fr','password'=>hash::make('Scirpaceus17')]);
    
    return view('reports.listreports', compact('reports'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getByClientCollab($idclient,$idcollab,$datedeb,$datefin,$typeheure)
  {
    if ($typeheure == 'Toutes'){
      $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',$idcollab)
      ->where('clients.id','=',$idclient)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    }
    else {
      $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',$idcollab)
      ->where('clients.id','=',$idclient)
      ->where('reports.type_heure','=',$typeheure)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    }
    
    
    return view('reports.listreports', compact('reports'));
  }

  public function getByContratCollab($idcontrat,$idcollab,$datedeb,$datefin,$typeheure)
  {
    if ($typeheure == 'Toutes'){
      $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',$idcollab)
      ->where('contrats.id','=',$idcontrat)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    }
    else {
      $reports = DB::table('reports')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id', '=', 'reports.id_affect')
      ->join('users', 'users.id', '=', 'contrat_collaborateur.id_collab')
      ->join('contrats', 'contrats.id', '=', 'contrat_collaborateur.id_contrat')
      ->join('clients', 'clients.id', '=', 'contrats.id_client')
      ->where('users.id','=',$idcollab)
      ->where('contrats.id','=',$idcontrat)
      ->where('reports.type_heure','=',$typeheure)
      ->whereBetween('jour', [$datedeb, $datefin])
      ->select('users.name', 'clients.nom', 'contrats.description','reports.tps_total','reports.type_heure','reports.jour','reports.arrivee','reports.depart','reports.commentaire','reports.id')
      ->orderby('reports.jour','desc')
      ->get();
    }
    
    return view('reports.listreports', compact('reports'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $collabs = DB::table('users')->get();
    $heures = DB::table('heures')->select('id',DB::raw('DATE_FORMAT(heures.heures, "%H:%i") as heures'))->get();
    $clients = DB::table('clients')
        ->distinct()
        ->select('clients.id','clients.nom')
        ->join('contrats', 'contrats.id_client', '=', 'clients.id')
        ->join('contrat_collaborateur', 'contrat_collaborateur.id_contrat', '=', 'contrats.id')
        ->where('contrat_collaborateur.id_collab','=',Auth::user()->id)
        ->get();
    return view('reports.createreport', compact('collabs','heures','clients'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(request $request)
  {
    $id_affect = DB::table('contrat_collaborateur')
      ->where('contrat_collaborateur.id_collab','=',$request->collab)
      ->where('contrat_collaborateur.id_contrat','=',$request->contrat)
      ->select('id')
      ->get();
    //dd($id_affect[0]->id);
    
    $report = new report();
    $report->arrivee = $request->h_debut;
    $report->depart = $request->h_fin;
    $report->jour = date("Y-m-d", strtotime(str_replace('/', '-', $request->jour)));
    $report->type_heure = $request->type_heure;
    $report->tps_total = $request->tps_adm + $request->tps_proj + $request->tps_maint + $request->tps_dev + $request->tps_parc + $request->tps_reunion + $request->tps_prix + $request->tps_dep + $request->tps_inst + $request->tps_ctrl + $request->tps_assist + $request->tps_autre + $request->tps_form;

    $report->tps_adm = $request->tps_adm;
    $report->tps_proj = $request->tps_proj;
    $report->tps_maint = $request->tps_maint;
    $report->tps_dev = $request->tps_dev;
    $report->tps_parc = $request->tps_parc;
    $report->tps_reunion = $request->tps_reunion;
    $report->tps_prix = $request->tps_prix;
    $report->tps_dep = $request->tps_dep;
    $report->tps_inst = $request->tps_inst;
    $report->tps_ctrl = $request->tps_ctrl;
    $report->tps_assist = $request->tps_assist;
    $report->tps_autre = $request->tps_autre;
    $report->tps_form = $request->tps_form;
    $report->ctrl_log = $request->ctrl_log;
    $report->ctrl_maj_os = $request->ctrl_maj_os;
    $report->ctrl_hdd = $request->ctrl_hdd;
    $report->ctrl_maj_hard = $request->ctrl_maj_hard;
    $report->ctrl_raid = $request->ctrl_raid;
    $report->ctrl_maj_soft = $request->ctrl_maj_soft;
    $report->ctrl_backup = $request->ctrl_backup;
    $report->ctrl_antivirus = $request->ctrl_antivirus;
    $report->volum_backup = $request->volum_backup;
    $report->maj_antivirus = $request->maj_antivirus;
    $report->maj_backup = $request->maj_backup;
    $report->commentaire = $request->commentaire;
    $report->id_affect = $id_affect[0]->id;
    
    //dd($report);
    $report->save();
    return redirect(route('report.index'));
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
    $collabs = DB::table('users')->get();
    $report = report::findOrFail($id);
    $col = DB::table('users')
      ->select('users.id','users.name')
      ->join('contrat_collaborateur','contrat_collaborateur.id_collab','=','users.id')
      ->join('reports','reports.id_affect','=','contrat_collaborateur.id')
      ->where('reports.id','=',$report->id)
      ->get();
    $clients = DB::table('clients')
      ->distinct()
      ->select('clients.id','clients.nom')
      ->join('contrats', 'contrats.id_client', '=', 'clients.id')
      ->join('contrat_collaborateur', 'contrat_collaborateur.id_contrat', '=', 'contrats.id')
      ->where('contrat_collaborateur.id_collab','=',$col[0]->id)
      ->get();
    $collab_current = $col[0]->id;
    $cli = DB::table('clients')
      ->select('clients.id','clients.nom')
      ->join('contrats','contrats.id_client','=','clients.id')
      ->join('contrat_collaborateur','contrat_collaborateur.id_contrat','=','contrats.id')
      ->join('reports','reports.id_affect','=','contrat_collaborateur.id')
      ->where('reports.id','=',$report->id)
      ->get();
    $cli_current = $cli[0]->id;
    $contrats = DB::table('contrats')
      ->join('contrat_collaborateur','contrat_collaborateur.id_contrat','=','contrats.id')
      ->where('contrats.id_client', '=', $cli_current)
      ->where('contrat_collaborateur.id_collab', '=', $collab_current)
      ->orderBy('description', 'asc')
      ->select('contrats.id','contrats.description')
      ->get();
    $cont = DB::table('contrats')
      ->join('contrat_collaborateur','contrat_collaborateur.id_contrat','=','contrats.id')
      ->join('reports','reports.id_affect','=','contrat_collaborateur.id')
      ->where('reports.id','=',$report->id)
      ->select('contrats.id')
      ->get();
    $contrat_current = $cont[0]->id;
    $heures = DB::table('heures')->select('id',DB::raw('DATE_FORMAT(heures.heures, "%H:%i") as heures'))->get();
    //dd($cli,$report);
    return view('reports.editreport', compact('heures','report','collabs','clients','contrats','collab_current','cli_current','contrat_current'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
    $id_affect = DB::table('contrat_collaborateur')
      ->where('contrat_collaborateur.id_collab','=',$request->collab)
      ->where('contrat_collaborateur.id_contrat','=',$request->contrat)
      ->select('id')
      ->get();
    $report = report::findOrFail($id);
    $report->arrivee = $request->h_debut;
    $report->depart = $request->h_fin;
    $report->jour = $request->jour;
    $report->type_heure = $request->type_heure;
    $report->tps_total = $request->tps_adm + $request->tps_proj + $request->tps_maint + $request->tps_dev + $request->tps_parc + $request->tps_reunion + $request->tps_prix + $request->tps_dep + $request->tps_inst + $request->tps_ctrl + $request->tps_assist + $request->tps_autre + $request->tps_form;

    $report->tps_adm = $request->tps_adm;
    $report->tps_proj = $request->tps_proj;
    $report->tps_maint = $request->tps_maint;
    $report->tps_dev = $request->tps_dev;
    $report->tps_parc = $request->tps_parc;
    $report->tps_reunion = $request->tps_reunion;
    $report->tps_prix = $request->tps_prix;
    $report->tps_dep = $request->tps_dep;
    $report->tps_inst = $request->tps_inst;
    $report->tps_ctrl = $request->tps_ctrl;
    $report->tps_assist = $request->tps_assist;
    $report->tps_autre = $request->tps_autre;
    $report->tps_form = $request->tps_form;
    $report->ctrl_log = $request->ctrl_log;
    $report->ctrl_maj_os = $request->ctrl_maj_os;
    $report->ctrl_hdd = $request->ctrl_hdd;
    $report->ctrl_maj_hard = $request->ctrl_maj_hard;
    $report->ctrl_raid = $request->ctrl_raid;
    $report->ctrl_maj_soft = $request->ctrl_maj_soft;
    $report->ctrl_backup = $request->ctrl_backup;
    $report->ctrl_antivirus = $request->ctrl_antivirus;
    $report->volum_backup = $request->volum_backup;
    $report->maj_antivirus = $request->maj_antivirus;
    $report->maj_backup = $request->maj_backup;
    $report->commentaire = $request->commentaire;
    $report->id_affect = $id_affect[0]->id;
    // dd($request->all());
    $report->save();
    return redirect(route('report.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $report = report::findOrFail($id);
    $report->delete();
    return redirect(route('report.index'));

  }
  
}

?>