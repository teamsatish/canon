window.onload = function() {
  var mobileNumberInput = document.getElementById('mobileNumber');
  var pincodeInput = document.getElementById('pincode');
  var stateInput = document.getElementById('state');
  var cityInput = document.getElementById('city');
  var sendOtpButton = document.getElementById('sendOtp');

  mobileNumberInput.onkeyup = function (event) {
    const mobileNumber = mobileNumberInput.value;
    if (mobileNumber.length === 10 && !isNaN(mobileNumber)) {
      sendOtpButton.disabled = false;
    } else {
      sendOtpButton.disabled = true;
    }
  };

  pincodeInput.onkeyup = function (event) {
    const pincode = pincodeInput.value;
    if (pincode.length === 6 && !isNaN(pincode)) {
      fetch(`https://api.postalpincode.in/pincode/${pincode}`)
        .then(response => response.json())
        .then(responseBody => {
          if (Array.isArray(responseBody) && responseBody[0] && responseBody[0].PostOffice && Array.isArray(responseBody[0].PostOffice) && responseBody[0].PostOffice[0] && responseBody[0].PostOffice[0].State) {
            const state = responseBody[0].PostOffice[0].State;
            const city = responseBody[0].PostOffice[0].District;
            stateInput.value = state;
            cityInput.value = city;
          }
      });
    } else {
      sendOtpButton.disabled = true;
    }
  };

  sendOtpButton.onclick = function () {
    const mobileNumber = mobileNumberInput.value;
    $('#resendOtp-feedback').show();
    startTimer();
    // sendOtpButton.textContent = 'Sending OTP...';
    const url = 'http://3.6.178.94/send-otp';
    // const url = 'http://localhost:8000/send-otp';
    sendOtpButton.disabled = true;
    postData(url, { mobileNumber: `+91${mobileNumber}` })
      .then(data => {
        // sendOtpButton.textContent = 'Sending Sent!';
        toastr.success(data.message);
        // console.log(data); // JSON data parsed by `data.json()` call
      }).finally(() => {
        sendOtpButton.disabled = false;
      });
  }
};

function startTimer() {
  let timerOn = true;

  function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;

    if (remaining >= 0 && timerOn) {
      setTimeout(function () {
        timer(remaining);
      }, 1000);
      return;
    }

    if (!timerOn) {
      // Do validate stuff here
      return;
    }

    // Do timeout stuff here
    // alert('Timeout for otp');

    $('#resendOtp-feedback').hide();
    $('#resendOtp-button').show();
  }

  //TODO: 
  timer(60);
}

function resendOtp() {
  $('#resendOtp-feedback').show();
  $('#resendOtp-button').hide();
  var sendOtpButton = document.getElementById('sendOtp');
  sendOtpButton.click();
}

async function postData(url = '', data = {}) {

  const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  // Default options are marked with *
  const response = await fetch(url, {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': _token
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body: JSON.stringify({ ...data, _token }) // body data type must match "Content-Type" header
  });
  return response.json(); // parses JSON response into native JavaScript objects
}
