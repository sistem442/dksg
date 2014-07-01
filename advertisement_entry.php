<?php 
session_start();
require_once("database_connect.php");
if (!isset($_SESSION['user'])) {
	echo "Niste prijavljeni!<br />
 <a href='login.php'>Prijava</a>
<br />";
}
	//************************************Prikazujem koliko ima starih slajdova i nudim brisanje
		$mesec = date('n');
		$godina = date('Y');
		$query = "SELECT COUNT(*) as Num FROM advertisement WHERE ((mesec < $mesec AND godina = $godina) ||  godina < $godina);";
		//echo $query;
		$broj_starih_slajdova = mysql_result(mysql_query($query),0); 
		if (mysql_errno()) { 
 			echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
		}
		echo 'Broj starih slajdova jeste: '.$broj_starih_slajdova.' <a href="javascript:delete_multi_slides()">Obrisi</a><br/>';
		
	//****************************************Ako nije unet id prikazujem samo formu za unos id
	if(isset($_POST['submit'])){ 
		$id = $_POST['id'];
		require_once("database_connect.php");
		$query = "SELECT * FROM advertisement WHERE id = $id;";
		//echo $query;
		$result = mysql_query($query); 
		$row = mysql_fetch_assoc($result);
		$_SESSION['id'] = $row['id']; 
	}
	else { $id = 0;}
//**********************************************Ako je id unet prikazujem formu za unos dogadjaja
if(isset($_POST['submit2'])){
	$id = $_SESSION['id'];
	$data = mysql_real_escape_string(trim($_POST['data']));
	$link = 'http://www.dksg.rs/oneEventDisplay.php?id='.$id;
	$dan = $_POST['dan']; 
	$mesec = $_POST['mesec']; 
	$godina = $_POST['godina'];  
	//upis slike
	/*if ($_FILES["slika"]["error"] > 0)
	  {
	  echo "Error: " . $_FILES["slika"]["error"] . "<br>";
	  }*/
	if($_FILES['slika']['size'] > 0){
		$fileName = rand(1000000,9999999);
		$fileType =  rtrim(substr( $_FILES['slika']['type'],6,6));
		$uploadFolder = "slider_slike/";// upload folder
		//ako se koristi tupavi IE za upload umesto jpeg bice pjpeg!?! Zato mora ovo
		if($fileType == "pjpeg")$fileType = "jpeg";//tip fajla
		$path = $uploadFolder.$fileName.".".$fileType;
		//echo '<br/> path je '.$path; 
		//copy file to where you want to store file
		$copy = copy($_FILES['slika']['tmp_name'], $path);
		// prompt if successfully copied
		if($copy){
			echo "<span style='color:green'>Slika uz tekst je uspešno uploudovana</span><br/><br/>";
		}else{
			 echo ( "<span style='color:red'>Slika uz tekst nije uspešno uploudovana! 
			 	Proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span><br/><br/>");
 		}
	}
	else{
		$path = 0;
		echo "<span style='color:red'>Niste izabrali sliku uz tekst ili je slika veca od 1MB!</span>";//ako slika nije uplodovana nema linka
	}//kraj upisa slike 	
	$query2 = "INSERT INTO advertisement (id,title,path,link,dan,mesec,godina) VALUES ( $id,'$data','$path','$link',$dan,$mesec,$godina)";
	$result2 = mysql_query($query2);
	//echo '<br>Izraz za upis u bazu: '.$query2;
	if (mysql_errno()) { 
 		echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>";
	}
	else{
		echo '<span style="color:green">Slajd je uspesno upisan!</span><br />
				<a href="adminIndex.php">index</a>';
		$id = 0;	
	}
	if(!$result2){
		die("
		  <span style='color:red;'><br />
		  <br />
		  Greska u izvrsavnju SQL izraza za upis slajda!</span><br /><a href='adminIndex.php'>index</a>");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unos slajdova</title>
<link href="backEnd.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){		
//******************************* Prikazivanje sadrazaja	
var flag = <?php echo $id;?>;
if (flag == 0){
	//alert('flag je '+flag);
	$('#id_forma').css("display","block");
	$('#forma').css("display","none");
}else{
	//alert('flag je '+flag);
	$('#id_forma').css("display","none");
	$('#forma').css("display","block");	
}
});
///*********************Funkcije koje omogucavaju formatiranje teksta**********************************
tinymce.init({
    selector: "textarea#data",
    theme: "modern",
    width: 480,
    height: 100,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "main.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons | textcolor| fullscreen ", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
 //******************************** Brisanje starih slajdova
function delete_multi_slides(){
var jqxhr = $.post("slider_multi_delete.php", function() {})
.done(function() { alert("Stari slajdovi su obrisani"); })
.fail(function() { alert("error"); })
.always(function() { location.reload(); });
}
</script>
</head>
<body style="color:black; font-size:18px; font-family:Arial, Helvetica, sans-serif;" id="container">
<div class="container2">
  <div class="blueBold">Advertisement entry</div>
  <br />
  <div id='id_forma' style="display:none">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      <input type="text" name="id">
      <br>
      <input type="submit" name="submit" value="Prikaži podatke">
      <br>
    </form>
  </div>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
  <div id="forma" style="display:none">
    <table width="800" border="0" cellspacing="10" cellpadding="10">
      <tr>
        <td>Tekst</td>
        <td><textarea id="data" name="data" cols="190" rows="5">
			<?php 
			if ($row['nadnaslov'] != '') {echo $row['nadnaslov'].'<br/>';} 
			echo $row['imePrograma'];
			if ($row['podnaslov'] != '') {echo '<br/>'.$row['podnaslov'];} 
			/*if($row['vreme_mesto'] != '') echo '<br/>'.$row['vreme_mesto'];*/?>
			</textarea></td>
      </tr>
      <tr>
        <td>Dan</td>
        <td><input type="number" name="dan" value="<?php echo $row['dan'];?>"/></td>
      </tr>
      <tr>
        <td>Mesec</td>
        <td><input type="number" name="mesec" value="<?php echo $row['mesec'];?>"/></td>
      </tr>
      <tr>
        <td>Godina</td>
        <td><input type="number" name="godina" value="<?php echo $row['godina'];?>"/></td>
      </tr>
      <tr>
        <td>Slika</td>
        <td><input style="width:480px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
          <input type="file" name="slika" id="slika" width="300px" /></td>
      </tr>
    </table>
    <input type="submit" name="submit2" value="Upiši slajd">
    </form>
    <br />
    <br />
    <br />
	<a href='adminIndex.php'>Glavni meni</a> 
    </div><!-- forma-->
</div> 
<!-- container-->
</body>
</html>
