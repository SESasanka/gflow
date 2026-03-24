<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/g1.png">
    <title> Admin Sign In | Gflow</title>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>

<body style="background-image: url(img/bgpc.webp); background-size: cover;">
    <div class="spinner-wrapper">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

   

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

       

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

       

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background-image: url(img/photo-1624705002806-5d72df19c3ad.avif); background-size: cover;">
                <div class="featured-image mb-3">
                    <img src="img/Screenshot 2023-12-17 202109.png" class="img-fluid" style="width: 250px; border-radius: 50px; margin-top: 70px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Gflow Computers</p>
            </div>


            <!--model-->
            <div class="modal" tabindex="-1" id="verificationModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-warning" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--model-->


            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-3">
                        <h2>Hi Welcome to Gflow Computers Admin Sign In.</h2>
                        <p></p>
                    </div>


                    <div class="col-12 d-none" id="msgdiv">
                        <div class="alert alert-danger" role="alert" id="msg">
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" id="e" value="">
                    </div>


                    <div class="input-group  mb-3">
                        <button class="btn btn-lg btn-warning w-100 fs-6" onclick="adminVerification();">Send Verification Code</button>
                    </div>
                    
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                    </div>

                </div>
            </div>

        </div>
        <!-- footer -->
        <div class="col-12 fixed-bottom d-none d-lg-block">
            <p class="text-center text-light">&copy; 2023 Gflow.lk || All Rights Reserved</p>
        </div>
        <!-- footer -->
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>