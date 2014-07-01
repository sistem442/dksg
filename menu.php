<?php
 include ("class_lib.php");
 include ("database_connect.php");
$current_month = new current_month();//name of month generation in menu
//Prihvata parametre sa stranice oneDateresult.php i prikazuje odgovarajuci kalendar, ako je menu.php pozvan sa neke druge strane prikazuje kalendar za trenutni mesec i obelezava trenutni datum
if(isset($_GET['link'])){
   $link = $_GET['link'];
}
else
   $link = 'a';
if(isset($_GET['dan'])){
   $dan = $_GET['dan'];
}
else 
   $dan = date('j');
if(isset($_GET["mesec"])){
$mesec = $_GET["mesec"];
}
else 
   $mesec = date('n');
if(isset($_GET["godina"])){
$godina = $_GET["godina"];
}
else 
   $godina = date('Y');
?>
<LINK href="http://www.dksg.rs/css/left_menu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://www.dksg.rs/js/ddaccordion.js"></script>
<script type="text/javascript" src="http://www.dksg.rs/js/left_menu_custom.js"></script>
<script type="text/javascript" src="http://www.dksg.rs/js/ddaccordion_INIT.js"></script>
<body onLoad="generate_calendar(<?php echo $godina.",".$mesec."-1,".$dan; ?>);"><!-- month -1 because javascript is using values 0-11 for months-->
<div class="arrowlistmenu" style="height:250px; overflow:visible; !important" >
  <h3 class="menuheader"><a href="http://www.dksg.rs/index.php">Po&#269;etna</a></h3>
  <!--h3 class="menuheader"> <a style="color:#000;" href="http://www.dksg.rs/ProgramMesecni.php"> Program za <?php //echo $current_month->get_current_month_name_serbian();?></a> </h3-->
  <h3 class="menuheader expandable">40 GODINA DKSG</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/tekstDisplay.php?id=100049">Program</a></li>
    <li><a href="" >Publikacija</a></li>
	<li><a href="http://www.dksg.rs/event/4128" >Foto Galerija</a></li>
	<li><a href="http://www.dksg.rs/kliping_lista_40_godina.php" >Novinska dokumentacija</a></li>
  </ul>
  <h3 class="menuheader expandable">FORUM</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/forum">Program</a></li>
    <li><a href="http://www.dksg.rs/foto/forum" >Galerija</a></li>
  </ul>
  <h3 class="menuheader expandable" >POZORIŠTE</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/pozoriste" >Program</a></li>
    <li><a href="http://www.dksg.rs/foto/pozorisni" >Galerija</a></li>
  </ul>
  <h3 class="menuheader expandable" >KNJIŽEVNOST</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/knjizevni" >Program</a></li>
    <li><a href="http://www.dksg.rs/foto/knjizevni" >Galerija</a></li>
  </ul>
  <h3 class="menuheader expandable" >LIKOVNI PROGRAM</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/likovni" >Program</a></li>
    <li><a href="http://www.dksg.rs/foto/likovni" >Galerija</a></li>
  </ul>
  <h3 class="menuheader expandable" >MUZIKA</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/muzicki" >Program</a></li>
    <li><a href="http://www.dksg.rs/foto/muzicki" >Galerija</a></li>
  </ul>
  <h3 class="menuheader expandable" >FILM</h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/filmski" >Program</a></li>
    <li><a href="http://www.dksg.rs/foto/filmski" >Galerija</a></li>
  </ul>
  <h3 class="menuheader expandable"><span style="color:black; font-weight:bold;">AFC</span></h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/program/afc">Program</a></li>
    <li><a href="http://www.dksg.rs/afc/produkcija">Produkcija</a></li>
    <li><a href="http://www.dksg.rs/afc/radionica">Radionica filmske re&#382;ije</a></li>
    <li><a href="http://www.alternativefilmvideo.org">Festival Alternative Film Video </a></li>
    <li><a href="http://www.balkanima.org">Festival Balkanima </a></li>
    <li><a href="http://www.dksg.rs/afc_arhivAlternativnogFilmaIVidea.php">Alternative film arhiv</a></li>
    <li><a href="http://www.dksg.rs/foto/afc">Galerija</a></li>
    <li><a href="http://www.dksg.rs/afc/arhiv/vesti">Arhiva vesti</a></li>
  </ul>
  <h3 class="menuheader expandable"><span style="color:black; font-weight:bold;">BIBLIOTEKA</span></h3>
  <ul class="categoryitems" style="margin-left: 15px">
    <li><a href="http://www.dksg.rs/biblioteka/info">O biblioteci</a></li>
    <li><a href="http://www.vbs.rs/scripts/cobiss?command=CONNECT&scri=cyr&base=70571">Katalog biblioteke</a></li>
    <li><a href="http://www.dksg.rs/biblioteka/uputstvo-za-pretragu-kataloga" >Uputstvo za pretragu kataloga</a></li>
    <li><a href="biblioteka/uvodupretrazivanje/uvod.html" style="color:#F00" >Uvod u pretraživanje</span></a></li>
    <li><a href="http://www.dksg.rs/biblioteka/evaluacija/evaluacija0.html" >Vodič za evaluaciju informacija</span></a></li>
    <li><a href="http://www.dksg.rs/biblioteka/vodicZaCitiranje/uvod.html?id=100004" >Vodič za citiranje</span></a></li>
    <li><a href="http://www.dksg.rs/biblioteka/program">Program</a></li>
    <li><a href="#" class="subexpandable">Prozor &Scaron;angaja</a>
      <ul class="subcategoryitems" style="margin-left: 15px">
        <li><a href="http://www.dksg.rs/biblioteka/prozor-sangaja" >&Scaron;ta je Prozor &Scaron;angaja</a></li>
        <li><a href="http://www.dksg.rs/biblioteka/prozor-sangaja-program">Programi u Prozoru &Scaron;angaja ovog meseca</a></li>
        <li><a href="http://www.dksg.rs/biblioteka/window-of-shanghai" >Window of Shanghai</a></li>
      </ul>
    </li>
    <li><a href="" class="subexpandable">Bookcrossing</a>
      <ul class="subcategoryitems" style="margin-left: 15px">
        <li><a href="http://www.dksg.rs/biblioteka/bookcrossing" >&Scaron;ta je Bookcrossing</a></li>
        <li><a href="http://www.bookcrossing.com/">Bookcrossing.com</a></li>
      </ul>
    </li>
    <li><a href="http://www.dksg.rs/galerija.php?redakcija=biblioteka">Galerija</a></li>
    <li><a href="http://www.dksg.rs/biblioteka/zaposleni">Osoblje biblioteke</a></li>
    <li><a href="http://www.dksg.rs/biblioteka.php?url=https://docs.google.com/spreadsheet/embeddedform?formkey=dG5BRGJISXpxclJpbzBWSENHN2VYeVE6MQ">Pitaj bibliotekara</a></li>
    <li><a href="http://www.dksg.rs/biblioteka/nabavka-knjiga">Predlog za nabavku knjiga</a></li>
    <li><a href="http://www.dksg.rs/biblioteka/mailing-lista">Prijava na mailing listu</a></li>
    <li><a href="http://www.dksg.rs/biblioteka/preporuka-za-citanje">Preporuka za čitanje</a></li>
    <li><a href="http://www.dksg.rs/biblioteka/linkovi">Preporučeni linkovi</span></a></li>
    <li><a href=" http://www.dksg.rs/biblioteka/sajam_2013">Sajam knjiga 2013</span></a></li>
  </ul>
  <h3 class="menuheader expandable"><span style="color:black; font-weight:bold;">Radionice</span></h3>
  <ul class="categoryitems">
  	<li><a href='javascript:showEvent(2866)'>Novinarska Radionica</a></li>
    <li><a href='javascript:showEvent(519)'>Perkusionistička radionica - ritam Studentskog grada</a></li>
    <li><a href='javascript:showEvent(131)'>Fotografija kao sredstvo komunikacije</a></li>
    <li><a href='javascript:showEvent(2406)'>Inside Art</a></li>
    <li><a href='javascript:showEvent(2173)'>Kreativna radionica glume Talija</a></li>
    <li><a href='javascript:showEvent(2371)'>Novi studio</a></li>
    <li><a href='javascript:showEvent(2372)'>Studio glume &#269;etvrti zid</a></li>
    <li><a href="http://www.dksg.rs/afc/radionica">Radionica filmske re&#382;ije</a></li>
    <li><a href='javascript:showEvent(231)'>&Scaron;kola kineskog jezika</a></li>
    <li><a href="javascript:showEvent(516)">Likovna radionica za decu </a></li>
  </ul>
  <h3 class="menuheader expandable"><span style="color:black; font-weight:bold;">ARHIVA</span></h3>
  <ul class="categoryitems">
	<li><a href="http://dksg.rs/arhiva_novo.php">Novo u arhivi</a></li>
    <?php 
		$query333 = ("SELECT DISTINCT program FROM event ORDER BY program ASC;");
		$result333 = mysql_query($query333);
		while($row333 = mysql_fetch_array($result333)){//pocetak while petlje 1
	?>
    <li><a href="" class="subexpandable" style="text-transform:capitalize;"><?php echo ($row333['program']);?></a>
      <ul class="subcategoryitems" style="margin-left: 15px">
        <!--pocetak listanja iznutra-->
        <?php 
		$temp333 = $row333['program'];
		$temp444 = '&#39;'.$row333['program'].'&#39;';
		$query444 = ("SELECT DISTINCT godina from event where program = '$temp333' ORDER BY godina ASC;");
		//echo $query444;
		$result444 = mysql_query($query444);
		while($row444 = mysql_fetch_array($result444)){//pocetak while petlje 2
	?>
        <li><a href=http://www.dksg.rs/arhiva_lista.php?godina=<?php echo $row444['godina'].'&program='.$temp444.'>'. ($row444['godina']);?></a></li>
        <?php 
	}//kraj while petlje 2
	?>
        <!--kraj listanja iznutra-->
      </ul>
    </li>
    <?php 
	}//kraj while petlje 1
	?>
  </ul>
  <div id="calendar">Kalendar se učitava... </div>
  
  <!--****************************************
 //
 //            Prikazivanje Mesecnog programa
 //
 //***************************************--> 
  <a href="http://www.dksg.rs/pdf/jun14.pdf"> <img src="http://www.dksg.rs/images/osnovne/naslovnaJun14.jpg" style="margin-top: 10px; border: 1px solid; border-color: #000;"  
    	width="180"/> <U>Program JUN 2014</U> </a> <br />
  <br />
  
  <div style="width:174px; display:table; border:solid 1px #999; padding:2px">
	<form action="http://www.dksg.rs/keywordSearchResult.php" method="post" >  

