<?php session_start(); 
//konekcija sa bazom
require_once("database_connect.php");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//izbor baze
$id = $_GET['id'];
$query = ("SELECT * FROM event WHERE (id = $id);");
				 //echo "$query<br />";
$result = mysql_query($query);
if(mysql_num_rows($result)==0){
	die ("Došlo do greške pokušajte kasnije");
	}
$row = mysql_fetch_array($result);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"  xmlns:fb="http://ogp.me/ns/fb#">
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $row['imePrograma']?></title>
<meta http-equiv="keywords" content=" <?php echo $row['imePrograma'].", ".$row['imePrograma']?>, dom ,kulture, studentski, grad, velika, sala, mala, studio, radionica, skola, ">
<meta http-equiv="description" content="Dom kulture Studentski grad (DKSG) svojim sadržajem pokriva sve oblasti umetnosti, a većina programa je besplatna.">
<link rel="shortcut icon" href="http://dksg.rs/favicon.ico" type="image/x-icon" />
<link rel="icon" href="http://dksg.rs/favicon.ico" type="image/ico" />
<META name="abstract" content="dom kulture u studentskom gradu u beogradu">
<LINK href="http://dksg.rs/reset.css" rel="stylesheet" type="text/css">
<LINK href="http://dksg.rs/main.css" rel="stylesheet" type="text/css">
<STYLE id="tmpStyle" type="text/css" disabled="">
#pic {
	-moz-opacity:0.00;
	filter:alpha(opacity=0);
	opacity:0;
	-khtml-opacity:0;
}
</STYLE>
<SCRIPT src="http://dksg.rs/jquery-1.10.1.min.js" type="text/javascript" charset="utf-8"></SCRIPT>

<!-- Fancybox -->
	<link rel="stylesheet" type="text/css" href="http://dksg.rs/css/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="http://dksg.rs/css/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="http://dksg.rs/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="http://dksg.rs/jquery.fancybox-buttons.js?v=1.0.5"></script>
    
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<SCRIPT src="http://dksg.rs/ui_nav.js" type="text/javascript" charset="utf-8"></SCRIPT>
<script type="text/javascript">
$(document).ready(function() {
	$('.fancybox-buttons').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',

		prevEffect : 'none',
		nextEffect : 'none',

		closeBtn  : false,

		helpers : {
			title : {
				type : 'inside'
			},
			buttons	: {}
		},

		afterLoad : function() {
			this.title = 'Slika ' + (this.index + 1) + ' od ' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});
});

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16499062-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  function otvori_kliping(id) {
     var prozor, aw, ah;
     ah = screen.availHeight * .85;
     aw = screen.availWidth * .85;
     prozor = window.open('kliping_display_one.php?id=' + id, 'pregled', 'toolbar=0,location=0,status=0,scrollbars=1,width=' + aw + ',height=' + ah + ',left=' + aw * .025 + ',top=' + ah * .01)
}
</script>
</HEAD>
<SCRIPT src="http://dksg.rs/ga.js" type="text/javascript"></SCRIPT>

<BODY>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<DIV id="content">
  <DIV id="header">
    <?php include_once("heder.php") ?>
  </DIV>
  <div id="menu">
    <?php include_once("menu.php"); ?>
  </div>
  <DIV id="mainBig">
    <?php

