<?

$counter_file = "./counter.txt";

if ($_SERVER["QUERY_STRING"]=='gimmesource') {
	highlight_file('index.php');
	die();
}

$counter = @file_get_contents($counter_file);
if (!$counter)
    $counter = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pronounceable Password Generator by Designeus Web Studio</title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="jquery.tools.min.js"></script>
    <script type="text/javascript" src="zeroclipboard/ZeroClipboard.js"></script>
    <script language="JavaScript">
        var clip = null;

        $(function() {
            // setup single ZeroClipboard object for all our elements
            clip = new ZeroClipboard.Client();
            clip.setHandCursor( true );
            // assign a common mouseover function for all elements using jQuery
            $('.copyme').mouseover( function() {
                // set the clip text to our innerHTML
                clip.setText( this.innerHTML );

                // reposition the movie over our element
                // or create it if this is the first time
                if (clip.div) {
                    clip.receiveEvent('mouseout', null);
                    clip.reposition(this);
                } else {
                    clip.glue(this);
                }

                // gotta force these events due to the Flash movie
                // moving all around.  This insures the CSS effects
                // are properly updated.
                clip.receiveEvent('mouseover', null);
            });

            $(".about_templates").tooltip({
                position: 'center right',
                // use "slide" effect
                effect: 'slide'
            // add dynamic plugin
            });

        });

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-57622-11']);
        _gaq.push(['_trackPageview']);

        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
        })();
    </script>
</head>
<body>

<div id="wrapper">
    <div id="header">
        <img src="img/logo.png" alt="Password Generator" />
        <h1>generated <?=number_format($counter);?> passwords since 2004/12/19</h1>
        <ul id="links">
            <li><a href="">about</a><span>•</span></li>
            <li><a href="">share/bookmark</a><span>•</span></li>
            <li><a href="https://chrome.google.com/extensions/detail/pjeobohajbopobondedhdnljhmoifncf">Chrome extension</a><span>•</span></li>
            <li><a href="">bookmarklet</a></li>
        </ul>
    </div><!-- END HEADER -->

<?

import_request_variables("g", "generate_");
if (!isset($generate_template))
    $generate_template = "Cvccvc99";

if (!isset($generate_number))
    $generate_number = 10;

$templates = array('Cvcv9', 'Cvccvc99', 'Cvccvccvc999', 'Cv#9cUcvCl9v', 'UlCv#9#cUcvC#l9vllV##99v9Ul#cc', '9999', '999999');

function GeneratePasswords($template, $number) {
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
        $returnarray[$x] = $password;
    }

    return $returnarray;
}

function microtime_float() {
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}
?>
    <div id="container">
    	<form>
    	<div id="generator">
            <h2>choose password template</h2>
            <a href="#" class="sprite about_templates" title="about templates"></a>
            <div class="tooltip">
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
            </div>
            <ul id="templates">
            <? foreach ($templates as $template) { ?>
   		<li><label><input name="template" type="radio" value="<?=$template?>" <? if ($template == $generate_template) { ?>checked="checked"<?}?> /><?=$template?></label></li>
            <? } ?>
            </ul>
            <input type="submit" class="sprite button" value="" />
        </div><!-- END GENERATOR -->
        </form>

        <div id="results">
            <h3>your passwords</h3>
            <em>click to copy to clipboard</em>
            <ul id="passwords">
<?
    $template = $generate_template;

    $number = $generate_number;
    $counter += $number;

    $time_start = microtime_float();
    $result = GeneratePasswords($template, $number);
    $time_end = microtime_float();
    $time = $time_end - $time_start;

    foreach ($result as $password)
        echo "\t<li class='copyme'>{$password}</li>\n";

    $fp = fopen($counter_file, "w");
    fwrite($fp, $counter);
    fclose($fp);

?>
            </ul>
        </div><!-- END RESULTS -->
    </div><!-- END CONTAINER -->

</div><!-- END WRAPPER -->

<div id="footer">
	<a class="designeus" title="this web site was built by Designeus Web Studio" href="http://www.designeus.hr"></a>
</div>

</body>
</html>