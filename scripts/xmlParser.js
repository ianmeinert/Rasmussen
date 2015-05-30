// JavaScript Document
function loadXMLDoc(XMLname)
{
	var xmlDoc;
	if (window.XMLHttpRequest)
	{
		xmlDoc=new window.XMLHttpRequest();
		xmlDoc.open("GET",XMLname,false);
		xmlDoc.send("");
		return xmlDoc.responseXML;
	}
	// IE 5 and IE 6
	else if (ActiveXObject("Microsoft.XMLDOM"))
	{
		xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async=false;
		xmlDoc.load(XMLname);
		return xmlDoc;
	}
	alert("Error loading document!");
	return null;
}
 
function getDepts()
{
	xmlDoc=loadXMLDoc("../feeds/news.xml")
	var M = xmlDoc.getElementsByTagName("article");
	counter = 1;
	
	for (i=0;i<M.length;i++){
		if(counter<=5)
		{
			document.write("<div class='box'>");
			document.write("<h2>"+xmlDoc.getElementsByTagName("headline")[i].childNodes[0].nodeValue+"</h2>");
			document.write("<p class='info'>"+xmlDoc.getElementsByTagName("author")[i].childNodes[0].nodeValue+" | "+xmlDoc.getElementsByTagName("department")[i].childNodes[0].nodeValue+" | "+xmlDoc.getElementsByTagName("date")[i].childNodes[0].nodeValue+"</p>");
			document.write("<p class='bottom'>"+xmlDoc.getElementsByTagName("content")[i].childNodes[0].nodeValue+"</p>");
			document.write("</div>");
			counter++;
		}
	}
}

function getDept(dept)
{
	xmlDoc=loadXMLDoc("../feeds/news.xml")
	var M = xmlDoc.getElementsByTagName("article");
	counter = 1;
	
	for (i=0;i<M.length;i++){
		if(counter<=5)
		{
			if (xmlDoc.getElementsByTagName("department")[i].childNodes[0].nodeValue == dept) {
				document.write("<li><h3>"+xmlDoc.getElementsByTagName("headline")[i].childNodes[0].nodeValue+"</h3>");
				document.write("<h4>"+xmlDoc.getElementsByTagName("author")[i].childNodes[0].nodeValue+" | "+xmlDoc.getElementsByTagName("department")[i].childNodes[0].nodeValue+" | "+xmlDoc.getElementsByTagName("date")[i].childNodes[0].nodeValue+"</h4>");
				document.write(xmlDoc.getElementsByTagName("content")[i].childNodes[0].nodeValue+"</li>");
			}
			else if (dept == "")
			{
				document.write("<li><h3>"+xmlDoc.getElementsByTagName("headline")[i].childNodes[0].nodeValue+"</h3>");
				document.write("<h4>"+xmlDoc.getElementsByTagName("author")[i].childNodes[0].nodeValue+" | "+xmlDoc.getElementsByTagName("department")[i].childNodes[0].nodeValue+" | "+xmlDoc.getElementsByTagName("date")[i].childNodes[0].nodeValue+"</h4>");
				document.write(xmlDoc.getElementsByTagName("content")[i].childNodes[0].nodeValue+"</li>");
			}
		}
		counter++;
	}
}
