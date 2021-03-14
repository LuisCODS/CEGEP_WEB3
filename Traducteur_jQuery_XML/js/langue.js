function traduire(fichierXML){
 var codes=fichierXML.getElementsByTagName("langue")[0];
 var elem=codes.firstChild;
 
 while(elem!=null){
	if (elem.nodeType==3)
		elem=elem.nextSibling;
	if (elem!=null){
		code=elem.nodeName;
		contenu=elem.firstChild.nodeValue;
		document.getElementById(code).innerHTML=contenu;
		elem=elem.nextSibling;
	}
 }
}
/*
function obtenirXML(langue){
//Exemple de parcours d'un fichier XML
//Appel AJAX pour obtenir le fichier de la langue voulue
if (window.XMLHttpRequest)
  {
  xhr=new XMLHttpRequest();
  }
else // IE 5/6
  {
  xhr=new ActiveXObject("Microsoft.XMLHTTP");
  }
var fichier="langues/"+langue+".xml"; 
xhr.open("GET",fichier,false);
xhr.send();
fichierXML=xhr.responseXML; 
traduire(fichierXML); 
}
}*/
function obtenirXML(langue){
var fichier="langues/"+langue+".xml";
$.ajax({
	type:"GET",
	url:fichier,
	dataType:"xml",
	success:function(fichierXML){
		traduire(fichierXML);
	},
	fail:function(){
		
	}
});
}

function obtenirLangue(){
	if (navigator.browserLanguage)
		var langue = navigator.browserLanguage;
	else
		var langue = navigator.language;
    obtenirXML("en");		
}