<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SolutionQuery;
use App\Otp;
use Illuminate\Support\Facades\Http;

class SolutionQueryController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function create(Request $request) {

    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'companyName' => 'required|max:255',
        'mobileNumber' => 'required|size:10',
        'otp' => 'required|size:5',
        'pincode' => 'required|size:6',
        'state' => 'required|max:255',
        'query' => 'required|min:10',
        'isAgreedTerms' => 'accepted',
    ]);

    $mobileNumber = '+91'.$request->input('mobileNumber');
    $otpInstance = Otp::where('mobileNumber', $mobileNumber)->first();
    if(!$otpInstance || ($otpInstance->otp != $request->input('otp'))) {
      $request->session()->flash('error', 'Otp not matched!');
      return view('pages.solution-query')->withInput($request->all());
    }

    $solutionQuery = SolutionQuery::create($request->except(['isAgreedTerms']));
    $otpInstance->delete();

    $request->session()->forget('error');
    $request->session()->flash('message', 'Query submitted succesfully!');
    return view('pages.solution-query')->withInput($request->all());
  }

  public function index(Request $request) {
    return SolutionQuery::all();
  }

  public function sendOtp(Request $request) {
    // FIXME: Validate Mobile Number;
    $mobileNumber = $request->input('mobileNumber');
    
    $userId = config('app.neutrinoapiUserId');
    $apiKey = config('app.neutrinoapiApiKey');

    $response = Http::withHeaders([
        'user-id' => $userId,
        'api-key' => $apiKey
    ])->post('https://neutrinoapi.net/sms-verify', [
      'number' => $mobileNumber
    ]);

    if(!$response['number-valid']) {
      return response(['message' => 'Mobile Number is not valid!'], 400);
    }
    
    if(!$response['sent']) {
      return response(['message' => 'OTP not sent!'], 400);
    }

    if($response['sent']) {
      // Delete existing otp (if any)
      // Save new otp

      $otpInstance = Otp::where('mobileNumber', $mobileNumber)->first();
      if(!is_null($otpInstance)) {
        $otpInstance->delete();
      }

      Otp::create([
        'mobileNumber' => $request->input('mobileNumber'),
        'otp' => $response['security-code']
      ]);
    }
    
    $otp = $response['security-code'];

    return response(['message' => 'Otp sent successfully!']);
  }
  
  public function verifyOtp() {

    

    $userId = config('app.neutrinoapiUserId');
    $apiKey = config('app.neutrinoapiApiKey');

    $response = Http::withHeaders([
        'user-id' => $userId,
        'api-key' => $apiKey
    ])->post('https://neutrinoapi.net/verify-security-code', [
      'security-code' => '55321'
    ]);
    return $response;
  }


}
