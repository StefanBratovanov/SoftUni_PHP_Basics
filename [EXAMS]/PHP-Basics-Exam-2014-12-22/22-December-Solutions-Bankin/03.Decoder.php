<?php
	$jsonTable = $_GET['jsonTable'];
	$inputArray = json_decode($jsonTable);

	$numberOfColumns = intval($inputArray[0]);
	$pattern = '/Reply from [\w\W]+?: bytes=[\w\W]+? time=(\d+)ms TTL=[\w\W]+?/';

	$currentColumn = 0;
	$isOpened = false;

	echo "<table border='1' cellpadding='5'>";

	foreach ($inputArray[1] as $key => $value) {
		if (!$isOpened) {
			echo '<tr>';
			$isOpened = true;
		}
		
		preg_match_all($pattern, $value, $millis);
		if (!empty($millis[1][0])) {
			$charCode = $millis[1][0];
			echo '<td';

			if (ctype_alpha(chr($charCode)) || chr($charCode) == ' ') {
				echo " style='background:#CAF'";
			}

			echo '>'. chr($charCode);

			echo '</td>';
		}

		if ($currentColumn == $numberOfColumns) {
			echo '</tr>';
			$isOpened = false;
		}

		$currentColumn = $currentColumn + 1 > $numberOfColumns ? 1 : $currentColumn + 1;
	}

	if ($isOpened) {
		echo '</tr>';
	}

	echo '</table>';

