<?php
session_start();

if((isset($_SESSION['loginin'])) && ($_SESSION['loginin']==true)){
	header('Location: strona_glowna.php');
	exit();
}

$errorLogin = '';
$errorPassword = '';
$error= '';

$login='';
$password='';

//-
$emailm = '';
$tittlem = '';
$contestm='';

$errorEmailm = '';
$errorTittlem = '';
$errorContestm='';

if ( isset( $_POST['sentm'] ) ) {
	$tittlem = $_POST['tittlem'];
	$emailm = $_POST['emailm'];
	$contestm = $_POST['contestm'];
	if ( ! $emailm ) {
		$errorEmailm = 'Uzupełnij pole email';
	} elseif ( $emailm && ! filter_var($emailm, FILTER_VALIDATE_EMAIL) ) {
		$errorEmailm = 'Upewnij się, że adres email ma prawidłowy format';
	}
	if ( ! $tittlem ) {
		$errorTittlem = 'Uzupełnij pole tytuł:';
	} elseif ( $tittlem && strlen($password) < 3 ) {
		$errorPassword = 'Tytuł musi zawierać minimum 3 znaki';
	}
	if (! $contestm) {
		$errorContestm = 'Wpisz treśc wiadomości.';
	}
	/* wysylamy email */
	if ( ! $errorEmailm && ! $errorTittlem && ! $errorContestm ) {
		$to = 'wabtomek@wp.pl';
		$from = $emailm;
		$subject = $tittlem;
		$message = $contestm;
		$emailSent = mail($to,$from, $subject, $message);
		
		echo '<script type="text/javascript">'; 
						echo 'alert("Wiadomość została wysłana!");'; 
						echo 'window.location.href = "index.php";';
						echo '</script>';
	}

}


	

require_once 'polaczenie_db.php'; 


//Sprawdza czy formularz został wysłany (kliknieto przycisk wyslij) 
if ( isset( $_POST['send'])){
	
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	if (! $login ){
		$errorLogin = 'Podaj login użytkownika!';
	}
	if (! $password ){
		$errorPassword = 'Podaj hasło użytkownika!';
	}

	elseif($rs = @$mysqli->query("SELECT * FROM uzytkownik WHERE login='$login' AND password='$password'")){
			
			$users = $rs -> num_rows;
			if($users>0){
				$row =$rs->fetch_assoc();
				
				$_SESSION['loginin'] = true;
		$_SESSION['imie'] = $row['imie'];
		$_SESSION['nazwisko'] = $row['nazwisko'];
		$_SESSION['login'] = $row['login'];
		$_SESSION['password'] = $row['password'];
	
		
		
		
		unset($_SESSION['error']);
		$rs ->free_result();
		header('Location: strona_glowna.php');
			}
			else{
				$_SESSION['error'] ='<b>Błędny login lub hasło</b>!';
				header('Location: index.php');
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

	
      <h3>Logowanie</h3>
	  </br>
     
					<form method="post" action="index.php">
					
						
							<?php if ($errorLogin != null) {?>
								<span class="btn-default">
								 <?php echo $errorLogin; ?>
								</span>
								<?php } ?>
							 <input type="text" class="form-control" name="login" placeholder="Login">							
		
					</br>
	
						<?php if ($errorPassword != null) {?>
								<span class="btn-default">
								 <?php echo $errorPassword; ?>
								</span>
								<?php } ?>
						
							<input type="password" class="form-control" name="password" placeholder="Hasło">
					
					</br>	
							
						<input type="submit" class="btn btn-default right" name="send" value="Zaloguj"></input>
						
					</form>
					<?php
					if(isset($_SESSION['error'])){?>
						<span class="btn-default">
						<?php echo $_SESSION['error'] ?>
						</span>
					<?php } ?>
	</br>
						<p>Nie masz konta ? <a href="rejestracja.php">Zarejestruj się !</a></p>
	
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
	
	<form method="post" action="kontakt.php">
	  <h3 class="text-center" >Napisz do mnie:</h3>
	  </br>
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6 form-group">
		
		<label>Tytuł: </label>
		</br>
		<?php if ( $errorTittlem != null ) { ?>
								<span class="btn-danger">
									<?php echo $errorTittlem; ?>
								</span>
							<?php } ?>
          <input class="form-control" id="name" name="tittlem" placeholder="Tytuł" type="text" >
        </div>
		   <div class="col-sm-6 form-group">
		<label>Adress E-mail: </label>
		</br>
     <?php if ( $errorEmailm != null ) { ?>
								<span class="btn-danger">
									<?php echo $errorEmailm; ?>
								</span>
							<?php } ?>
          <input class="form-control" id="email" name="emailm" placeholder="Email" type="email" >
        </div>
      
	  <div class="col-sm-12 form-group">
			<label>Treść: </label>
					</br>
					<?php if ( $errorContestm != null ) { ?>
								<span class="btn-danger">
									<?php echo $errorContestm; ?>
								</span>
							<?php } ?>
      <textarea class="form-control" id="comments" name="contestm" placeholder="Treść wiadomości" rows="10" ></textarea>
	  <br>
	  </div>
     
        <div class="col-sm-6 form-group">
         <input type="submit" class="btn btn-default" name="sentm" value="Wyslij"></input>
        </div>

    </div>
  </div>
  
   
   </form>	
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