<?php
$errorImie ='';
$errorNazwisko ='';
$errorMiasto ='';
$errorLogin = '';
$errorPassword = '';
$errorEmail='';

$imie='';
$nazwisko='';
$miasto='';
$login='';
$password='';
$email='';

session_start();
require_once 'polaczenie_db.php'; 

	//--
	if ( isset( $_POST['register'])){
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$miasto = $_POST['miasto'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$OK=true;
	
	if (! $imie ){
		$errorImie = 'Podaj swoje imię !';
		$OK=false;
	}
	else{
		$OK=true;
	}
	if (! $nazwisko ){
		$errorNazwisko = 'Podaj swoje nazwisko !';
		$OK=false;
	}
	else{
			$OK=true;
	}
	if (! $miasto ){
		$errorMiasto = 'Podaj swoje miasto zamieszkania !';
		$OK=false;
	}
	else{
			$OK=true;
	}
	
	if (! $login ){
		$errorLogin = 'Podaj login użytkownika!';
		$OK = false;
	}
	else{
		
		$rezultat2 = $mysqli->query("SELECT uzytkownik_id FROM uzytkownik WHERE login='$login'");
		$ile_takich_nickow = $rezultat2->num_rows;
			if($ile_takich_nickow>0)
				{
					$OK=false;
					$errorLogin="Istnieje już gracz o takim nicku! Wybierz inny.";
					
				}
				else{
					$OK=true;
				}
	}
	
	
	
	if (! $password ){
		$errorPassword = 'Podaj hasło użytkownika!';
		$OK=false;
	}
	else{
			$OK=true;
	}
	
	if($password && strlen($password)< 6 ){
		$errorPassword = 'Hasło musi zawierać min. 6 znaków!';
		$OK=false;
	}
	else{
			$OK=true;
	}
	if (! $email){
		$errorEmail = 'Podaj swój adress E-mail !';
		$OK=false;
	}
	else{
			$OK=true;
	}
	if (!$email && ! filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorEmail = 'Zle podany email!';
		$OK=false;
	}
	else{
		
		$rezultat = $mysqli->query("SELECT uzytkownik_id FROM uzytkownik WHERE email='$email'");
		$ile_takich_maili = $rezultat->num_rows;
		
			if($ile_takich_maili>0)
				{
					$OK=false;
					$errorEmail="Adress E-mail zajęty! Wybierz inny";
				}
				else{
						$OK=true;
				
				}
				
	}
	
	if ($OK==true){
					
					if ($mysqli->query("INSERT INTO uzytkownik VALUES (NULL, '$imie', '$nazwisko', '$miasto','$login','$password','$email')"))
					{
												
						echo '<script type="text/javascript">'; 
						echo 'alert("Konto zostało stworzone! Możesz się teraz zalogować");'; 
						echo 'window.location.href = "index.php";';
						echo '</script>';
						
					
					}
				
					
				}
	
			}
			
	
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Praktyczna Encyklopedia Komputerowa</title>
  <meta charset="utf-8">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">	
	<script src="jq/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	
</head>
<body>
<div class ="reservoir">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">pekomputerowa.com.pl</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
	   <li><a href="index.php">STRONA GŁÓWNA</a></li>
        <li><a href="encyklopediaout.php">ENCYKLOPEDIA</a></li>
        <li><a href="kontakt.php">KONTAKT</a></li>
      
      </ul>
    </div>
  </div>
</nav>

<div class="main">
	<div class="jumbotron text-center">
	<h1>Praktyczna Encyklopedia Komputerowa</h1> 
	<p>Stworzona przez Tomasz Waberski</p> 
	</br>
	<form class="form-inline" method="get" action="encyklopediaout.php">
    <div class="input-group">
      <input type="text" name="wyrazenie" class="form-control" size="50" placeholder="Podana fraza">
	  
      <div class="input-group-btn">
        <input type="submit" name="buttons" class="btn btn-danger" value="Szukaj"></input>
      </div>
    </div>
  </form>
	</div>	

	<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
   <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
    <h4>"Wyobraźnia bez wiedzy może stworzyć rzeczy piękne. Wiedza bez wyobraźni najwyżej doskonałe."<br><span style="font-style:normal;">Albert Einstein , wyobraźnia, wiedza</span></h4>
    </div>
    <div class="item">
      <h4>"Czytać to bardziej żyć, to żyć intensywniej!"<br><span style="font-style:normal;">Carlos Ruiz Zafón , Cień wiatru, Życie</span></h4>
    </div>
    <div class="item">
      <h4>"Iteracja jest rzeczą ludzką, rekursja boską."<br><span style="font-style:normal;">L. Peter, Programista, Deutsch</span></h4>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">

    <span class="sr-only">Wstecz</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
  
    <span class="sr-only">Dalej</span>
  </a>
</div> 
<!--

Indicators -->

<div class="container-fluid text-center">    
  <div class="row content" id="rc">
    <div class="col-sm-3 sidenav">
	<hr>

   <h3>Ostatnio dodane słowa:</h3>
<?php 
					
					$resultis = $mysqli->query("SELECT fraza FROM kompedium ORDER BY kompedium_id DESC LIMIT 5");
					while ( $articles = mysqli_fetch_array($resultis) ) {
						echo '<h5><b> ' .strtoupper( $articles['fraza']) . '</b></h5>';
					
						
					}
					
		
					?>
	<br/>
	
	<hr>
	
   <h3>Ciekawe pojęcia:</h3>
  
  <?php 
					
					$resultis = $mysqli->query("SELECT fraza, tresc FROM kompedium ORDER BY kompedium_id DESC LIMIT 1");
					while ( $articles = mysqli_fetch_array($resultis) ) {
						echo '<h5><b> ' .strtoupper( $articles['fraza']) . '</b></h5>';
						echo '</br>';
						echo '<p>' . $articles['tresc'] . '</p>';
						echo '</br>';
					
						
					}
		
					?>
	 
	  
	  
    </div>
	
    <div class="col-sm-6 text-left"> 
	<hr>
      <h2>Zakładanie nowego konta !</h2>
	  </br>
	 
	  
    <form method="post" action="rejestracja.php">
	 <div class="col-sm-7 form-group">
								<label>Imię: </label>
								</br>
							<?php if ($errorImie != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorImie; ?>
								</span>
								<?php } ?>
								 
							 <input type="text" class="form-control" name="imie" placeholder="Imię">					
		</div>
					</br> 
					<div class="col-sm-7 form-group">
					<label>Nazwisko: </label>
					</br>
							<?php if ($errorNazwisko != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorNazwisko; ?>
								</span>
								<?php } ?>
								
							 <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko">							
		</div>
					</br> 
					<div class="col-sm-7 form-group">
					<label>Miasto: </label>
					</br>
							<?php if ($errorMiasto != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorMiasto; ?>
								</span>
								<?php } ?>
								
							 <input type="text" class="form-control" name="miasto" placeholder="Miejscowość/Miasto">							
		</div>
					</br>
					<div class="col-sm-7 form-group">
					<label>Nazwa użytkownika (Login): </label>
</br>					
							<?php if ($errorLogin != null) {?>
								<span class="btn-danger btn-default">
								  <?php echo $errorLogin; ?>
								</span>
								<?php } ?>
								
											
							 <input type="text" class="form-control" name="login" placeholder="Login">							
		</div>
					</br>
					<div class="col-sm-7 form-group">
					<label>Hasło: </label>
					</br>
							<?php if ($errorPassword != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorPassword; ?>
								</span>
								<?php } ?>
							
							 <input type="password" class="form-control" name="password" placeholder="Hasło">							
		</div>
					</br> 
					<div class="col-sm-7 form-group">
					<label>Adress e-mail: </label>
					</br>
							<?php if ($errorEmail != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorEmail; ?>
						
								</span>
								<?php } ?>
														
							
							 <input type="text" class="form-control" name="email" placeholder="E-mail">							
		</div>
					</br>
					</br>
					  <div class="col-sm-6 form-group">
						<input type="submit" class="btn btn-default right" name="register" value="Zarejestruj!"></input>
						</div>
					
					</form>
   </div>
	
    <div class="col-sm-3 sidenav">
	<hr>
	<h4>Godzina:</h4>
	<div id="zegarek" style="FONT-WEIGHT:bold;font-size:18px;COLOR:#03263E; MARGIN-RIGHT: 4PX;"></div>
<script type="text/javascript">
function zegar() {
var data = new Date();
var godzina = data.getHours();
var min = data.getMinutes();
var sek = data.getSeconds();
 var terazjest = ""+godzina+
((min<10)?":0":":")+min+
((sek<10)?":0":":")+sek;
document.getElementById("zegarek").innerHTML = terazjest;
setTimeout("zegar()", 1000); }
zegar();
</script>
</br>
<hr>
	
	<h4>Wszystkie Kategorie:</h4>
	 	<?php 
					
					$resultis = $mysqli->query("SELECT nazwa FROM kategoria ORDER BY kategoria_id");
					while ( $articles = mysqli_fetch_array($resultis) ) {
						echo '<h5><b> ' .strtoupper( $articles['nazwa']) . '</b></h5>';
					
						
					}
		
					?>
	  </br>
<hr>	
	<h4>Ostatnio dodane Kategorie:</h4>
     
	 	<?php 
					
					$resu = $mysqli->query("SELECT nazwa FROM kategoria ORDER BY kategoria_id DESC LIMIT 5");
					while ( $articles = mysqli_fetch_array($resu) ) {
						 $resu -> fetch_array();
						echo '<h8><b> ' .strtoupper( $articles['nazwa']) . '</b></h8>';
						echo '</br>';
						
					}
			
					$mysqli -> close();
		
					?>
	 
	  <hr>
	
    </div>
  </div>
</div>

<div class="container-fluid bg-2 text-center" id="last">
</br>
  <h4>Moja encyklopedia w sieci:</h4>
 
	<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="#" class="fa fa-youtube"></a>
<a href="#" class="fa fa-instagram"></a>
<a href="#" class="fa fa-pinterest"></a>
<a href="#" class="fa fa-snapchat-ghost"></a>
<a href="#" class="fa fa-skype"></a>
<a href="#" class="fa fa-android"></a>
<a href="#" class="fa fa-dribbble"></a>
<a href="#" class="fa fa-vimeo"></a>
<a href="#" class="fa fa-tumblr"></a>
<a href="#" class="fa fa-vine"></a>
<a href="#" class="fa fa-foursquare"></a>
<a href="#" class="fa fa-stumbleupon"></a>
<a href="#" class="fa fa-flickr"></a>
<a href="#" class="fa fa-yahoo"></a>
<a href="#" class="fa fa-reddit"></a>
<a href="#" class="fa fa-rss"></a>
</br>
  </br>
</div>

</div>

<footer class="container-fluid text-center">
</br >
  <p>pekomputerowa 2018 - Created by Tomasz Waberski © Wszelkie prawa zastrzeżone</p>
</footer>

</div>
</body>
</html>