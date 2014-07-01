<?php
class search_result{
	 var $parameter;
	 var $value;
	 var $search_result;
	 
	function __construct($parameter,$value) {           
                        $this->parameter = $parameter;
						$this->value = $value;            
                }   
	 function set_parameter($parameter){
		 $this->parameter = $parameter;
		 }
	 function set_value($value){
		 $this->value = $value;
		 }
	 function search_vesti_string($parameter,$value){
		require_once("database_connect.php");
		$query = "SELECT * FROM vesti WHERE $parameter LIKE '%$value%';";
		//echo $query;
		$result = mysql_query($query);
		//echo $result;
		if(mysql_num_rows($result)==0) $this->search_result = 'Ne postoji rezlutat';
		else $this->search_result = $result;
	    }
	 function search_vesti_number($parameter,$value){
		require_once("database_connect.php");
		$query = "SELECT * FROM vesti WHERE $parameter = $value;";
		$result = mysql_query($query);
		if(mysql_num_rows($result)==0) $this->search_result = 'Ne postoji rezlutat';
		else $this->search_result = $result;
	    }
	 function get_search_result(){
		 if (($this->parameter=='naslovVesti')||($this->parameter=='program')||($this->parameter=='kreator')) 
		 	{$this->search_vesti_string($this->parameter,$this->value);
			 return $this->search_result;
			}
		 else 
		 	{$this->search_vesti_number($this->parameter,$this->value);
			return $this->search_result;
			}
		 }
	}
class current_month{
	var $name_of_current_month;
	var $number_of_current_month;
	
	function get_current_month_name_serbian(){
		$number_of_current_month = date('n');
		switch($number_of_current_month){
			case 1: $name_of_current_month = 'Januar';break;
			case 2: $name_of_current_month = 'Februar';break;
			case 3: $name_of_current_month = 'Mart';break;
			case 4: $name_of_current_month = 'April';break;
			case 5: $name_of_current_month = 'Maj';break;
			case 6: $name_of_current_month = 'Jun';break;
			case 7: $name_of_current_month = 'Jul';break;
			case 8: $name_of_current_month = 'August';break;
			case 9: $name_of_current_month = 'Septembar';break;
			case 10: $name_of_current_month = 'Oktobar';break;
			case 11: $name_of_current_month = 'Novembar';break;
			case 12: $name_of_current_month = 'Decembar';break;
		}
		return $name_of_current_month;
	}
}	
class month{
	var $number_of_month;
	var $name_of_month;
	
	function set_number_of_month($month) {
		$this-> number_of_month = $month;
	}
	function get_name_of_month() {
		$this->convert_month_serbian();
		return $this->name_of_month;
	}
	function convert_month_serbian(){
		switch($this-> number_of_month){
			case 1: $this->name_of_month = 'Januar';break;
			case 2: $this->name_of_month = 'Februar';break;
			case 3: $this->name_of_month = 'Mart';break;
			case 4: $this->name_of_month = 'April';break;
			case 5: $this->name_of_month = 'Maj';break;
			case 6: $this->name_of_month = 'Jun';break;
			case 7: $this->name_of_month = 'Jul';break;
			case 8: $this->name_of_month = 'August';break;
			case 9: $this->name_of_month = 'Septembar';break;
			case 10: $this->name_of_month = 'Oktobar';break;
			case 11: $this->name_of_month = 'Novembar';break;
			case 12: $this->name_of_month = 'Decembar';break;
		}
	}
}
class redakcija{
	var $redakcija;
	var $redakcija4;
	
	function set_redakcija($redakcija) {
		$this-> redakcija = $redakcija;
	}
	function get_redakcija() {
		$this->convert_redakcija();
		return $this->redakcija4;
	}
	function convert_redakcija(){
		switch($this-> redakcija){
			case 'likovni': $this->redakcija4 = 'Likovni program';break;
			case 'filmski':  $this->redakcija4 = 'Filmski program';break;
			case 'muzicki': $this->redakcija4 = 'Muzički program';break;
			case 'pozorisni': $this->redakcija4 = 'Pozorišni program';break;
			case 'forum': $this->redakcija4 = 'program Forum';break;
			case 'knjizevni': $this->redakcija4 = 'Knjževni program';break;
			case 'afc': $this->redakcija4 = 'AFC program';break;
			case 'biblioteka': $this->redakcija4 = 'program Biblioteke';break;
		}
	}
}
class time_of_event{
	var $time_of_event;
	var $id;
	
	function set_time_of_event($time_of_event,$id){
		$query = "UPDATE event SET time = '$time_of_event' WHERE id = $id;";
		$result = mysql_query($query);
		//return $query;
		}
	function get_time_of_event($id){
		$query = "SELECT time FROM event WHERE id = $id;";
		$result = mysql_query($query); 
	while ($row = mysql_fetch_assoc($result)) {
		    $time_of_event = $row['time'];
	}
	if(empty($time_of_event )){
		$time_of_event = '20:00'; 
	} 
		return $time_of_event;
	}
}

class remark{
	var $remark;
	var $id;
	
	function set_remark($remark,$id){
		$query = "INSERT INTO remark (remark,id) VALUES ('$remark',$id);";
		$result = mysql_query($query);
		return $query;
		}
	function update_remark($remark,$id){
		$query = "UPDATE remark SET remark = '$remark' WHERE id = $id;";
		$result = mysql_query($query);
		return $query;
		}
	function delete_remark($remark,$id){
		$query = "DELETE * FROM remark WHERE id = $id;";
		$result = mysql_query($query);
		return $query;
		}
	function get_remark_for_edit($id){
		$query = "SELECT remark FROM remark WHERE id = $id;";
		$result = mysql_query($query); 
	while ($row = mysql_fetch_assoc($result)) {
		    $remark = $row['remark'];//ovo je razlicito 
	}
	if(empty($remark)){$remark = '';}
		return $remark;
	}
	function get_remark($id){
		$query = "SELECT remark FROM remark WHERE id = $id;";
		$result = mysql_query($query); 
	while ($row = mysql_fetch_assoc($result)) {
		    $remark = $row['remark'].'<br/>';
	}
	if(empty($remark)){$remark = '';}
		return $remark;
	}
}	
	

class slider{
	var $naslov;
	var $id;
	var $podnaslov;
	var $dan;
	var $mesec;
	var $vreme;
	
	function set_time_of_event($time_of_event,$id){
		$query = "UPDATE event SET time = '$time_of_event' WHERE id = $id;";
		$result = mysql_query($query);
		return $query;
		}
	function get_data($id){
		require_once("database_connect.php");
		$query = "SELECT * FROM event WHERE id = $id;";
		
		$result = mysql_query($query); 
	while ($row = mysql_fetch_assoc($result)) {
		    $naslov = $row['imePrograma'];
			$podnaslov = $row['podnaslov'];
			$dan = $row['dan'];
			$mesec = $row['mesec'];
			$vreme = $row['time'];
			$godina = $row['godina'];
	}
	$podaci = '<strong>'.$naslov.'</strong><br /> '.$podnaslov.' '.$dan.'.'.$mesec.'. u '.$vreme;
	$array = array($dan,$mesec,$godina,$podaci);
	return $array ;
	}
}	





?>