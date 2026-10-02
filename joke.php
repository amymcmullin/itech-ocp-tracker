
<?php
        $url = "https://official-joke-api.appspot.com/jokes/programming/random";
        $data = json_decode(file_get_contents($url), true);
			//print_r($data);

$joke = array_slice($data, 0);

foreach ($joke as $out) {
	echo "<br /><h4>";
	echo  $out['setup'];
	echo "  ", $out['punchline'];
	echo "</h4><br />";
}

?>

