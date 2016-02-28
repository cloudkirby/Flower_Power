<?php
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
?>