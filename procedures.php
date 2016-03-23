<?php			
function insertLocations($arg1, $arg2, $arg3)
{
	echo "PHP Funktionsaufruf. Argument:'" . $arg1 . "'";
}
	echo $_POST['hallo'].$_POST['moin'];
 // echo "Guten Tag, ich bin hier";

if (isset($_POST['a'])) {
	echo "Ich bin gesetzt!";

	switch ($_POST['a'])
	{
		case 'machwas':
			machwas($_POST['b']);
		break;

		default:
			break;
	}
}

?>