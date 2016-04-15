<?php
error_reporting(0);
set_time_limit(0);

		$url = $_SERVER["argv"][1];
		$startP = $_SERVER["argv"][2];
		$endP = $_SERVER["argv"][3];	
		$delay = 1;
		
		/**
		* Returns status of ports within range
		*
		* @param string $url, int $startP, int $endP
		* @return string
		*/
		if($_SERVER["argc"] != 4);
		
		for($i = $startP; $i <= $endP; $i++)
		{
			$fp = fsockopen($url, $i, $errno, $errstr, $delay);
            
			if(getservbyport($i, "top") == "") 
            $protocol = "unknown"; 
            else $protocol = getservbyport($i, "top");
			
                if($fp) 
                {   
                    print  "port $i [$protocol] on $url is active " . "\n";
                    fclose($fp);
                }
                else
                {
                    print "port $i [$protocol] on $url is inactive " . "\n";
                }          
         }
		flush();	
?>