<?php
session_start();
require_once("database_connect.php");
// ako uradimo submit upisujem nove podatke u tabelu
if(isset($_POST['submit'])){
	$slika_postojeca = $_POST['slika_postojeca'];
	//upis slike
	/*if ($_FILES["slika"]["error"] > 0)
	  {
	  echo "Error: " . $_FILES["slika"]["error"] . "<br>";
	  }*/
	if($slika_postojeca == "nema"){//ako slika uz tekst nije postojala u bazi pre izmene dogadjaja upisi novu sliku u bazu  
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
			echo "<span style='color:green'>Slika uz tekst je uspesno uploudovana</span><br/><br/>";
		}else{
			 echo ( "<span style='color:red'>Slika uz tekst nije uspesno uploudovana! 
			 	Proverite da li je manja od 1MB i da je jpeg, gif ili png format.</span><br/><br/>");
 		}
	}
	else{
		$path = 0;
		echo "<span style='color:red'>Niste izabrali sliku uz tekst ili je slika veca od 1MB!</span>";//ako slika nije uplodovana nema linka
	}//kraj upisa slike 
	} 
    else{$path = $slika_postojeca;}//ako slika jeste postojala upisi staru vrednost
	$id = $_SESSION['id'];
	$data = mysql_real_escape_string(trim($_POST['data']));
	$dan = $_POST['dan']; 
	$mesec = $_POST['mesec']; 
	$godina = $_POST['godina'];  
	$query = "UPDATE slajd SET title = '$data', dan = $dan ,mesec = $mesec, godina = $godina, path = '$path' WHERE id = $id;";
	//echo '<br>Izraz za upis u bazu: '.$query;
	$result = mysql_query($query); 
	if (mysql_errno()) { 
 		echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query\n<br>";
	}
	die (" 
	<span style='color:green'>izmena uspesna</span><br />
    <br />
    <br />
	<a href='adminIndex.php'>Glavni meni</a>");	
}
$id = $_GET['id'];
$_SESSION['id'] = $id;
$query = ("SELECT * FROM slajd WHERE (id = $id);");
//				 echo "$query<br />";
$result = mysql_query($query);
//echo '<br>'.$query;
	if (mysql_errno()) { 
 		echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$query2\n<br>";
	}
$row = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Izmena slider-a</title>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript">
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
 //*************************************brisanje slike**********************************


function brisanjeSlike(){
var id = <?php echo $id; ?>;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("slika").innerHTML='<span style="color:green">Slika je obrisana!</span><br /><input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576"><input type="file" name="slika" id="slika" value="Izaberite sliku" />Unesite sliku<br /><input type="hidden" value="nema" name="slika_postojeca" id="slika_postojeca" />';
    }
  }
xmlhttp.open("GET","Scripts/obrisi_sliku_slider.php?id="+id,true);
xmlhttp.send();
}
</script>

</head>

<body>
<div id="forma" style="display:block">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
  
    <table width="800" border="0" cellspacing="10" cellpadding="10">
      <tr>
        <td>Tekst</td>
        <td><textarea id="data" name="data" cols="190" rows="5"><?php echo $row['title'];?>
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
        <td> Trenutna slika uz tekst: </td>
        <td id="slika">
		      <?php 
 		        if($row['path']== '0') {//ako slika nije uneta
			     echo('<span style="color:red">Trenutno nije uneta slika</span><br />
				 <input style="width:180px" type="hidden" name="MAX_FILE_SIZE" value="1048576">
          <input type="file" name="slika" id="slika" value="Izaberite sliku" />
		   <input type="hidden" value="nema" name="slika_postojeca" id="slika_postojeca" />');//ako nema slike primi fajl 
				 }
                 else{// ako je uneta ponudi brisanje
				 echo ('<img src="'.$row['path'].'" width="180px"/>');//prikazi sliku
                    //prosledi bazi path do stare slike
					echo '<input type="hidden" value="'.$row['path'].'" name="slika_postojeca" />';
				    //ponudi brisanje
				   echo "<input type="; if($row['path']!= '0') {echo 'button';} else echo('hidden');echo" id='obrisiSliku' value='Obriši sliku' onclick='brisanjeSlike()' /></td>";}?>
    
          </td>
      </tr>
    </table>
    <input type="submit" name="submit" value="Upiši slajd">
    </form>
    <br />
    <br />
    <br />
	<a href='adminIndex.php'>Glavni meni</a> 

    </div><!-- forma-->
</body>
</html>