<input class="search" type="text" id="keyword" 
    	onfocus="this.css.color='#666';" style=" width:140px; display:table-cell; float:left;"/>
    <div class="nav" style=" display:table-cell; float:right; padding:0px; width:20px; height:20px; margin-right:6px;" onClick="pretraga()"></form></div>

	
  </div><!-- end of search div--> 
  <div style="text-align:center">pretraga događaja</div>
  <br />
      <!--?php include("sponzori.php"); ?-->

  <!--a href="http://www.seecult.org/"> <img src="http://www.dksg.rs/images/osnovne/seecult.jpg" width="180px" class="baner" /> </a><br />
  <a href="http://www.timemachinemusic.org/"> <img src="http://www.dksg.rs/images/osnovne/tmm.jpg" width="180px" class="baner" /> </a><br />
  <a href="http://www.antikafotokopirnice.rs/"> <img src="http://www.dksg.rs/images/osnovne/antika.jpg" width="180px" class="baner" /> </a><br />
  <a href="http://www.pulse.rs/"> <img src="http://www.dksg.rs/images/osnovne/pulse-baner.jpg" width="180px" class="baner" /> </a><br />
  <a href="http://www.rockulice.com/"> <img src="http://www.dksg.rs/images/osnovne/RU-baner-250x67.jpg" width="180px" class="baner" /> </a><br />
  <a href="http://www.studentu.me/"> <img src="http://www.dksg.rs/images/osnovne/StudentU.jpg" width="180px" class="baner" /> </a><br /-->
</div>
