<?php
	$childNameRaw = trim($_GET['childName']);
	$wantedPresent = trim($_GET['wantedPresent']);
	$riddles = trim($_GET['riddles']);

	$riddlesArray = explode(';', $riddles);

	$childName = str_replace(' ', '-', $childNameRaw);

	$index = strlen($childName) % count($riddlesArray);

	if ($index == 0) {
		$childsRiddle = $riddlesArray[count($riddlesArray) - 1];
	}
	else {
		$childsRiddle = $riddlesArray[$index - 1];
	}
	
	echo "\$giftOf". htmlspecialchars($childName).
	" = " .
	"$[wasChildGood] ? " .
	"'" .
	 htmlspecialchars($wantedPresent).
	 "' : '" .
	 htmlspecialchars($childsRiddle).
	 "';";