<?php

$html = file_get_contents("http://youtube.com");

$dom = new DOMDocument();
$dom->loadHTML($html);
$nodes = $dom->getElementsByTagName('h3');
foreach ($nodes as $node) {
    $text = $node->nodeValue;
    if (strpos($text, 'with') !==false)
    {
    	echo "found"."<br>";
    }
}

//readfile("http://youtube.com"); displays webpage in browser