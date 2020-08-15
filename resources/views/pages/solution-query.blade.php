<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.ai</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- header -->
<header>
    <div class="logo"><img src="{{ asset('images/logo.png') }}" alt=""></div>
</header>
<!-- end header -->

<section class="mainblock2">

@if (session('error'))
    <div class="alert alert-danger" style="color: red;">{{ session('error') }}</div>
@endif
    <div class="bannerform">
        <div class="bannerformcont">
            <h5 class="bannerformtop">For a customised solution, please submit your query</h5>
            <div class="formhead">
                <h4>Choose your nature of business</h4>
            </div>
            <form method="POST" class="bannerformbox" action="/" autocomplete="off">
              @csrf
                <div class="row">

                @error('business')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                  @foreach ($BUSINESS_NATURE as $businessNature => $category)
                    
                    @if($businessNature !== 'Other Kind Of Business')
                      <div class="choosebox">
                        <label>
                            <input type="checkbox" name="business[]" value="{{ $businessNature }}">{{ $businessNature }}
                            <span class="customcheck"></span>
                        </label>
                      </div>
                    @endif
                    
                    @if($businessNature === 'Other Kind Of Business')
                      <div class="otherchoosebox">
                        <div class="choosebox">
                            <label>
                                <input type="checkbox" name="business[]" value="{{ $businessNature }}">{{ $businessNature }}
                                <span class="customcheck"></span>
                            </label>
                        </div>
                        <input type="text" name="otherBusinessDetail">
                      </div>
                    @endif
                  @endforeach
                </div>
                <div class="personalform blurdiv">
                    <div class="floating-label">      
                        <input name="name" value="{{old('name', 'Satish')}}" class="floating-input form-control" type="text" placeholder=" ">
                        <span class="highlight"></span>
                        <label>Name*</label>
                        @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="floating-label">      
                        <input name="email" value="{{old('email', 'satishkumr001@gmail.com')}}" class="floating-input form-control" type="email" placeholder=" ">
                        <span class="highlight"></span>
                        <label>Email Id*</label>
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="floating-label">      
                        <input name="companyName" value="{{old('companyName', 'Clik')}}" class="floating-input form-control" type="text" placeholder=" ">
                        <span class="highlight"></span>
                        <label>Company Name*</label>
                        @error('companyName')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mobileinputwrap">
                        <div class="mobileinput">
                            <label>Mobile Number</label>
                            <input name="mobileNumber" value="{{old('mobileNumber', '813062671')}}" id="mobileNumber" type="text">
                            <button disabled id="sendOtp" type="button">Verify*</button>
                            @error('mobileNumber')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mobileotp">
                            <label>OTP</label>
                            <input name="otp" value="{{old('otp', '')}}" type="text">
                            @error('otp')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="stateinputwrap">
                        <div class="floating-label">      
                            <input name="pincode" value="{{old('pincode', '121003')}}"class="floating-input form-control" type="text" placeholder=" ">
                            <span class="highlight"></span>
                            <label>Pincode*</label>
                            @error('pincode')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="floating-label">      
                            <input name="state" value="{{old('state', 'Haryana')}}" class="floating-input form-control" type="text" placeholder=" ">
                            <span class="highlight"></span>
                            <label>State*</label>
                            @error('state')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="querywrap">
                        <label>Query</label>
                        <textarea name="query" rows="10" aria-setsize="none">{{old('query', 'Some query')}}</textarea>
                        @error('query')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="personalchbox">
                        <label>
                            <input name="isAgreedTerms" type="checkbox"> I agree to the terms and conditons, <a href="#">Read more</a>
                            <span class="personalcheck"></span>
                             @error('isAgreedTerms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                    <div class="personalsubmit">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- footer -->
<footer>
    <div class="row">
        <div class="footerbox">
            <p>Follow <span>Canon India</span> on</p>
            <ul>
                <li><a href="#"><img src="{{ asset('images/facebook.png') }}" alt=""></a></li>
                <li><a href="#"><img src="{{ asset('images/twitter.png') }}" alt=""></a></li>
                <li><a href="#"><img src="{{ asset('images/youtube.png') }}" alt=""></a></li>
            </ul>
        </div>
        <div class="footerbox">
            <p>Follow <span>canonindia_official</span> on</p>
            <ul>
                <li><a href="#"><img src="{{ asset('images/instagram.png') }}" alt=""></a></li>
            </ul>
        </div>
        <div class="footerbox">
            <p>Visit us at: in.canon</p>
        </div>
    </div>
</footer>
<!-- end footer -->

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/otp.js') }}"></script>
</body>
</html>