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
              <a class="nav-link" style="color:white" href="http://localhost/WebProje/İşle.php">İşle </a>
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



    <form class="container align-items-center" action="GirisCikislar.php" method="POST">
        <div class="col-sm-4"></div>
        <div class="form-group col-sm-4">
            <br>
                <input class="form-control" name="plaka" placeholder="Plaka...">
            <br>
            <input class="form-control" name="tarihfrom" placeholder="İlk Tarih...">
            <br>
            <input class="form-control" name="tarihto" placeholder="Son Tarih...">
            <br>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <button name="listele" type="submit" class="btn btn-primary row-sm-3">Listele</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <div class="col-sm-4"></div>
    </form>
    
       
    <div class="container">
        <table class="table table-bordered">
           <thead>
              <tr>
               <td>
                    <label>Plaka</label>
               </td>
               <td>
                    <label>Giriş Tarihi</label>
               </td>
               <td>
                    <label>Çıkış Tarihi</label>
               </td>
               <td>
                    <label>Ücret</label>
               </td>
              </tr>
           </thead>
            
            <?php
            
                include("baglanti.php");
            
            
                if($_SERVER['REQUEST_METHOD']=='POST') // listele butonuna basıldıgında
                {                    
                    $sec = "SELECT * FROM giriscikis ";
                    $operand = 0;
            
                    if($_POST['plaka'] != '') // eger plaka girildiyse
                    {
                        $sec = $sec."WHERE plaka = '".$_POST['plaka']."'";
                        $operand++;
                    }
                    if($_POST['tarihfrom'] != '') // eger baslangictarihi girildiyse
                    {
                        if($operand > 0) $sec = $sec." AND";
                        else $sec = $sec." WHERE";
                        
                        // MYSQL'in CAST fonksiyonu ile, "giris" field'ının tipini bu query'de DATETIME olarak çevirdim
                        $sec = $sec." (CAST(giris AS DATETIME) >= CAST('".$_POST['tarihfrom']."' AS DATETIME))";
                        $operand++;
                    }
                    if($_POST['tarihto'] != '') // eger bitistarihi girildiyse
                    {
                        if($operand > 0) $sec = $sec." AND";
                        else $sec = $sec." WHERE";
                        
                        // MYSQL'in CAST fonksiyonu ile, "giris" field'ının tipini bu query'de DATETIME olarak çevirdim
                        $sec = $sec." (CAST(giris AS DATETIME) <= CAST('".$_POST['tarihto']."' AS DATETIME))";
                    }
                    
                    // DB'ye query'i execute eder
                    $sonuc=$baglanti->query($sec);

                    // veriler bitene kadar her bir satırı cek isimli degiskene ata
                    while($cek=$sonuc->fetch_assoc())
                    {
                        echo"
                            <tr>
                                <td>".$cek['plaka']."</td>
                                <td>".$cek['giris']."</td>
                                <td>".$cek['cikis']."</td>
                                <td>".$cek['ucret']."</td>
                            </tr>
                        ";   
                    }
                }
            
            ?>
        </table>
    </div>

     
</body>
</html>