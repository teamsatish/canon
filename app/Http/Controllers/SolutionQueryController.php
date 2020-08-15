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

  const BUSINESS_NATURE = [
    'Production/Post Production House' => 'OTT',
    'YouTube Content Studio' => 'YouTube',
    'Rental House' => 'OTT',
    'Video Content Creator' => 'YouTube',
    'DoP/Cinematographer/Filmmaker' => 'OTT',
    'Print/Electronic/Digital Media' => 'Media',
    'Film & Television Institute' => 'OTT',
    'Mass Communication Institute' => 'Education Mass com',
    'Visual FX/Animation/Gaming Studio' => 'VFX',
    'Fine Arts Institute' => 'Education Mass com',
    '3D/Animation/VFX Institute' => 'VFX',
    'Photography Institute' => 'Photo schools',
    'Other Kind Of Business' => 'Others',
  ];

  public function create(Request $request) {

    $validatedData = $request->validate([
        'business' => 'required|array',
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

    foreach ($request->input('business') as $businessIndex => $business) {
      if($business == 'Other Kind Of Business' && $request->input('otherBusinessDetail') == '') {
        $request->session()->flash('error', 'Please provide other business detail!');
        return view('pages.solution-query', ['BUSINESS_NATURE' => self::BUSINESS_NATURE])->withInput($request->all());
      }
    }

    $mobileNumber = '+91'.$request->input('mobileNumber');
    $otpInstance = Otp::where('mobileNumber', $mobileNumber)->first();
    if(!$otpInstance || ($otpInstance->otp != $request->input('otp'))) {
      $request->session()->flash('error', 'Otp not matched!');
      return view('pages.solution-query', ['BUSINESS_NATURE' => self::BUSINESS_NATURE])->withInput($request->all());
    }

    foreach ($request->input('business') as $businessIndex => $business) {
      $solutionObject = array_merge(
        $request->except(['isAgreedTerms', 'otp']),
        [
          'businessCategory' => self::BUSINESS_NATURE[$business],
          'business' => $business,
          'otherBusinessDetail' => $business !== 'Other Kind Of Business' ? '' : $request->input('otherBusinessDetail')
        ]
      );
      $solutionQuery = SolutionQuery::create($solutionObject);
    }

    
    
    $otpInstance->delete();

    $request->session()->forget('error');
    $request->session()->flash('message', 'Query submitted succesfully!');
    return redirect('/thankyou');
  }

  public function thankyou() {
    return view('pages.thanku');
  }

  public function index(Request $request) {
    return view('pages.solution-query', ['BUSINESS_NATURE' => self::BUSINESS_NATURE]);
  }

  public function sendOtp(Request $request) {
    $mobileNumber = $request->input('mobileNumber');
    
    $userId = config('app.neutrinoapiUserId');
    $apiKey = config('app.neutrinoapiApiKey');

    $response = Http::withHeaders([
        'user-id' => $userId,
        'api-key' => $apiKey
    ])->post('https://neutrinoapi.net/sms-verify', [
      'number' => $mobileNumber
    ]);

    // TODO: Remove when deploying
    if(config('app.env') == 'local') {
      $response = [
        'number-valid' => true,
        'sent' => true,
        'security-code' => '00000',
      ];
    }

    if(!$response['number-valid']) {
      return response(['message' => 'Mobile Number is not valid!'], 400);
    }
    
    if(!$response['sent']) {
      return response(['message' => 'OTP not sent!'], 400);
    }

    if($response['sent']) {
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
