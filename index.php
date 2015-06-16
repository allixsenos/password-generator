<?

$counter_file = "./counter.txt";

if (strtolower($_SERVER['SERVER_NAME'])!='generator.designeus.net')
    header("Location: http://generator.designeus.net/");

if ($_SERVER["QUERY_STRING"]=='gimmesource') {
	highlight_file('index.php');
	die();
}

if ($fp = fopen($counter_file, "r"))
{
    $counter = (int) fread($fp, 20);
    fclose($fp);
}
else
{
    $counter = 0;
}

?>
<html>
<head>
<title> DESIGNEUS .:. Password Generator</title>
<style>
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}
body {
	background-color: #4A4A4A;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
input.unos, textarea, select {
	border:0px;
	color:#000;
	background-color:#AFB7AF;
}

input.unos:focus, textarea:focus, select:focus {
	color:#000;
	background-color:#D6DBD6;
}

input.gumb {
	color:#0099FF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	background-color:#333333;
	border:1px;
	border-top:#FFFFFF;
	border-left:#FFFFFF;
	border-top:#DDDDDD;
	border-left:#DDDDDD;
	cursor:pointer;
 }

input.gumb:focus, input.gumb:hover {
	color:#FC780D;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	background-color:#333333;
	border:1px;
	border-top:#FFFFFF;
	border-left:#FFFFFF;
	border-top:#DDDDDD;
	border-left:#DDDDDD;
	cursor: pointer;
	}
a {
	color:#0099FF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
 }

a:focus, a:hover {
	color:#FC780D;
	}
.row1 {
	background-color:#333;
	text-align:center;
	}

.row2 {
	background-color:#555;
	text-align:center;
	}
.naslov {
	font-size: 18px;
	font-weight: bold;
	color: #F2F2F2;
	font-variant: small-caps;
}
.malinaslov {
	font-size: 14px;
	color: #F0F0F0;
	font-weight: bold;
	font-variant: small-caps;
}
</style>
</head>

<body>
<p><span class="naslov">Password Generator by <a href="http://www.designeus.net/">Designeus</a></span><br />
<span class="malinaslov">Generated <?=$counter?> passwords since 2004-12-19.</span></p>
<?

import_request_variables("g", "generate_");
if (!isset($generate_template))
    $generate_template = 1;

if (!isset($generate_number))
    $generate_number = 10;


$templates = array('Cvcv9', 'Cvccvc99', 'Cvccvccvc999', 'Cv#9cUcvCl9v', 'UlCv#9#cUcvC#l9vllV##99v9Ul#cc', '9999', '999999');

Function GeneratePasswords($template, $number)
{
    $chars['l'] = 'abcdefghijklmnoprstuvwxyz';
    $chars['U'] = strtoupper($chars['l']);
    $chars['v'] = 'aeiouy';
    $chars['V'] = strtoupper($chars['v']);
    $chars['c'] = 'bcdfghjklmnprstvwxz';
    $chars['C'] = strtoupper($chars['c']);
    $chars['9'] = '0123456789';
    $chars['#'] = '!@#$%^&*_-+=()[]{}';
    $chars['a'] = $chars['l'].$chars['9'];
    $chars['A'] = strtoupper($chars['a']);

    for ($x = 0; $x < $number; $x++)
    {
        $password = '';
        for ($i = 0; $i < strlen($template); $i++)
        {
            $type = $template{$i};
            $haystack = $chars[$type];
            $location  = mt_rand(1, strlen($haystack));
            $sign = $haystack{$location-1};
            $password .= $sign;
        }
        //echo '(' . strlen($password) . ') ' . $password . "<br>\n";
        $returnarray[$x] = $password;
    }

    return $returnarray;
}

function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}
?>
<form action="/" method="GET">
    <input type="hidden" name="dopasswords" value="true">
    <table border="0" cellpadding="2" cellspacing="2">
        <tr>
            <td valign="top" class="malinaslov">Template:</td>
            <td><SELECT name="template" size=<?=count($templates)+1?>>
        <? foreach ($templates as $key => $value)
            {
                echo "\t<OPTION value=\"{$key}\"";
                if ($key == $generate_template)
                    echo " SELECTED";
                echo ">{$value}</OPTION>\n";
            }?>
            <OPTION value="custom" <? if ($generate_template == 'custom') echo 'SELECTED';?>>Custom template</OPTION>
            </SELECT></td>
            <td>
                <table>
                    <tr>
                        <th>type</th>
                        <th>mark</th>
                        <th>letters used</th>
                    <tr>
                    <tr>
                        <td>lowercase</td>
                        <td align="center">l</td>
                        <td>abcdefghijklmnoprstuvwxyz</td>
                    </tr>
                    <tr>
                        <td>UPPERCASE</td>
                        <td align="center">U</td>
                        <td>ABCDEFGHIJKLMNOPRSTUVWXYZ</td>
                    </tr>
                    <tr>
                        <td>vocal</td>
                        <td align="center">v</td>
                        <td>aeiouy</td>
                    </tr>
                    <tr>
                        <td>VOCAL</td>
                        <td align="center">V</td>
                        <td>AEIOUY</td>
                    </tr>
                    <tr>
                        <td>consonant</td>
                        <td align="center">c</td>
                        <td>bcdfghjklmnprstvwxz</td>
                    </tr>
                    <tr>
                        <td>CONSONANT</td>
                        <td align="center">C</td>
                        <td>BCDFGHJKLMNPRSTVWXZ</td>
                    </tr>
                    <tr>
                        <td>numbers</td>
                        <td align="center">9</td>
                        <td>0123456789</td>
                    </tr>
                    <tr>
                        <td>non-letter</td>
                        <td align="center">#</td>
                        <td><?=htmlentities('!@#$%^&*_-+=()[]{}')?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" class="malinaslov">Custom Template:</td>
            <td><input type="text" name="custom_template" size="40" maxlength="100" class="unos" value="<?=$generate_custom_template?>"></td>
        </tr>
        <tr>
            <td valign="top" class="malinaslov">Number of passwords:</td>
            <td><input type="text" name="number" size="10" maxlength="4" class="unos" value="<?=$generate_number?>"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Generate!" class="gumb"></td>
        </tr>
    </table>
</form>
<?
if ($generate_dopasswords == 'true')
{
    if ($generate_template == 'custom')
        $template = $generate_custom_template;
    else
        $template = $templates[$generate_template];

    $number = $generate_number;
    $counter += $number;

    $time_start = microtime_float();
    $result = GeneratePasswords($template, $number);
    $time_end = microtime_float();
    $time = $time_end - $time_start;

    echo "<table>\n";
    foreach ($result as $key => $password)
        echo "\t<tr><td>" . ($key+1) . '</td><td>' . $password . "</td></tr>\n";
    echo "</table>\n";

    $fp = fopen($counter_file, "w");
    fwrite($fp, $counter);
    fclose($fp);


    echo "<p style=\"text-align: center;\">Operation finished in " . (int)($time*1000000) . " microseconds<br /></p>";
}

?>

</body>
</html>
