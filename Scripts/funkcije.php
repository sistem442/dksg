<?php
function upisiMaterijal($id,$plakat,$pozivnica,$katalog,$fotografija,$video,$zvuk,$publikacija,$materijalProgram)
{
	//echo " startovana funkcija <strong>pozivnica == $pozivnica</strong> ";
	if($plakat == 'da'){
		$query36 = ("INSERT INTO mat_plakat (id) VALUES ($id)");
		//echo $query36;
		$result = mysql_query($query36);
      //  echo "upisan id u tabelu plakat";
	}
	if($plakat == 'ne'){
		$query37 = ("DELETE FROM mat_plakat WHERE id = ($id)");
		//echo $query37;
		$result = mysql_query($query37);
      //  echo "upisan id u tabelu plakat";
	}
	if($pozivnica == 'da'){
		$query38 = ("INSERT INTO mat_pozivnica (id) VALUES ($id)");
		$result = mysql_query($query38);
        //echo "upisan $id u tabelu pozivnica";
	}
	if($pozivnica == 'ne'){
		$query47 = ("DELETE FROM mat_pozivnica WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query47);
      //  echo "upisan id u tabelu plakat";
	}
    if($katalog == 'da'){
		$query39 = ("INSERT INTO mat_katalog (id) VALUES ($id)");
		$result = mysql_query($query39);
	    //echo "upisan $id u tabelu katalog";
	}
	if($katalog == 'ne'){
		$query48 = ("DELETE FROM mat_katalog WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query48);
      //  echo "upisan id u tabelu plakat";
	}
    if($fotografija == 'da'){
		$query40 = ("INSERT INTO mat_fotografija (id) VALUES ($id)");
		$result = mysql_query($query40);
		//echo "upisan id u tabelu foto";
	}
	if($fotografija == 'ne'){
		$query49 = ("DELETE FROM mat_fotografija WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query49);
      //  echo "upisan id u tabelu plakat";
	}
    if($video == 'da'){
		$query41 = ("INSERT INTO mat_video (id) VALUES ($id)");
		$result = mysql_query($query41);
		//echo "upisan id u tabelu video";
	}
	if($video == 'ne'){
		$query41 = ("DELETE FROM mat_video WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query41);
      //  echo "upisan id u tabelu plakat";
	}
    if($zvuk == 'da'){
		$query42 = ("INSERT INTO mat_zvuk (id) VALUES ($id)");
		$result = mysql_query($query42);
		//echo "upisan id u tabelu zvuk";
	}
	if($zvuk == 'ne'){
		$query49 = ("DELETE FROM mat_zvuk WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query49);
      //  echo "upisan id u tabelu plakat";
	}
    if($publikacija == 'da'){
		$query43 = ("INSERT INTO mat_publikacija (id) VALUES ($id)");
		$result = mysql_query($query43);
		//echo "upisan id u tabelu publi";
	}
	if($publikacija == 'ne'){
		$query49 = ("DELETE FROM mat_publikacija WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query49);
      //  echo "upisan id u tabelu plakat";
	}
    if($materijalProgram == 'da'){
		$query44 = ("INSERT INTO mat_program (id) VALUES ($id)");
		$result = mysql_query($query44);
		//echo "upisan id u tabelu matProgram";
	}
	if($materijalProgram == 'ne'){
		$query49 = ("DELETE FROM mat_program WHERE id = ($id)");
		//echo $query47;
		$result = mysql_query($query49);
      //  echo "upisan id u tabelu plakat";
	}
}

?>