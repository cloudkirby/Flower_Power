<?php

function getError($url)
{
	$headers = get_headers($url,1);

	if ($headers[0] == 'HTTP/1.1 200 OK')
	{
		$url = $url . "'";

		$contents = file_get_contents($url);

		return $contents;
	}

	return NULL;
}
var_dump(getError("http://www.cideko.com/pro_con.php?id=3"));
?>