//**************************************************************************blok koji prikazuje sliku i sliku uz tekst
 			  $program = $row['program'];
			  switch($program)
			  {
				  case 'likovni':
				  $program2 = 'Likovni program';
				  break;
				  case 'filmski':
				  $program2 = 'Filmski program';
				  break;
				  case 'pozorisni':
				  $program2 = 'Pozorišni program';
				  break;
				  case 'muzicki':
				  $program2 = 'Muzički program';
				  break;
				  case 'biblioteka':
				  $program2 = 'Biblioteka';
				  break;
				  case 'afc':
				  $program2 = 'Akademski filmski centar';
				  break;
				  case 'forum':
				  $program2 = 'Forum';
				  break;
				  case 'ostali':
				  $program2 = 'Ostali programi';
				  break;
				  case 'radionica':
				  $program2 = 'Radionica';
				  break;
				  case 'obavestenje':
				  $program2 = 'Obaveštenje';
				  break;
				  case 'knjizevni':
				  $program2 = 'Književni program';
				  break;
				  case 'politicki':
				  $program2 = 'Društveno politički program';
				  break;
				  case 'naucni':
				  $program2 = 'Naučno obrazovni program';
				  break;
				  case 'kontakt':
				  $program2 = 'Kontakt program';
				  break;
				  default:
				   echo' ';  
				   
				 
			  }
			  $remark = new remark();
			  echo "<div style='min-height:300px'>".$row['dan'].". ".$row['mesec'].". ".$row['godina'].".| <strong>$program2</strong><br/><span class='remark'>".$remark->get_remark($row['id'])."</span>";
			  echo"<hr>";
			  if($row['slika']!= '0'){
				  echo"<a href='http://dksg.rs/".$row['slika']."'><img style='float:left; padding-right:10px' src='http://dksg.rs/".$row['slika']."' width='150px'></a>";}
  			if($row['izmena'] == '')$izmena = '';
				else $izmena = '<span style="color:red">'.$row['izmena'].'</span></br>';
                  echo $izmena;
				  echo $row['tekst']."<br/>
				  <br/></div>";
/*****************************Prikaz  vrsta materijala***********************/				 
				  $query400 = "SELECT id FROM mat_fotografija WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = "Fotografija";
				  else $temp = '';
				  $query400 = "SELECT id FROM mat_katalog WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp." Katalog";
				  else $temp = $temp.'';
				  $query400 = "SELECT id FROM mat_plakat WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp.", Plakat";
				  else $temp = $temp.'';
				  $query400 = "SELECT id FROM mat_pozivnica WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp." Pozivnica";
				  else $temp = $temp.'';
				  $query400 = "SELECT id FROM mat_program WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp." Program";
				  else $temp = $temp.'';
				  $query400 = "SELECT id FROM mat_publikacija WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp." Publikacija";
				  else $temp = $temp.'';
				  $query400 = "SELECT id FROM mat_video WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp." Video";
				  else $temp = $temp.'';
				  $query400 = "SELECT id FROM mat_zvuk WHERE id = $id";
				  $result400 = mysql_query($query400);
				  if (mysql_num_rows($result400) > 0)
				  $temp = $temp." Audio snimak";
				  else $temp = $temp.'';
				  
				  if ($temp !='') echo "Vrste materijala u arhivi: ".$temp."<br/>"; 
				  
				  if ($row['signature'] !='') echo "<br/>Signature: ".$row['signature']."<br/>";
