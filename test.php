<?php

require __DIR__ . '/vendor/autoload.php';

$swissNumberStr = "044 668 18 00";
$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
try {
    $swissNumberProto = $phoneUtil->parse($swissNumberStr, "CH");
		    var_dump($swissNumberProto);
				} catch (\libphonenumber\NumberParseException $e) {
				    var_dump($e);
						}

		?>
