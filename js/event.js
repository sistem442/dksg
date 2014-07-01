//*********************Funkcije koje omogucavaju formatiranje teksta**********************************
tinymce.init({
    selector: "textarea#elm1",
    theme: "modern",
    width: 580,
    height: 300,
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
//***********************************funkcija za upload vise fajlova****************************
var sledeci = 0; //cuva redni broj/ime sledeceg inputa fajla
function display() {
	var id = sledeci;
	document.getElementById('brojFajlova').value = sledeci + 1;//upisujem koliko ima fajlova da bih znao koliko puta treba da vrtim petlju za upis u bazu
	document.getElementById('newInput'+id).innerHTML+=createInput(id);// ovo upisuje novi input na html stranicu
	var newInput = "fajl" + id;
	document.getElementById('fajl'+id).click();// automatski trazi da izaberes fajl kada pritisnes link za novi fajl
}
function createInput(id) {
	sledeci = id + 1;
	return "<input type='hidden' name='MAX_FILE_SIZE' value='100000000'><p>Fajl "+ id +": <input type='file' id='fajl"+ id +"' name='"+id+"'></p><br />Komentar:<input type='text' name='"+id+"komentar'><br /><input type='radio' name='"+id+"galerija' value='da'>Prikaži sliku na stranici galerija<br /><input type='radio' name='"+id+"galerija' value='ne'>Ne prikazuj sliku na stranici galerija<br /><br/><p id='newInput"+sledeci+"'>&nbsp;</p>";
}
//************************************Validacija i jos neke stvari******************************
function funkcija31(){	
//************************************Dodeljuje proritet na osnovu programa******************************
    var x=document.getElementById("program").selectedIndex;
    var y=document.getElementById("program").options;
	var arhiva = document.getElementById("arhiva").value;
	var VrednostPrioriteta = 0;
	var program = y[x].text;
	if(program == "likovni"){
	    VrednostPrioriteta = 7;
	    }
	else if(program == 'obavestenje'){
		VrednostPrioriteta = 1;
		}	
	else if(program == 'muzicki'){
		VrednostPrioriteta = 2;
		}
	else if(program == 'pozorisni'){
		VrednostPrioriteta = 2;
		}
	else if(program == 'filmski'){
		VrednostPrioriteta = 4;
		}	
	else if(program == 'forum'){
		VrednostPrioriteta = 3;
		}
	else if(program == 'knjizevni'){
		VrednostPrioriteta = 5;
		}
	else if(program == 'film'){
		VrednostPrioriteta = 6;
		}
	else if(program == 'afc'){
		VrednostPrioriteta = 6;
		}
	else if(program == 'biblioteka'){
		VrednostPrioriteta = 8;
		}
	else if(program == 'ostali'){
		VrednostPrioriteta = 9;
		}
		else if(program == 'radionice'){
		VrednostPrioriteta = 10;
		}
	else{
		VrednostPrioriteta=9;
		}
	document.getElementById("prioritet").value = VrednostPrioriteta;
// ************************* provera da li je ulogovan urednik ili arhiva ****************************
if(grupa == '#arhiv' || aaa == 'aaa'){
		
	var naslov = document.getElementById("imePrograma").value;
	var s_opis = document.getElementById("s_opis").value;
	
	if(datum77 == 'ok'  && naslov != '' && program != 'Izaberite program' && s_opis != ''){	         
		 document.getElementById("posalji").disabled = false;
		 document.getElementById("validnost").innerHTML = "<span style='color:green'>Podaci su validni</span>";		
     }
	 else if (datum77 == 'nok'){
	     document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite datum dogadjaja!</span>";
     }	 
	 else if (program == "Izaberite program"){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Izaberite program!</span>";
     }	
	 else if (naslov == ''){		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite naslov dogadjaja!</span>";
     }
	 else if ( s_opis == ""){		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite sažeti opis!</span>";
     }
	 else{
		 document.getElementById("validnost").innerHTML = "<span style='color:green'>Podaci su validni</span>";
		 }
	}else{

//**************************************proverava da li je unet datum i naslov*********************************	

	var naslov = document.getElementById("imePrograma").value;
	var vreme_mesto = document.getElementById("vreme_mesto").value;
	var s_opis = document.getElementById("s_opis").value;
	var skrTekst = document.getElementById("skrTekst").value;
	
	if(datum77 == 'ok'  && naslov != '' && program != 'Izaberite program' && vreme_mesto != '' && s_opis !='' && skrTekst !=''){	         
		 document.getElementById("posalji").disabled = false;
		 document.getElementById("validnost").innerHTML = "<span style='color:green'>Podaci su validni</span>";		
     }
	 else if (datum77 == 'nok'){
	     document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite datum dogadjaja!</span>";
     }
	 else if (vreme_mesto == ""){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite vreme i mesto!</span>";
     }		 
	 else if (program == "Izaberite program"){
         document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Izaberite redakciju!</span>";
     }	
	 else if (naslov == ""){		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite naslov dogadjaja!</span>";
     }
	 else if ( s_opis == ""){		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite sažeti opis!</span>";
     }
	 else if ( skrTekst == ""){		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>opis događaja!</span>";
     }
	 else {		 
		 document.getElementById("posalji").disabled = true;
		 document.getElementById("validnost").innerHTML = "<span style='color:red'>Unesite vreme i mesto dogadjaja!</span>";
     }
	}
}
//*************************************************************Funkcija koja aktivira unos jednog datuma********************
function enable1(){
		 datum77 = 'ok';
		 $('#napomena33').css("display","none");
		 document.getElementById("jedanDan").value = 'on';
		 document.getElementById("dan").disabled = false;
		 document.getElementById("mesec").disabled = false;
		 document.getElementById("godina").disabled = false;
         document.getElementById("pon").disabled = true;
		 document.getElementById("uto").disabled = true;
		 document.getElementById("sre").disabled = true;
		 document.getElementById("cet").disabled = true;
		 document.getElementById("pet").disabled = true;
		 document.getElementById("sub").disabled = true;
		 document.getElementById("ned").disabled = true;
		 document.getElementById("dan1").className = 'redBack';
		 document.getElementById("mesec1").className = 'redBack';
		 document.getElementById("godina1").className = 'redBack';
		 document.getElementById("dan2").className = 'redBack';
		 document.getElementById("mesec2").className = 'redBack';
		 document.getElementById("godina2").className = 'redBack';
		 document.getElementById("dan").className = 'greenBack';
		 document.getElementById("mesec").className = 'greenBack';
		 document.getElementById("godina").className = 'greenBack';
		 
		 document.getElementById("ponavljaSe").value = 'off';
		 document.getElementById("viseDana").value = 'off';		 	
	}
//*************************************************************Funkcija koja aktivira unos opsega**********************	
function enable2(){
		datum77 = 'ok';
		$('#napomena33').css("display","none");
	     document.getElementById("dan").disabled = true;
		 document.getElementById("mesec").disabled = true;
		 document.getElementById("godina").disabled = true;
		 document.getElementById("dan1").disabled = false;
		 document.getElementById("mesec1").disabled = false;
		 document.getElementById("godina1").disabled = false;
		 document.getElementById("dan2").disabled = false;
		 document.getElementById("mesec2").disabled = false;
		 document.getElementById("godina2").disabled = false;
		 document.getElementById("pon").disabled = true;
		 document.getElementById("uto").disabled = true;
		 document.getElementById("sre").disabled = true;
		 document.getElementById("cet").disabled = true;
		 document.getElementById("pet").disabled = true;
		 document.getElementById("sub").disabled = true;
		 document.getElementById("ned").disabled = true;
		 document.getElementById("dan1").className = 'greenBack';
		 document.getElementById("mesec1").className = 'greenBack';
		 document.getElementById("godina1").className = 'greenBack';
		 document.getElementById("dan2").className = 'greenBack';
		 document.getElementById("mesec2").className = 'greenBack';
		 document.getElementById("godina2").className = 'greenBack';
		 document.getElementById("dan").className = 'redBack';
		 document.getElementById("mesec").className = 'redBack';
		 document.getElementById("godina").className = 'redBack';
		 document.getElementById("viseDana").value = 'on';
		 document.getElementById("ponavljaSe").value = 'off';
		 document.getElementById("jedanDan").value = 'off';		 	
	}
//*******************************************************Funkcija koja aktivira unos dogadjaja koji se ponavlja*********
function enable3(){	
		datum77 = 'ok';
		$('#napomena33').css("display","block");
	     document.getElementById("dan1").disabled = false;
		 document.getElementById("mesec1").disabled = false;
		 document.getElementById("godina1").disabled = false;
		 document.getElementById("dan2").disabled = false;
		 document.getElementById("mesec2").disabled = false;
		 document.getElementById("godina2").disabled = false;
		 document.getElementById("dan").disabled = true;
		 document.getElementById("mesec").disabled = true;
		 document.getElementById("godina").disabled = true;
		 document.getElementById("pon").disabled = false;
		 document.getElementById("uto").disabled = false;
		 document.getElementById("sre").disabled = false;
		 document.getElementById("cet").disabled = false;
		 document.getElementById("pet").disabled = false;
		 document.getElementById("sub").disabled = false;
		 document.getElementById("ned").disabled = false;
 		 document.getElementById("dan1").className = 'greenBack';
		 document.getElementById("mesec1").className = 'greenBack';
		 document.getElementById("godina1").className = 'greenBack';
		 document.getElementById("dan2").className = 'greenBack';
		 document.getElementById("mesec2").className = 'greenBack';
		 document.getElementById("godina2").className = 'greenBack';
		 document.getElementById("dan").className = 'redBack';
		 document.getElementById("mesec").className = 'redBack';
		 document.getElementById("godina").className = 'redBack';
		 document.getElementById("ponavljaSe").value = 'on';
		 document.getElementById("viseDana").value = 'off';
		 document.getElementById("jedanDan").value = 'off'; 
	}

//*******************************************************Funkcija koja ogranicava broj karaktera u polju za opis *****
$(function() {
    //set up text length counter
    $('#skrTekst').keyup(function() {
        update_chars_left(100, $('#skrTekst')[0], $('#text_chars_left'));
		count_characters(50, $('#skrTekst')[0], $('#text_chars_needed'));
    });
	$('#skr_tekst').keyup(function() {
        update_chars_left(100, $('#skr_tekst')[0], $('#text_chars_left'));
		count_characters(0, $('#skr_tekst')[0], $('#text_chars_needed'));
    });

});

function update_chars_left(max_len, target_input, display_element) {
   var text_len = target_input.value.length;
   if (text_len >= max_len) {
       target_input.value = target_input.value.substring(0, max_len); // truncate
       display_element.html("0");
   } else {
       display_element.html(max_len - text_len);
   }
}
function count_characters(min_lenth, target_input, display_element) {
	var text_len = target_input.value.length;
	if (text_len <= min_lenth) {
		display_element.html("<span style='color:red'>Još uvek niste uneli dovoljan broj karaktera, potreban broj je:"+Math.abs(text_len-min_lenth)+"</span>" );
	}
	else {
		display_element.html("<span style='color:green'>Uneli ste dovoljan broja karaktera</span>" );
		opis = 'ok';
	}
}
//*************************************************  sakriva polja u odnosu na to ko se ulogovao***********************
function sakri(grupa){
		var temp = grupa;
		for(i=0;i<17;i++){
			temp = grupa+i;
			$(temp).css("display","none");
			temp = grupa;
		}
	}
function sakri2(){
			sakri('#arhiv') 
			$('#urednici1').css("display","none");
			$('#urednici2').css("display","none");
	}	

