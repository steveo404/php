<!DOCTYPE html>
   
<html lang="en">
    <head>
      <title>Game Gathering - Game List Links</title>
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
	  <li><a href="resources.php">Gaming Resources</a></li>
	  <li><a href="gamelist.php">Game List</a></li>
	    <ul>
		<li><a href="gameadd.php">Add a game</a></li>
		<li><a href="gamedelete.php">Delete a game</a></li>
	    </ul>
	</ul>
      </div> <!-- end navigation div -->
      <div id="bodycontent">
	<h2>Game List Links</h2>
      <div id="phpcontent">
	 
	    <?php 
	    require_once 'login.php';
	    $db_server = mysql_connect($db_hostname, $db_username, $db_password);

	    if (!$db_server) die("Unable to connect to database:  " . mysql_error());

	    mysql_select_db($db_database, $db_server) or die("Unable to select database:  ". mysql_error());

	    $query = "SELECT GameList.GameID,
	    GameList.Game,
	    GameList.MinPlayers,
	    GameList.MaxPlayers,
	    GameList.Theme,
	    GameList.Manufacturer,
	    GameList.Time
	    FROM GameList
	    ORDER BY GameList.Game;";
	    $result = mysql_query($query);

	    if (!$result) die("Database access failed: " . mysql_error());
	    $rows = mysql_num_rows($result);
	    
	    echo "<table align=center border='1'> <tr> <th>Name</th> <th>Min Player</th> <th>Max Player</th> <th>Theme</th> <th>Manufacturer</th> <th>Time</th> </tr>";

	    for ($j = 0; $j < $rows; ++$j)
	    {
	      $row = mysql_fetch_row($result);
	      $bgglink = "http://www.boardgamegeek.com/geeksearch.php?action=search&objecttype=boardgame&q=" . $row[1] . "&B1=Go";
	      echo <<<_END
	      <tr>
	      <td><a href=$bgglink target="_blank">$row[1]</a></td> <td>$row[2]</td> <td>$row[3]</td> <td>$row[4]</td> <td>$row[5]</td> <td>$row[6]</td>
	      </tr>
_END;
	    }
	    echo "</table>";
	?>
	  
      </div>

      </div> <!-- end bodycontent div -->
    </body>
</html>
