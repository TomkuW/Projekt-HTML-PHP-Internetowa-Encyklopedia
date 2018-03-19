<?php
session_start();



if(!isset($_SESSION['loginin'])){
	header('Location: index.php');
	exit();
}


$stare =null;
$nowe =null;
$nowe2 =null;

$errorStare ='';
$errorNowe ='';
$errorNowe2= '';
$error1='';
$error2='';
require_once 'polaczenie_db.php'; 

if ( isset( $_POST['chpassword'])){
	$stare = $_POST['oldpassword'];
	$nowe = $_POST['newpassword'];
	$nowe2 = $_POST['newpassword2'];

	$isOK=true;

	if (!$stare){
	$errorStare = 'Podaj stare hasło!';
		$isOK=false;
		
	}
	else{
		$isOK=true;
	}
	
	if (! $nowe ){
		$errorNowe = 'Podaj nowe hasło';
		$isOK=false;
	}
	else{
		$isOK=true;
	}
	
	if (! $nowe2 ){
		$errorNowe2 = 'Powtórz nowe hasło';
		$isOK=false;
	}
	else{
		$isOK=true;
	}

	
		if ( $nowe != $nowe2){
		$error1 ='<b>Hasła nie są takie same!</b>!';
		$isOK=false;
		}else{
			$isOK=true;
		}
	
	
		if(strcasecmp($stare, $_SESSION['password']) != 0){
			$error2 ='<b>Błędne stare hasło</b>';
			$isOK=false;
		
		}else{
			$isOK=true;
		}
		


				if ($isOK==true){
					
					if ($mysqli->query( "UPDATE uzytkownik SET password='$nowe' WHERE login='".$_SESSION['login']."'"))
					{
								unset($_SESSION['password']);
								$_SESSION['password'] = $nowe;	
								
						echo '<script type="text/javascript">'; 
						echo 'alert("Hasło zostało zmienione!");'; 
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
        <li><a href="encyklopedia.php">ENCYKLOPEDIA</a></li>
      <li><a href="kategoria.php">DODAJ KATEGORIE</a></li>
        <li><a href="dodajpozycje.php">DODAJ SŁOWO</a></li>
      <li><a href="wyloguj.php">WYLOGUJ</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="main">
	<div class="jumbotron text-center">
	<h1>Praktyczna Encyklopedia Komputerowa</h1> 
	<p>Stworzona przez Tomasz Waberski</p> 
	</br>
	<form class="form-inline" method="get" action="encyklopedia.php">
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

	
        <h3>Profil</h3>
	  
	  <div class="media">
		<div class="media-left">
			<img src="img/img_avatar.png" class="media-object" style="width:60px">
			</div>
				<div class="media-body">
				
				<h4 class="mt-0">  <?php echo "<p><b>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</b>!</p></br>";?></h4>
			
			</div>
	 </div>
	  	 </br>
	  <?php echo '<p><b><a href="zmiana_hasla.php">Zmień hasło</a></b></p>'; 
	  echo '<p><b><a href="kategoria.php">Dodaj Kategorię</a></b></p>'; 
	   echo '<p><b><a href="dodajpozycje.php">Dodaj słowo</a></b></p>'; 
	   echo '<p><b><a href="wyloguj.php">Wyloguj</a></b></p>'; ?>
	  
     
					
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
     
	   <h4>Zmień hasło:</h4>
	
   </br>
   
	<form method="post" action="zmiana_hasla.php">
		<div class="col-sm-12">
			
				<div class="col-sm-7 form-group">
				<label>Stare hasło: </label>
					</br>
								<?php if ($errorStare != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorStare; ?>
								</span>
								<?php } ?>
					<input class="form-control"  name="oldpassword" placeholder="Stare hasło" type="text">
				</div>
				<div class="col-sm-7 form-group">
				<label>Nowe hasło: </label>
					</br>
								<?php if ($errorNowe != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorNowe; ?>
								</span>
								<?php } ?>
					<input class="form-control"  name="newpassword" placeholder="Nowe hasło" type="text">
				</div>
				<div class="col-sm-7 form-group">
				<label>Potwierdź nowe hasło: </label>
					</br>
								<?php if ($errorNowe2 != null) {?>
								<span class="btn-danger btn-default">
								 <?php echo $errorNowe2; ?>
								</span>
								<?php } ?>
					<input class="form-control"  name="newpassword2" placeholder="Powtórz nowe hasło" type="text">
				</div>
      
				</br>
				
				
				<div class="col-sm-6 form-group">
						<input type="submit" class="btn btn-default" name="chpassword" value="Zmień hasło"></input>
				</div>
			
		</div>
		</form>	
		<div class="col-sm-7 form-group">
					<?php if ($error1 != null) {?>
								<span class=" btn-default">
								 <?php echo $error1; ?>
								</span>
								<?php } ?>
								<?php if ($error2 != null) {?>
								<span class=" btn-default">
								 <?php echo $error2; ?>
								</span>
								<?php } ?>
		
		</div>
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