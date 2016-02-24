<?php namespace App\Http\Controllers;

use DB;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class UserController extends Controller {

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
    $utils = DB::table('users')->get();
    $departements = DB::table('departements')->orderBy('num', 'asc')->get();
    $regions = DB::table('regions')->orderBy('region', 'asc')->get();
    return view('admin.users.users', compact('utils','departements','regions'));
    
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
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admin.users.createusers');
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
    $collab = user::findOrFail($id);
    return view('admin.users.editusers', compact('collab'));
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

?>