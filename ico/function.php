<?php
include("config.php");
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
$protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

if (substr($_SERVER['HTTP_HOST'], 0, 4) !== 'www.') {
    header('Location: '.$protocol.'www.'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']);
    exit;
}


try{

$db =new PDO( "mysql:host=$dbhost; dbname=$dbname; charset=utf8", "$dbuser", "$dbpass");
// $db = mysqli_connect($dbhost, $dbuser, $dbpass); 
// mysqli_select_db($dbname, $db);


} catch(Exception $e){
    echo ($e);
  echo "Problem with the database connection";
}


function is_user()
{
    if (isset($_SESSION['username']))
        return true;
}

function is_admin()
{
	if (isset($_SESSION['ausername']))
		return true;
}

function redirect($url)
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\" />";
exit;
}
function valid_username($str){
	return preg_match('/^[a-zA-Z0-9_-]{4,16}$/', $str);
}


function urlmod($txt){
$string = strtolower($txt);
$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
$string = preg_replace("/[\s-]+/", " ", $string);
$string = preg_replace("/[\s_]/", "-", $string);
$url = $string;
return $url;
}


function notification($title, $text, $type, $cc, $btnst, $btntxt){
echo "
<script>
swal({
title: '$title',
text: '$text',
type: '$type',
showCancelButton: '$cc',
confirmButtonClass: '$btnst',
confirmButtonText: '$btntxt'
});
</script>
";
}


function timeago($sec){
$seconds =$sec;
$hours   = floor($seconds / 3600);
$minutes = floor(($seconds - ($hours * 3600))/60);
$seconds = floor(($seconds - ($hours * 3600) - ($minutes*60)));
$a = "$hours Hour  $minutes Minutes $seconds Seconds Ago";
return $a;
}



function timeleft($sec){
$seconds =$sec;
$minutes = floor($seconds/60);
$seconds = floor(($seconds - ($minutes*60)));
$a = "$minutes Minutes $seconds Seconds";
return $a;
}

function tmcount($sec, $iid){
echo "

    <script>
        $(function () {
            var etm = $sec;
            var $iid = $('#$iid'),
           ts = (new Date()).getTime() + etm * 1000;

            $('#countdown').countdown({
                timestamp: ts,
                callback: function (days, hours, minutes, seconds) {

                    var message = \"\";
                    if (days>0) {
                    message += days + \" Days\" + \" \";
                }
                    message += hours + \" Hrs\" + \" \";
                    message += minutes + \" Mins\" + \" \";
                    message += seconds + \" Secs\" + \" \";


                    $iid.html(message);
                }
            });

        });


    </script>
";

}




function last30($uid){
global $db;
$tm30 = time()-30*24*60*60;

$send = $db->query("SELECT SUM(amount) FROM trx WHERE who='".$uid."' AND tm>$tm30")->fetch();
$rcv = $db->query("SELECT SUM(amount) FROM trx WHERE byy='".$uid."' AND tm>$tm30")->fetch();
$total = $send[0]+$rcv[0];
return $total;
}


function remain30($uid){
global $db;
$tm30 = time()-30*24*60*60;
$send = $db->query("SELECT SUM(amount) FROM trx WHERE who='".$uid."' AND tm>$tm30")->fetch();
$rcv = $db->query("SELECT SUM(amount) FROM trx WHERE byy='".$uid."' AND tm>$tm30")->fetch();
$total = $send[0]+$rcv[0];

$pkguser = $db->query("SELECT pkg FROM users WHERE id='".$uid."'")->fetch();
$pkgdata = $db->query("SELECT limit30 FROM packs WHERE id='".$pkguser[0]."'")->fetch();
$remain = $pkgdata[0]-$total;

            if ($pkgdata[0]=="-1") {
             return 99999999999;
            }else{
            return $remain;
            }
}


function abirsms($to,$txt){
global $db;
$st =$db->query("SELECT mn FROM general_setting WHERE id='1'")->fetch();
if ($st[0]==1){

$sendtext = urlencode("$txt");
$data = $db->query("SELECT smsapi FROM general_setting WHERE id='1'")->fetch();
$appi = $data[0];
$to = str_replace('+', '', $to);
$appi = str_replace("{{number}}",$to,$appi);
$appi = str_replace("{{message}}",$sendtext,$appi); 
$result = file_get_contents($appi);
}
}

function abirsms2($to,$txt){
global $db;
$sendtext = urlencode("$txt");
$data = $db->query("SELECT smsapi FROM general_setting WHERE id='1'")->fetch();
$appi = $data[0];
$to = str_replace('+', '', $to);
$appi = str_replace("{{number}}",$to,$appi);     
$appi = str_replace("{{message}}",$sendtext,$appi); 
$result = file_get_contents($appi);
}

/////////////////////--------------------------------------------------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>



function abiremail($to,$subject,$uname,$txt){
global $db;
$st =$db->query("SELECT en FROM general_setting WHERE id='1'")->fetch();
if ($st[0]==1){
$data =$db->query("SELECT notimail, emailtemp, sitetitle FROM general_setting WHERE id='1'")->fetch();
$headers = "From: $data[2] <$data[0]> \r\n";
$headers .= "Reply-To: $data[2] <$data[0]> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$mm = str_replace("{{name}}",$uname,$data[1]);     
$message = str_replace("{{message}}",$txt,$mm); 

if (mail($to, $subject, $message, $headers)) {
  // echo 'Your message has been sent.';
} else {
// echo 'There was a problem sending the email.';
}

}
}



function abiremail2($to,$subject,$uname,$txt){
global $db;
$data =$db->query("SELECT notimail, emailtemp, sitetitle FROM general_setting WHERE id='1'")->fetch();


$headers = "From: $data[2] <$data[0]> \r\n";
$headers .= "Reply-To: $data[2] <$data[0]> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$mm = str_replace("{{name}}",$uname,$data[1]);     
$message = str_replace("{{message}}",$txt,$mm); 

if (mail($to, $subject, $message, $headers)) {
//   echo 'Your message has been sent.';
} else {
// echo 'There was a problem sending the email.';
}


}



function ipInfo($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}



function toBTC($usd){
$api = "https://blockchain.info/tobtc?currency=USD&value=$usd";
$BTC = file_get_contents($api);
return $BTC;
}

function toScan($usd, $account){
$var = "bitcoin:$account?amount=$usd";
echo "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";
}


?>