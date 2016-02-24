<?php namespace App\Http\Controllers;
use DB;
use App\Client;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClientController extends Controller {

public function __construct()
    {
        $this->middleware('auth');
    }

  /**
   * Display a listing of the resource.
   * @Post("client", as="client.index")
   * @return Response
   */
  public function index()
  {
      $clients = DB::table('clients')->get();
      $departements = DB::table('departements')->orderBy('num', 'asc')->get();
      $regions = DB::table('regions')->orderBy('region', 'asc')->get();
      return view('admin.clients.clients', compact('clients','departements','regions'));  
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getViewByRegion($idregion)
  {
      $clients = DB::table('clients')
        ->join('departements', 'departements.id', '=', 'clients.id_dep')
        ->join('regions', 'regions.id', '=', 'departements.id_region')
        ->where('regions.id','=',$idregion)
        ->select('clients.id','clients.nom','clients.adresse','clients.cp','clients.ville')
        ->get();
      $departements = DB::table('departements')->orderBy('num', 'asc')->get();
      $regions = DB::table('regions')->orderBy('region', 'asc')->get();
      return view('admin.clients.listclients', compact('clients','departements','regions'));    
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getByRegion($idregion)
  {
      $clients = DB::table('clients')
        ->join('departements', 'departements.id', '=', 'clients.id_dep')
        ->join('regions', 'regions.id', '=', 'departements.id_region')
        ->where('regions.id','=',$idregion)
        ->select('clients.id','clients.nom','clients.adresse','clients.cp','clients.ville')
        ->get();
      return json_encode($clients);    
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getByCollab($idcollab)
  {
      $clients = DB::table('clients')
        ->distinct()
        ->select('clients.id','clients.nom')
        ->join('contrats', 'contrats.id_client', '=', 'clients.id')
        ->join('contrat_collaborateur', 'contrat_collaborateur.id_contrat', '=', 'contrats.id')
        ->where('contrat_collaborateur.id_collab','=',$idcollab)
        ->get();
      return json_encode($clients);
      
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getViewByDep($iddep)
  {
      $clients = DB::table('clients')
        ->where('id_dep','=',$iddep)
        ->get();
      $departements = DB::table('departements')->orderBy('num', 'asc')->get();
      $regions = DB::table('regions')->orderBy('region', 'asc')->get();
      return view('admin.clients.listclients', compact('clients','departements','regions'));    
  }

  /**
   * Display a listing of the resource.
   * 
   * @return Response
   */
  public function getByDep($iddep)
  {
      $clients = DB::table('clients')
        ->where('id_dep','=',$iddep)
        ->get();
      return json_encode($clients);    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $departements = DB::table('departements')->orderBy('num', 'asc')->get();
    return view('admin.clients.createclients', compact('departements'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(request $request)
  {
    $client = new client();
    $client->nom = $request->nom;
    $client->adresse = $request->adresse;
    $client->cp = $request->cp;
    $client->ville = $request->ville;
    $client->id_dep = $request->dep;
    $client->siret = $request->siret;
    $client->tel = $request->tel;
    $client->fax = $request->fax;
    $client->web = $request->web;
    $client->mail = $request->mail;

    // dd($request->all());
    $client->save();
    return redirect(route('client.index'));
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
    $client = client::findOrFail($id);
    $departements = DB::table('departements')->orderBy('num', 'asc')->get();
    return view('admin.clients.editclients', compact('client','departements'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
    $client = client::findOrFail($id);
    $client->nom = $request->nom;
    $client->adresse = $request->adresse;
    $client->cp = $request->cp;
    $client->ville = $request->ville;
    $client->id_dep = $request->dep;
    $client->siret = $request->siret;
    $client->tel = $request->tel;
    $client->fax = $request->fax;
    $client->web = $request->web;
    $client->mail = $request->mail;

    // dd($request->all());
    $client->save();
    return redirect(route('client.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $client = client::findOrFail($id);
    $client->delete();
    return redirect(route('client.index'));
  }
  
}

?>