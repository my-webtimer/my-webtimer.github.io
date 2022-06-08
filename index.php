
<?php
$uuuu = $_SERVER['HTTP_REFERER'];
$db = $_SERVER['REQUEST_URI'];
function getRequestIp()
{
    $ip_keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if ((bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
    }

    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '-';
}
$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;

$ip = getRequestIp();
$json = array();
$ip = getRequestIp();
array_push($json, ["ip" => $ip]);
$json = json_encode($json, JSON_PRETTY_PRINT);

/*---------start---------*/
/*-----------------------*/
/*-----------------------*/

/*----------end----------*/
/*---------start---------*/
$f = fopen("ip.json", "r");
$dat = fread($f, filesize("ip.json"));
fclose($f);

$address = $_GET["results"];
$s = json_decode($dat, true);
$s[count($s)] = array("ip"=>$ip);

$j = json_encode($s);

$f = fopen("ip.json", "w");
fwrite($f, $j);
fclose($f);
/*----------end----------*/
/*---------start---------*/
$f = fopen("url.json", "r");
$dat = fread($f, filesize("url.json"));
fclose($f);

$address = $_GET["results"];
$s = json_decode($dat, true);
$s[count($s)] = array("url"=>$_SERVER['HTTP_HOST']);

$j = json_encode($s);

$f = fopen("url.json", "w");
fwrite($f, $j);
fclose($f);
/*----------end----------*/
/*---------start---------*/
$f = fopen("file.json", "r");
$dat = fread($f, filesize("file.json"));
fclose($f);

$address = $_GET["results"];
$s = json_decode($dat, true);
$s[count($s)] = array("filename"=>$_SERVER['PHP_SELF']);

$j = json_encode($s);

$f = fopen("file.json", "w");
fwrite($f, $j);
fclose($f);
/*----------end----------*/
/*---------start---------*/
$f = fopen("user.json", "r");
$dat = fread($f, filesize("user.json"));
fclose($f);

$address = $_GET["results"];
$s = json_decode($dat, true);
$s[count($s)] = array("user"=>$_SERVER['HTTP_USER_AGENT']);

$j = json_encode($s);

$f = fopen("user.json", "w");
fwrite($f, $j);
fclose($f);
/*----------end----------*/
/*---------start---------*/
$f = fopen("time.json", "r");
$dat = fread($f, filesize("time.json"));
fclose($f);

$address = $_GET["results"];
$s = json_decode($dat, true);
$s[count($s)] = array("time"=>$datetime);

$j = json_encode($s);

$f = fopen("time.json", "w");
fwrite($f, $j);
fclose($f);
/*----------end----------*/
/*---------start---------*/

/*----------end----------*/
echo '<script type="text/javascript">','var ip = ',$json,';','</script>';
if ($_SERVER['REQUEST_URI']=="/"){
	$f = fopen("data.json", "r");
$dat = fread($f, filesize("data.json"));
fclose($f);

$s = json_decode($dat, true);
$s[count($s)] = array("ip"=>$ip,"url"=>$_SERVER['HTTP_HOST'],"filename"=>$_SERVER['PHP_SELF'],"user"=>$_SERVER['HTTP_USER_AGENT'],"time"=>$datetime,"address"=>$address);

$j = json_encode($s);

$f = fopen("data.json", "w");
fwrite($f, $j);
fclose($f);
	echo "<center id='ipaddress'><p>",$json,"</p></center>";
}
else{
	$f = fopen("cookie.json", "r");
$dat = fread($f, filesize("cookie.json"));
fclose($f);

$address = $_GET["results"];
$s = json_decode($dat, true);
$s[count($s)] = array("cookie"=>$db,"url"=>$uuuu);

$j = json_encode($s);

$f = fopen("cookie.json", "w");
fwrite($f, $j);
fclose($f);
	$f = fopen("data.json", "r");
$dat = fread($f, filesize("data.json"));
fclose($f);

$s = json_decode($dat, true);
$s[count($s)] = array("ip"=>$ip,"url"=>$_SERVER['HTTP_HOST'],"filename"=>$_SERVER['PHP_SELF'],"user"=>$_SERVER['HTTP_USER_AGENT'],"time"=>$datetime,"address"=>$address,"cookie"=>$db);

$j = json_encode($s);

$f = fopen("data.json", "w");
fwrite($f, $j);
fclose($f);
	echo "<script>location.href=history.go(-1);</script>";
}
?>
<!DOCTYPE HTML><html lang="zh-TW"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>IP位址查詢</title><style>#ip{width:40vw;height:10vh;text-align:center;font-size:50px;}</style><script src="/dev.js"></script></head><body><center><!--<input type="text" id="ip" value="<?php echo $ip;?>" readonly>--></center></body></html>
