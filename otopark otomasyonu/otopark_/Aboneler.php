<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Otopark Yönetim Sistemi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  </head>

<body>
    
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
           
            <img src="images/logo.jpg" width="40" height="40" alt=""> <a class="navbar-brand" style="color:white">Otopark Yönetim Sistemi</a>
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" style="color:white" href="http://localhost/WebProje/İşle.php">İşle</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color:white" href="http://localhost/WebProje/GirisCikislar.php">Giriş Çıkışlar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color:white" href="http://localhost/WebProje/Aboneler.php">Aboneler</a>
            </li>
          </ul>
          
        </div>
      </nav>
      <!-- Navbar End -->


    
    
    <form class="container" action="Aboneler.php" method="POST">
        <div class="col-sm-4"></div>
        <div class="form-group col-sm-4">
            <br>
            <input class="form-control" name="plaka" placeholder="Plaka...">
            <br>
            <input class="form-control" name="telno" placeholder="Tel No...">
            <br>
            <input class="form-control" name="abonelikbaslangictarihi" placeholder="Abonelik Baslangic Tarihi...">
            <br>
            <input class="form-control" name="abonelikbitistarihi" placeholder="Abonelik Bitis Tarihi...">
            <br>
            <input class="form-control" name="ad" placeholder="Ad...">
            <br>
            <input class="form-control" name="soyad" placeholder="Soyad...">
            <br>
            <div class="col-sm-3"></div>
            <button name="duzenle" type="submit" class="btn btn-primary" onClick="display_data()">Düzenle</button>
            <button name="sil" type="submit" class="btn btn-primary">Sil</button>
            <button name="ekle" type="submit" class="btn btn-primary">Ekle</button>
        </div>
        <div class="col-sm-5"></div>
    </form>
    


    <div class="container">
        <table class="table table-bordered">
          <thead>
              <tr>
               <td>
                    <label>Plaka</label>
               </td>
               <td>
                    <label>Tel No</label>
               </td>
               <td>
                    <label>Ad</label>
               </td>
               <td>
                    <label>Soyad</label>
               </td>
               <td>
                    <label>Abonelik Başlangıç Tarihi</label>
               </td>
               <td>
                    <label>Abonelik Bitiş Tarihi</label>
               </td>
              </tr>
           </thead>
           
            
            <?php
            
                include("baglanti.php");
                    
                $sec="SELECT * FROM abone";
                $sonuc=$baglanti->query($sec);

                if($sonuc->num_rows>0)
                {
                    while($cek=$sonuc->fetch_assoc())
                    {
                         echo"
                         <tr>
                         <td>".$cek['plaka']."</td>
                         <td>".$cek['telno']."</td>
                         <td>".$cek['ad']."</td>
                         <td>".$cek['soyad']."</td>
                         <td>".$cek['baslangic']."</td>
                         <td>".$cek['bitis']."</td>
                         </tr>
                         ";
                    }
                }
                else
                {
                    echo"Veritabanında kayıtlı veri bulunamadı.";   
                }
                    
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') // Butona tıklandı mı
            {
                if(isset($_POST['duzenle'])) { // düzenle butonuna mı tıklandı
                    
                    // BİLGİLERİ DÜZENLE, TEL NO, BİTİS TARİHİ
                    
                    $plaka = $_POST['plaka'];
                    $telno = $_POST['telno'];
                    $abonelikbitistarihi = $_POST['abonelikbitistarihi'];
                    
                    $duzenle = "UPDATE abone SET bitis = '".$abonelikbitistarihi."', telno = '".$telno."' WHERE plaka = '".$plaka."'";
                                
                    $baglanti->query($duzenle);
                    header("Refresh: 0");
                }
                
                if(isset($_POST['ekle'])) { // ekle butonuna mı tıklandı
                    
                    // BÜTÜN BİLGİLERİ ALIP INSERT YAP. PLAKA, TEL NO, BASLANGIC TARİHİ, BİTİS TARİHİ, AD, SOYAD
                    
                    $plaka = $_POST['plaka'];
                    $telno = $_POST['telno'];
                    $ad = $_POST['ad'];
                    $soyad = $_POST['soyad'];
                    $abonelikbaslangictarihi = $_POST['abonelikbaslangictarihi'];
                    $abonelikbitistarihi = $_POST['abonelikbitistarihi'];
                    
                    $ekle = "INSERT INTO abone (plaka, ad, soyad, baslangic, bitis, telno) VALUES ('".$plaka."', '".$ad."', '".$soyad."', '".$abonelikbaslangictarihi."', '".$abonelikbitistarihi."', '".$telno."')";
                    
                    $baglanti->query($ekle);
                    header("Refresh: 0");
                }
                
                if(isset($_POST['sil'])) { // sil butonuna mı tıklandı
            
                    // PLAKA'YI ARATIP TÜM VERİYİ DELETE YAP
                    
                    $plaka = $_POST['plaka'];
                    
                    $sil = "DELETE FROM abone WHERE plaka = '".$plaka."'";
                    
                    $baglanti->query($sil);
                    header("Refresh: 0");
                }
            }
            
            
            
            
            ?>
        </table>
    </div>





     
</body>
</html>
