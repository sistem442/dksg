function wopen(url, name, w, h)
{
  // Fudge factors for window decoration space.
  // In my tests these work well on all platforms & browsers.
  w += 32;
  h += 96;
  wleft = (screen.width - w) / 2;
  wtop = (screen.height - h) / 2;
  // IE5 and other old browsers might allow a window that is
  // partially offscreen or wider than the screen. Fix that.
  // (Newer browsers fix this for us, but let's be thorough.)
  if (wleft < 0) {
    w = screen.width;
    wleft = 0;
  }
  if (wtop < 0) {
    h = screen.height;
    wtop = 0;
  }
  var win = window.open(url,
    name,
    'width=' + w + ', height=' + h + ', ' +
    'left=' + wleft + ', top=' + wtop + ', ' +
    'location=no, menubar=no, ' +
    'status=no, toolbar=no, scrollbars=no, resizable=no');
  // Just in case width and height are ignored
  win.resizeTo(w, h);
  // Just in case left and top are ignored
  win.moveTo(wleft, wtop);
  win.focus();
}
 var menuids=["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

            function initsidebarmenu(){
                for (var i=0; i<menuids.length; i++){
                    var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
                    for (var t=0; t<ultags.length; t++){
                        ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
                        if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
                            ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px" //dynamically position first level submenus to be width of main menu item
                        else //else if this is a sub level submenu (ul)
                            ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
                        ultags[t].parentNode.onmouseover=function(){
                            this.getElementsByTagName("ul")[0].style.display="block"
                        }
                        ultags[t].parentNode.onmouseout=function(){
                            this.getElementsByTagName("ul")[0].style.display="none"
                        }
                    }
                    for (var t=ultags.length-1; t>-1; t--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
                        ultags[t].style.visibility="visible"
                        ultags[t].style.display="none"
                    }
                }
            }

            if (window.addEventListener)
                window.addEventListener("load", initsidebarmenu, false)
            else if (window.attachEvent)
                window.attachEvent("onload", initsidebarmenu)

        
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

// open hidden layer

            if (document.all||document.getElementById){
                document.write('<style id="tmpStyle" type="text/css">#pic {-moz-opacity:0.00;filter:alpha(opacity=0);opacity:0;-khtml-opacity:0;}<\/style>')
                var objG, degree=fadeAssist=0;
                if (document.all&&typeof document.documentElement!=='undefined')
                    document.write('<!--[if GTE IE 5]><script type="text/javascript">fadeAssist=function (obj, degree){try {obj.filters.alpha.opacity=degree}catch(e){obj.style.filter="alpha(opacity="+degree+")"}}<'+'\/'+'script><![endif]-->')
            }

            function fadepic(obj){
                objG=obj
                if (!document.getElementById&&!document.all)
                    return;
                var tS=document.all? document.all['tmpStyle'] : document.getElementById('tmpStyle')
                if (degree<100){
                    degree+=5
                    if (objG.filters&&objG.filters[0]&&fadeAssist)
                        fadeAssist(objG, degree)
                    else if (typeof objG.style.MozOpacity=='string')
                        objG.style.MozOpacity=degree/101
                    else if (typeof objG.style.KhtmlOpacity=='string')
                        objG.style.KhtmlOpacity=degree/100
                    else if (typeof objG.style.opacity=='string'&&!objG.filters)
                        objG.style.opacity=degree/101
                    else
                        tS.disabled=true
                    setTimeout("fadepic(objG)", 50)
                }
                else
                    tS.disabled=true
            }
function mopen(id)
{
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose;
// -->