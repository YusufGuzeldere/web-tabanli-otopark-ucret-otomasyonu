<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Otopark Yönetim Sistemi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap v5.1.3 CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="login">

        <h1 class="text-center">Hoş Geldiniz</h1>
        
        <form class="needs-validated" action="Login.php" method="POST">
            <div class="">
                <label class="form-label" for="text">Kullanıcı Adı</label>
                <input class="form-control" type="text" name="username" required>
                <div class="invalid-feedback">
                    Lütfen Kullanıcı Adını Giriniz
                </div>
            </div>
            <div class="form-group needs-validated">
                <label class="form-label" for="password">Parola</label>
                <input class="form-control" type="password" name="password" required>
                <div class="invalid-feedback">
                    Lütfen Parolanızı Giriniz
                </div>
            </div>
            
            <input class="btn btn-success w-100" type="submit" value="Giriş Yap">
        </form>

    </div>

</body>

</html>
<?php
            include("baglanti.php");


if($_SERVER['REQUEST_METHOD']=='POST')
{

    $kullaniciadi=$_POST['username'];
    $parola=$_POST['password'];

    $sec="Select * from personel where kullaniciadi='".$kullaniciadi."'";
    $son=$baglanti->query($sec);
    $son=$son->fetch_assoc();
    
    if(!is_array($son)) // kullanici yoksa
    {
        echo "Kullanıcı Adı Yanlış";
    }
    else // kullanıcı bulunduysa
    {
        if($son['parola']==$parola){ // parola dogruysa
            header("Location: http://localhost/WebProje/İşle.php", true, 301);
        }
        else
        {
            echo "Parola Yanlış";
        }
        
    }
}
    
?>