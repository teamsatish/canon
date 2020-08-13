<h1>Submit Query</h1>

@include('forms.shared-errors')

<form method="POST" action="/">
  @csrf

  <div class="form-group">
    <label for="name">Name</label>
    <input id="name" name="name" value="{{old('name', 'Some Name')}}" type="text" class="@error('name') is-invalid @enderror form-control">
    @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group">
    <label for="email">Email Id</label>
    <input id="email" name="email" value="{{old('email', 'satishkumr001@gmail.com')}}" type="email" class="@error('email') is-invalid @enderror form-control">
    @error('email')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="companyName">Company Name</label>
    <input id="companyName" name="companyName" value="{{old('companyName', 'some company name')}}" type="companyName" class="@error('companyName') is-invalid @enderror form-control">
    @error('companyName')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="mobileNumber">Mobile Number</label>
    <input id="mobileNumber" name="mobileNumber" value="{{old('mobileNumber', '8130626713')}}" type="mobileNumber" class="@error('mobileNumber') is-invalid @enderror form-control">
    @error('mobileNumber')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <button type="button" disabled id="sendOtp" class="btn btn-success">Send OTP</button>
  </div>
  
  <div class="form-group">
    <label for="otp">OTP</label>
    <input id="otp" name="otp" value="{{old('otp', '0000')}}" type="otp" class="@error('otp') is-invalid @enderror form-control">
    @error('otp')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="pincode">Pincode</label>
    <input id="pincode" name="pincode" value="{{old('pincode', '121003')}}" type="pincode" class="@error('pincode') is-invalid @enderror form-control">
    @error('pincode')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="state">State</label>
    <input id="state" name="state" value="{{old('state', 'Haryana')}}" type="state" class="@error('state') is-invalid @enderror form-control">
    @error('state')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="query">Query</label>
    <textarea id="query" name="query" type="query" class="@error('query') is-invalid @enderror form-control">{{old('query', 'Some really long query here...')}}</textarea>
    @error('query')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="custom-control custom-checkbox">
    <input type="checkbox" name="isAgreedTerms" class="custom-control-input" id="isAgreedTerms">
    <label class="custom-control-label" for="isAgreedTerms">I agree to terms and condition.</label>

    @error('isAgreedTerms')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <button class="btn btn-success">
    Submit
  </button>

<script src="{{ asset('js/otp.js')}}"></script>
</form>