//kraj bloka za tekst
//*****************************************************************blok koji prikazuje sve fajlove vezane za dogadjaj
//prikaz slika
if($row['fotograf'] != 'nema') $fotograf = ' foto: '.$row['fotograf']; else $fotograf = ''; 
echo '<br/><br/>'.$fotograf;
echo "<div id='slike'> ";
$query_picture = ("SELECT id,path,komentar FROM fajlovi WHERE (id = $id) AND klasaFajla = 'slika';");
$result = mysql_query($query_picture);
$number = 1;
while($row = mysql_fetch_array($result)){
	if($row['id']!= '0'){//ako ima slika
	if($number % 3 == 0) $padding = 'padding:10px 0px 10px 0px;';//ako je krajnja desna slika ne treba desni pading
	else $padding = 'padding:10px 20px 10px 0px;';
		$path = $row['path'];
		$title = '';
		if(!empty($row['komentar'])){
			$title = $row['komentar'];
			}
		echo "<div style='".$padding." float:left; width:210px;'>
		        <a class='fancybox-buttons' data-fancybox-group='button' href='http://dksg.rs/$path' title = '".$title."'>
				<img src=http://dksg.rs/$path width=210px />
				</a>"
			 .$row['komentar']."</a></div>";
	}
	$number++;
}
echo '</div><div style="clear:both"></div><div id="fajlovi">';
//ako nije slika prikazi link na fajl, ako nije unet komentar ispisi "link na + 'tip fajla' + fajl" 
$query_picture = ("SELECT id,path,komentar,tipFajla FROM fajlovi WHERE (id = $id) AND klasaFajla != 'slika';");
$result = mysql_query($query_picture);
while($row = mysql_fetch_array($result)){
	if($row['id']!= '0'){
		echo"<a href='http://www.dksg.rs/".$row['path']."'><u>Link za ".$row['tipFajla']." dokument </u></a>: ";
		if(!empty($row['komentar'])){
			echo $row['komentar'];
			}
		echo "</br>";
	}
}
/*ovde sam ukinuo posto zvuk i video idu preko youtube	  
	  
	  case('zvuk'):echo'<embed type="application/x-shockwave-flash" flashvars="audioUrl=http://www.dksg.rs/'.$row['path'].'" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="27" quality="best"></embed>'.$row['komentar'];
	  
	  case('video'):echo'
	  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="390" >
<param name="movie" value="FLVPlayer_Progressive.swf" />
<param name="quality" value="high" />
<param name="wmode" value="opaque" />
<param name="scale" value="noscale" />
<param name="salign" value="lt" />
<param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Halo_Skin_3&amp;streamName=http://www.dksg.rs/'.$row['path'].';autoPlay=false&amp;autoRewind=false" />
<param name="swfversion" value="8,0,0,0" />
<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you dont want users to see the prompt. -->
<param name="expressinstall" value="Scripts/expressInstall.swf" />
<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
<!--[if !IE]>-->
<object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="390" height="259">
<!--<![endif]-->
<param name="quality" value="high" />
<param name="wmode" value="opaque" />
<param name="scale" value="noscale" />
<param name="salign" value="lt" />
<param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Halo_Skin_3&amp;streamName=video/OtkucajiTempiranogVremena&amp;autoPlay=false&amp;autoRewind=false" />
<param name="swfversion" value="8,0,0,0" />
<param name="expressinstall" value="Scripts/expressInstall.swf" />
<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
<div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<br />
'.$row['komentar'].'
<br />


					  ';
					  default:              
					  }
				 }
				  echo"
			  
			  </td>
			</tr>
			<tr><td><hr/></td></tr>
		</table>";
    }
******************************************************************************************

Kraj listanja slika i fajlova	

*****************************************************************************************

Listanje Klipinga

*****************************************************************************************
*/
$query_kliping = "SELECT * FROM kliping WHERE id_dogadjaja_2 = ".$id;
//echo $query_kliping;
$result = mysql_query($query_kliping)or die ('Unable to run query:'.mysql_error());
//echo 'ovo je provera:'.mysql_num_rows($result);
if (mysql_num_rows($result) > 0){
	echo "<br/><br/>KLIPING<br />
	<hr style='width:670px'/>
	<table width='670px'>";	
	while($row = mysql_fetch_array($result)){
	echo "	
		<tr>
		  <td width='70px'>
		  ";
		  echo ($row['godina_unosa'].". ".$row['mesec_unosa'].". ".$row['dan_unosa']."</td>
			<td width='100px' style='text-align:left;'> <div style='width:80px'>".$row['medij']."</div></td>
			<td width='200px'>
				<a href='#' OnClick = 'otvori_kliping(".$row['id'].")'><u>".$row['naslov_klipinga']."</u></a></td>
		</tr>
		<tr><td colspan =4><hr/></td></tr>
");
    }
	echo "</table>";
}
?>
<div style="clear:both"></div>
<div style="vertical-align:baseline; padding-top:25px">
      <div style="display:table">
        <div style="display:table-row">
          <div style=" display:table-cell; vertical-align:top; width:150px;">
            <div style="vertical-align:top; width:150px">
              <fb:like send="true" layout="button_count" width="150" show_faces="true" font="arial"></fb:like>
            </div>
          </div>
          <div style="display:table-cell; vertical-align:top; width:84px;">    
			<div style="vertical-align:top"><a href="https://twitter.com/share" class="twitter-share-button" data-text="Dom kulture Studentski grad">Tweet</a> 
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
            </div>
          </div>
          <div style="display:table-cell; vertical-align:top; width:200px;">    
		     <div class="g-plusone"></div>
				<script type="text/javascript">
  					(function() {
    					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    					po.src = 'https://apis.google.com/js/plusone.js';
					    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  						})();
				</script>
        </div>
      </div>
    </div>
    </div>
  </DIV>
  <!--main-->
  
  <div id="footer"> 
    <!--footer-->
    
</div>
<!--footer-->
</DIV>
<!--container-->

</body>
</html>
