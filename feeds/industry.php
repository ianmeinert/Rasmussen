<?php
$itemCounter = 1;
$insideitem = false;
$tag = "";
$title = "";
$description = "";
$link = "";
$locations = array('http://news.search.yahoo.com/rss?ei=UTF-8&p=cloth+diapers&fr=news-us-ss','http://news.search.yahoo.com/rss?ei=UTF-8&p=green+diapers&fr=news-us-ss','http://news.search.yahoo.com/rss?ei=UTF-8&p=bio+diapers&fr=news-us-ss');
srand((float) microtime() * 1000000); // seed the random gen 
$random_key = array_rand($locations);

function startElement($parser, $name, $attrs) {
	global $insideitem, $tag, $title, $description, $link;
	if ($insideitem) {
		$tag = $name;
	} elseif ($name == "ITEM") {
		$insideitem = true;
	}
}

function endElement($parser, $name) {
	global $insideitem, $tag, $title, $description, $link, $itemCounter;
	if ($name == "ITEM")
	{
		if($itemCounter<=5)
		{
			printf("<li><a href='%s' target=new>%s</a><br />",
			trim($link),htmlspecialchars(trim($title)));
			printf("%s</li>",htmlspecialchars(trim(substr($description,0,250)."...")));
			$title = "";
			$description = "";
			$link = "";
			$insideitem = false;
		}
		$itemCounter++;
	}
}

function characterData($parser, $data) {
	global $insideitem, $tag, $title, $description, $link;
	if ($insideitem) {
		switch ($tag) {
			case "TITLE":
				$title .= $data;
				break;
			case "DESCRIPTION":
				$description .= $data;
				break;
			case "LINK":
				$link .= $data;
				break;
		}
	}
}

$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
$fp = fopen($locations[$random_key], 'r')
	or die("Error reading RSS data.");
while ($data = fread($fp, 4096))
{
	xml_parse($xml_parser, $data, feof($fp))
		or die(sprintf("XML error: %s at line %d",
			xml_error_string(xml_get_error_code($xml_parser)),    
			xml_get_current_line_number($xml_parser)));
}
fclose($fp);
xml_parser_free($xml_parser);
?>