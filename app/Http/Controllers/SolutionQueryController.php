<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SolutionQuery;

class SolutionQueryController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function create(Request $request) {
    $allSolutions = SolutionQuery::all();

    // foreach ($allSolutions as $flight) {
    //     echo $flight->name;
    // }

    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'companyName' => 'required|max:255',
        'mobileNumber' => 'required|size:10',
        'otp' => 'required|size:4',
        'pincode' => 'required|size:6',
        'state' => 'required|max:255',
        'query' => 'required|min:10',
        'isAgreedTerms' => 'accepted',
    ]);

    $solutionQuery = SolutionQuery::create($request->except(['isAgreedTerms']));
    $request->session()->flash('message', 'Query submitted succesfully!');
    return view('pages.solution-query')->withInput($request->all());
  }

  public function index(Request $request) {
    return SolutionQuery::all();
  }


}
