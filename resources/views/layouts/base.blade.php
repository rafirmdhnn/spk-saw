<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Pendukung Keputusan Diagnosa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .wrapper-header {
            height: 200px;
            background: #198278;
            border-radius: 0px 0px 200px 200px;
        }

        .wrapper-header > h1 {
            padding-top:65px;
        }

        .color-primary {
            color:#198278;
        }

        .wrapper-body > p {
            font-size: 26px;
            color: #198278;
        }

        .wrapper-content {
            font-size: 20px;
            margin-top: 90px;
        }

        .wrapper-footer {
            height: 50px;
            background: #198278;
            border-radius: 200px 200px 0px 0px;
            line-height: 52px; 
        }

        .btn-custom {
            background: #198278;
            color: white;
            font-size: 20px;
            padding: 8px 57px;
            border-radius: 22px;
            border: 1px solid #198278;
        }
        .custom-control{
            display: none;
        }
        .custom-control-label::before {
            display: none;
        }

        .custom-control::after {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="wrapper-header text-white text-center text-uppercase">
                <h1>Beck Anxiety Inventory</h1>
            </div>
        </div>
    </div>
    @yield('content')
    <center>
        <div class="container mt-5">
            <div class="col-md-4">
                <div class="wrapper-footer text-center text-uppercase text-white">
                    <p>2020 Beck Anxiet Inventory</p>
                </div>
            </div>
        </div>
    </center>
</body>
</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>