<!DOCTYPE html>
   
<html lang="en">
    <head>
      <title>Game Gathering - Game Entry Form</title>
      <link href="gamestyle.css" rel="stylesheet" type="text/css">
    </head>
    <body>
      <div id="header">
	<div id="sitebranding">
	  <h1>The Game Gathering</h1>
	</div> <!-- end of sitebranding div -->
	<div id="tagline">
	  <p>My web page for gaming stuff with my friends</p>
	</div> <!-- end of tagline div -->
      </div> <!-- end of header div -->
      <div id="navigation">
	<ul>
	  <li><a href="index.html">Home</a></li>
	  <li><a href="about.html">About Us</a></li>
	  <li><a href="contactus.html">Contact Us</a></li>
	  <li><a href="resources.html">Gaming Resources</a></li>
	  <li><a href="gamelist.php">Game List</a></li>
	</ul>
      </div> <!-- end navigation div -->
      <div id="bodycontent">
	<h2>Game Entry Form</h2>
      <div id="phpcontent">
	 <?php
	    require_once 'login.php';
	    $db_server = mysql_connect($db_hostname, $db_username, $db_password);

	    if (!$db_server) die("Unable to connect to database:  " . mysql_error());

	    mysql_select_db($db_database, $db_server) or die("Unable to select database:  ". mysql_error());
	    
	    if (isset($_POST['Game']) &&
		isset($_POST['MinPlayers']) &&
		isset($_POST['MaxPlayers']) &&
		isset($_POST['Format']) &&
		isset($_POST['Manufacturer']))
	    {
		$Game 	        = get_post('Game');
		$MinPlayers	= get_post('MinPlayers');
		$MaxPlayers	= get_post('MaxPlayers');
		$Format		= get_post('Format');
		$Manfacturer	= get_post('Manufacturer');

		$query = "INSERT INTO GameList (Game, MinPlayers, MaxPlayers, Format, Manufacturer) VALUES " .
		    "('$Game', '$MinPlayers','$MaxPlayers', '$Format', '$Manfacturer')";

	    if(!mysql_query($query, $db_server))
		echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";
	    }
        
	    
	    echo <<<_END
	    <form action="gameadd.php" method="post">
	    <fieldset>
	    <legend>Add a new game:</legend>
	    <p><label for="Game">Game</label> <input type="text" name="Game" /></p>
	    <p><label for="MinPlayers">Min Player</label> <select name="MinPlayers">
	    <option value="1">1</option>
	    <option value="2">2</option>
	    <option value="3">3</option>
	    </select></p>
	    <p><label for="MaxPlayers">Max Player</label> <select name="MaxPlayers">
	    <option value="2">2</option>
	    <option value="3">3</option>
	    <option value="4">4</option>
	    <option value="5">5</option>
	    <option value="6">6</option>
	    <option value="7">6+</option>
	    </select></p>
	    <p><label for="Theme">Theme</label> <input type="text" name="Theme" /></p>
	    <p><label for="Format">Format</label> <input type="text" name="Format" /></p>
	    <p><label for="Manufacturer">Manufacturer</label> <input type="text" name="Manufacturer" /></p>
	    <p><label for="Designer">Designer</label> <input type="text" name="Designer" /></p>
	    <p><label for="Time">Time (mins)</label> <input type="text" name="Time" size="7" /></p>
	    <p class="submit"> <input type="submit" value="ADD GAME" /></p>
	    <p class="submit"> <input type="submit" value="CANCEL" /></p>
	    </fieldset>
	    </form>
_END;
	    
function get_post($var)
{
    return mysql_real_escape_string($_POST[$var]);
}
	  ?>
      </div>

      </div> <!-- end bodycontent div -->
    </body>
</html>
