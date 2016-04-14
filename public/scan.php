<?php
class portScan
{
	protected $url;
	protected $startP;
	protected $endP;
	
	public function __construct($url, $startP, $endP)
	{
		$this->url = $url;		
		$this->startP = $startP;
		$this->endP = $endP;
	}
	
	public function scanner()
	{
		error_reporting(0);

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
            {
                $protocol = "unknown";
            } 
			else $protocol = getservbyport($i, "top");
			{
                if($fp) 
                {
                    print  "port $i [$protocol] on $url is active" . "\n";
                    fclose($fp);
                }
                else
                {
                    print "port $i [$protocol] on $url is inactive" . "\n";
                }
            }
		}
		flush();	
	}
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>Flower Power </title>
	<meta name='description' content='Flowerpower'>
	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
	<!-- Optional theme -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css' integrity='sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r' crossorigin='anonymous'>
	<link rel='stylesheet' type='text/css' href='css.css'>
</head>
<body>
	<nav class='navbar navbar-inverse navbar-fixed-top'>
		<div class='container'>
			<div class='navbar-header'>
			<a href='index.php' class='navbar-brand'>P<sup>2</sup></a>
			<ul class="nav navbar-nav">
				<li><a href="scan.php">Port Scanner</a>
			</ul>
		</div>
	</nav>
	<div class='jumbotron'>
		<div class='container'>
            <div class='text-center'>
			<h1>P<sup>2</sup></h1>
            <h3>Port Scanner</h3>
            </div>
			<?php if ($_POST): ?>
                <?php 
                    $url = $_POST['url'];
					$startP = $_POST['startP'];
					$endP = $_POST['endP'];

                    $portScan = new portScan($url, $startP, $endP);
                    $portScan->scanner();
                 ?>
            <?php else: ?>
                <form method='POST' action=''>
                    <div class='form-group'>
                        <label>Website URL</label>
                        <input class='form-control' type='url' placeholder='Website URL' name='url' required>
                    </div>
					<form method='POST' action=''>
                    <div class='form-group'>
                        <label>Start Port</label>
                        <input class='form-control' type='number' placeholder='Start Port' name='startP' required>
                    </div>
					<form method='POST' action=''>
                    <div class='form-group'>
                        <label>End Port</label>
                        <input class='form-control' type='number' placeholder='End Port' name='endP' required>
                    </div>
                    <div>
                        <button type='submit' class='btn btn-lg btn-warning'> Submit</button>
                    </div>
                </form>
			<?php endif; ?>
		</div>        
	</div>
	<script src=''http://code.jquery.com/jquery-2.2.1.min.js''>
	<!-- Latest compiled and minified JavaScript -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>
</body>
</html>	