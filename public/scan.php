<?php
	error_reporting(0);

	$host = $_SERVER['argv'][1];
	$startP = $_SERVER['argv'][2];
	$endP = $_SERVER['argv'][3];	
	$delay = 1;
	
	/**
	* Returns status of ports within range
	*
	* @param string $host, int $startP, int $endP
	* @return string
	*/
	if($_SERVER['argc'] != 4);
	
	for($i = $startP; $i <= $endP; $i++)
	{
		$fp = fsockopen($host, $i, $errno, $errstr, $delay);
		if(getservbyport($i, 'top') == '') $protocol = 'unknown'; 
		else $protocol = getservbyport($i, 'top');
		
		if($fp) 
		{
			print "port $i [$protocol] on $host is active" . "\n";
			fclose($fp);
		}
			else
			{
			print "port $i [$protocol] on $host is inactive" . "\n";
			}
	}
	flush();	
?>
