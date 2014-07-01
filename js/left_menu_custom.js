function pretraga(){
	var keyword = $('#keyword').val();
	window.location = 'http://www.dksg.rs/keywordSearchResult.php?rec='+keyword;
	}
//*********************************************************//funkcija za prelazak na prikazivanje jednog događaja	
function showEvent(str)
{	
    window.location = "http://www.dksg.rs/oneEventDisplay.php?id="+str;
} 
//kalendar 2013
daysInMonth=[31,28,31,30,31,30,31,31,30,31,30,31]
monthNames=['Januar','Februar','Mart','April','Maj','Jun',
			'Jul','August','Septembar','Oktobar','Novembar','Decembar'];

// Returns the number of days in the month in a given year (January=0)
function getDaysInMonth(month,year){
  if ((month==1)&&(year%4==0)&&((year%100!=0)||(year%400==0))){
	return 29;
  }else{
	return daysInMonth[month];
  }
}

function generate_calendar(year,month,day){
	  //alert(year+' ' +month+' '+day);
		var nextmonth = month+1;
		var prev_month =month-1;
		var prev_year = year;
		var next_year = year; 
		if(month == 0) {prev_month=11;prev_year = year-1;}
		if(month == 11) {nextmonth=0;}
		if(month == 11) {next_year = year+1;}		
		
		var output = '';
		output = '<div class="kalendarImeMeseca">';
		output = output 
			+'<div class="calendar_link" onClick="generate_calendar('+prev_year+','+(prev_month)+',-1)">&lt;&lt;</div>'
			+ '<div class="calendar_name">' + monthNames [ month ] + ' ' + year + '</div>'
			+'<div class="calendar_link" onClick="generate_calendar('+next_year+','+(nextmonth)+',-1)">&gt;&gt;</div>'
			+'</div><table width="175px"  align="left"  bgcolor="#ffffff" cellpadding="0" cellspacing="0">';
		firstDayDate = new Date(year,month,1);
		firstDay = firstDayDate.getDay()-1;
		if (firstDay == -1) firstDay = 6;// because of .getDay function returns sunday as first day of week
		for (j=0;j<42;j++){
		  if (j%7==0) output = output + ('<tr>');
		  if ((j<firstDay)||(j>=firstDay+getDaysInMonth(month,year))){
			output = output + ('<td class="calendarEmpty"></td>');
		  }else{
				var d = new Date(year,month,j - firstDay+1);
				var day_of_week = d.getDay();
				day_name = new Array('nedelja','ponedeljak','utorak','sreda','cetvrtak','petak','subota');
			  // if selected day, highlight it
			  if( j == firstDay + day - 1){
				  day_space = ('<td class="kalendar2"> <a href="http://www.dksg.rs/'+day_name[day_of_week]+'/'+(j-firstDay+1)+'/'+(month+1)+'/'+year+'")>'+(j-firstDay+1)+'</a></td>');
			  }
			  else{
					day_space = ('<td class="kalendar"> <a href="http://www.dksg.rs/'+day_name[day_of_week]+'/'+(j-firstDay+1)+'/'+(month+1)+'/'+year+'")>'+(j-firstDay+1)+'</a></td>');
			  }
			output = output + day_space;
		  }
		  if (j%7==6) output = output + ('</tr>');
		}
		output = output + ('</table>');	
		document.getElementById('calendar').innerHTML = output;
} 
