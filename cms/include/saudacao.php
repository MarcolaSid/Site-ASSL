<?php

$hora = date("H");

if ($hora < "6") {
    echo "Boa Madrugada ";
} else if ($hora < "12") {
    echo "Bom Dia ";
} else if ($hora < "18") {
    echo "Boa Tarde ";
} else {
	echo "Boa Noite ";
}

?>