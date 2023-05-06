<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP Send</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Firebase OTP Send</h2>
        <div class="alert alert-danger" style="display:none;" id="error"></div>
        <div class="card mt-4">
            <div class="alert alert-success mb-4" id="phoneNumberSuccess" style="display:none;"></div>
            <div class="card-header">
                Enter Phone Number
            </div>
            <div class="card-body">
                <form class="mb-3" id="sendCodeForm">
                    <label class="form-label">Phone Number:</label>
                    <input class="form-control" type="text" name="number" id="number"
                        placeholder="+8801*********">
                </form>

                <div id="recaptcha-container" class="mb-3"></div>

                <button class="btn btn-success" onclick="sendCode()">Send Code</button>
            </div>
        </div>

        <div class="alert alert-danger d-none" id="verificationError"></div>
        <div class="card mt-4">
            <div class="alert alert-success mb-4" id="verifySuccess" style="display:none;"></div>
            <div class="card-header">
                Enter Verification Code
            </div>
            <div class="card-body">
                <form class="mb-3">
                    <input class="form-control" type="text" name="verifyCode" id="verifyCode"
                        placeholder="Enter Verification Code">
                </form>

                <button class="btn btn-success" onclick="verifyCode()">Verify Code</button>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script>
        // Initialize Firebase
        // TODO: Replace with your project's customized code snippet
        const config = {
            apiKey: "AIzaSyDt-AfKx1caCpAxsnIHElZ02VGqQWW8avw",
            authDomain: "fir-send-otp-5e683.firebaseapp.com",
            projectId: "fir-send-otp-5e683",
            storageBucket: "fir-send-otp-5e683.appspot.com",
            messagingSenderId: "577828239323",
            appId: "1:577828239323:web:782ac5b91c4697e47219fe",
            measurementId: "G-KTLKWV9LTK"
        };
        firebase.initializeApp(config);
    </script>

    <script>
        window.onload = function() {
            render();
        };

        function render() {
            // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function isCaptchaChecked() {
            return grecaptcha && grecaptcha.getResponse().length !== 0;
        }

        function showMessage(id, message) {
            $(id).show();
            $(id).text(message);
        }

        function hideMessage(ids) {
            ids.forEach(function(id) {
                $(id).hide();
            });
        }

        function timedOut() {
            hideMessage(['#error', '#phoneNumberSuccess', '#verificationError', '#verifySuccess']);
            showMessage('#error', "Time Out");
        }


        function sendCode() {
            const number = $('#number').val();
            if (!isCaptchaChecked()) {
                hideMessage(['#error', '#phoneNumberSuccess', '#verificationError', '#verifySuccess']);
                showMessage('#error', 'reCaptcha is not selected');
            } else {
                firebase.auth().signInWithPhoneNumber(number, recaptchaVerifier)
                    .then((confirmationResult) => {
                        // SMS sent. Prompt user to type the code from the message, then sign the
                        // user in with confirmationResult.confirm(code).
                        window.confirmationResult = confirmationResult;
                        // ...
                        console.log(confirmationResult);
                        $('#sendCodeForm')[0].reset();
                        hideMessage(['#error', '#phoneNumberSuccess', '#verificationError', '#verifySuccess']);
                        showMessage('#phoneNumberSuccess', 'Message sent successfully');
                    }).catch((error) => {
                        // Error; SMS not sent
                        // ...
                        setTimeout(timedOut, 120000);
                        hideMessage(['#error', '#phoneNumberSuccess', '#verificationError', '#verifySuccess']);
                        showMessage('#error', error.message);
                        // console.log(error);
                    });
            }
        }

        function verifyCode() {
            const code = $('#verifyCode').val();

            confirmationResult.confirm(code).then((result) => {
                const user = firebase.auth().currentUser;
                if (user !== null) {
                    // The user object has basic properties such as display name, email, etc.

                    // The user's ID, unique to the Firebase project. Do NOT use
                    // this value to authenticate with your backend server, if
                    // you have one. Use User.getIdToken() instead.
                    const uid = user.uid;
                    console.log(uid);
                }
                hideMessage(['#error', '#phoneNumberSuccess', '#verificationError', '#verifySuccess']);
                showMessage('#verifySuccess', 'Phone Number Verified');
            }).catch((error) => {
                // User couldn't sign in (bad verification code?)
                // ...
                hideMessage(['#error', '#phoneNumberSuccess', '#verificationError', '#verifySuccess']);
                showMessage('#error', error.message);
            });
        }
    </script>
</body>

</html>
