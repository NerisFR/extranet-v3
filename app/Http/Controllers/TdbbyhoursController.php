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
