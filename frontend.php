<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirVisual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
        <?php
            require("backend.php");
        
            if(isset($_COOKIE['kota_user'])) {
                $kotaDipilih = $_COOKIE['kota_user'];
            } else {
                $kotaDipilih = " ";
            }

            $kota = http_request("http://api.airvisual.com/v2/city?city=".$kotaDipilih."&state=West%20Java&country=Indonesia&key=637e2ced-69ec-415d-a132-13c8b201d082");
            $kota = json_decode($kota, TRUE);

            $kota_data = $kota['data']['city'];
            $provinsi_data = $kota['data']['state'];
            $negara_data = $kota['data']['country'];
            $aqius = $kota['data']['current']['pollution']['aqius'];
            $ic = $kota['data']['current']['weather']['ic'];

            $cuaca = cuaca($ic);
            $image = $cuaca['image'];
            $keterangan = $cuaca['keterangan'];

            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $ymd = date_create($tanggal);
            $tanggalSekarang = date_format($ymd, 'd F Y'); 
        ?>

        <div class="container mt-4">
            <div class="text-center mb-4">
                <h1>Kualitas Udara</h1>
                <h2><?php echo $kota_data.", ".$provinsi_data.", ".$negara_data?></h2>
                <h3><?php echo "Tanggal : ".$tanggalSekarang ?></h3>
            </div>

            <form action="process.php" method="post">
                <div class="row mb-2">
                    <div class="col-lg-1 col-md-2 col-3">
                        <p>Kota : </p>
                    </div>
                    <div class="col-lg-3 col-md-4 col-5">
                        <select name="kota" id="kota" class="form-select">
                            <option value="Bandung">Bandung</option>
                            <option value="Bekasi">Bekasi</option>
                            <option value="Bogor">Bogor</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary">Pilih</button>
                    </div>
                </div>
            </form>

            <div class="row bg-danger text-white font-weight-bold p-4">
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <p>Indeks Kualitas Udara</p>
                    <h3><?php echo $aqius; ?></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0 mb-3">
                    <p>Tingkat Polusi Udara</p>
                    <h3><?php echo indeksKualitasUdara($aqius); ?></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-md-0">
                    <p>Cuaca</p>
                    <div class="d-flex align-items-center">
                        <img src="<?php echo $image; ?>" alt="" class="custom-image">
                        <h3 class="ms-3"><?php echo $keterangan; ?></h3>
                    </div>
                </div>
            </div>
        </div>

    <style>
        body {
            background-color: #4fcbf1;
        }

        .custom-image {
            width: 40px;
            height: 40px;
        }
    </style> 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>