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
      

    <form class="container" action="İşle.php" method="POST">
        <div class="col-sm-4"></div>
        <div class="form-group col-sm-4">
            <input class="form-control" name="plaka" placeholder="Plaka...">
            <br>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <button id="process" type="submit" class="btn btn-primary" >İşle</button>
            </div>
            <div class="col-sm-4"></div>
            <br>
        </div>
        <div class="col-sm-4"></div>
    </form>

    <br>

     
</body>
</html>
 
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
                    <label>Abonelik Bitiş Tarihi</label>
               </td>
               <td>
                    <label>Ücret</label>
               </td>
              </tr>
           </thead>

 <?php

    include("baglanti.php");
        
                
            
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        date_default_timezone_set('Asia/Istanbul');
        $date = date('d-m-y H:i:s');

        $plaka = $_POST['plaka'];

        // select ile çıkış tarihi boş olan kayıt var mı bak
        // yok ise giristir, insert et
        // var ise cikistir, veriyi güncelle

        $sec="Select * from giriscikis where plaka='".$plaka."' and cikis=' '";
        $giriscikis=$baglanti->query($sec);
        $giriscikis=$giriscikis->fetch_assoc();
        
        if(is_null($giriscikis)) // giris
        {

            $abone="SELECT * FROM abone WHERE plaka='".$plaka."'";
            $abone=$baglanti->query($abone);
            $abone=$abone->fetch_assoc();

            if(!is_null($abone)) // abonedir     YALNIZCA GECERLİ ABONELİGİN OLDUGU DURUMLAR DEGERLENDIRILMEKTEDIR!
            {
                // Plaka, giris tarihi ve abonelik bitis tarihini yazdir
                 echo "
                 <div class="."col-md-15".">
                     <tr>
                         <td>".$plaka."</td>
                         <td>".$date."</td>
                         <td></td>
                         <td>".$abone['bitis']."</td>
                         <td></td>
                     </tr>
                 </div>
                 ";            
            }
            else // abone degildir
            {
                // Plaka ve giris tarihini yazdir
                echo "
                 <div class="."col-md-15".">
                     <tr>
                         <td>".$plaka."</td>
                         <td>".$date."</td>
                         <td></td>
                         <td></td>
                         <td></td>
                     </tr>
                 </div>
                 ";
            }

            // DB'ye yeni kayıt girer
            $query="INSERT INTO giriscikis (plaka, giris, cikis) values ('".$plaka."','".$date."', ' ') ";

        }
        else // cikis
        {

            $dateDT = new DateTime(date($date));
            $fark = $dateDT->diff(new DateTime(date($giriscikis['giris'])));

            $abone="SELECT * FROM abone WHERE plaka='".$plaka."'";
            $abone=$baglanti->query($abone);
            $abone=$abone->fetch_assoc();

            if(!is_null($abone)) // abonedir     YALNIZCA GECERLİ ABONELİGİN OLDUGU DURUMLAR DEGERLENDIRILMEKTEDIR!
            {
                $ucret = 0;
                // Plaka, giris tarihi, cikis tarihi, abonelik bitis tarihini (ve ücreti 0 olarak) yazdir

                 echo "
                 <div class="."col-md-15".">
                     <tr>
                         <td>".$plaka."</td>
                         <td>".$giriscikis['giris']."</td>
                         <td>".$date."</td>
                         <td>".$abone['bitis']."</td>
                         <td>".$ucret."</td>
                     </tr>
                 </div>
                 ";            
            }
            else // abone degildir
            {
                // giris ile cikis tarihi arasındaki farkı "minute" cinsinden alır
                $ucret = $fark->i;

                // Plaka, giris tarihi, cikis tarihi, ucreti (ve abonelik bitis tarihini - olarak) yazdir
                echo "
                 <div class="."col-md-15".">
                     <tr>
                         <td>".$plaka."</td>
                         <td>".$giriscikis['giris']."</td>
                         <td>".$date."</td>
                         <td>".'-'."</td>
                         <td>".$ucret."</td>
                     </tr>
                 </div>
                 ";
            }

            
            $query = "UPDATE giriscikis set cikis='".$date."', ucret='".$ucret."' where plaka='".$plaka."' AND cikis=' '";

        } // else cikis

        
        // DB'ye query'i execute eder
        $baglanti->query($query);
 }
        
?>
       
       
       
       
       
        
        