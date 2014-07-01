<?php
//require_once("../database_connect.php");
$day = date('j');
$month = date('n');
$year = date('Y'); 
$query = "SELECT * FROM SLAJD WHERE (dan >= $day AND mesec = $month AND godina = $year) || ( mesec > $month AND godina = $year) || (mesec=1 AND godina = ($year+1) )  ORDER BY   `slajd`.`godina` ASC,`slajd`.`mesec` ASC, `slajd`.`dan` ASC LIMIT 0,10;";
echo $query;
$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // Prikazuje poruku o gresci
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Skitter - Slideshow for anytime!</title>
	<link href="css/styles.css" type="text/css" media="all" rel="stylesheet" />

	<!-- Skitter Styles -->
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />

	<!-- Skitter JS -->
	<script type="text/javascript" language="javascript" src="js/jquery-1.6.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.skitter.min.js"></script>

	<!-- Init Skitter -->
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('.box_skitter_large').skitter({
				theme: 'clean',
				numbers_align: 'center',
				progressbar: false, 
				dots: false, 
				preview: true,
				enable_navigation_keys: false,
				controls: false, 
				hideTools: true,
				interval: 5000 
			});
			
		});
	</script>
	</head>
	<body>
    <div id="page">
      <h1>Skitter - Slideshow for anytime!</h1>
      <br />
      <br />
      <div id="content">
        <div class="border_box">
          <div class="box_skitter box_skitter_large">
            <ul>
              <?php
				 while($row = mysql_fetch_array($result)){
		     ?>
              <li><a href="<?php echo $row['link'];?>"><img src='<?php echo $row['path'];?>' class="cube"/></a>
                <div class="label_text">
                  <p><strong><?php echo $row['title'];?></strong><br />
						<?php echo $row['title'];?></p>
                </div>
              </li>
              <?php }//kraj petlje koja lista dogadjaje?>
            </ul>
          </div>
        </div>
      </div>
    </div>
</body>
</html>