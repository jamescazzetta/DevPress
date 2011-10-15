<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>Sample Title</title>
	<style type="text/css" media="screen">
	a, a strong{color:#2173af; text-decoration:none;}
	a:hover{text-decoration:underline;}
	address{font-style:normal; margin-bottom:18px;}
	blockquote{font:italic 15px/22px 'Georgia', serif; margin:0;}
	body{color:#636b75; font:13px/18px Arial, sans-serif; margin:0; padding:10px;}
	cite{display:block; font-style:normal; font-weight:bold; margin-bottom:18px;}
	code{overflow:hidden;}
	dl{}
	dt{color:#3e434a; font-weight:bold;}
	dd{margin:0 0 18px 0;}
	h1{font:normal 30px/36px Arial, sans-serif; margin:0 0 18px 0; padding:0;}
	h2{color:#000; font:normal 30px/36px Arial, sans-serif; margin:0px 0 18px 0; padding:0;}
	h3{color:#000; font:normal 18px/27px Arial, sans-serif; margin:0 0 18px 0; padding:0;}
	h4{color:#3e434a; font:bold 15px/20px Arial, sans-serif; margin:0px 0 18px 0; padding:0;}
	h5{color:#3e434a; font:bold 13px/18px Arial, sans-serif; margin:0; padding:0;}
	hr{display:none;}
	.hr{border-top:1px solid #e5e6e8; height:0; margin:36px 0;}
	img{border:none;}
	li{margin-bottom:18px;}
	p{margin:0 0 18px 0; padding:0;}
	pre{white-space:pre-wrap; /* css-3 */ white-space:-moz-pre-wrap; /* Mozilla, since 1999 */ white-space:-pre-wrap; /* Opera 4-6 */ white-space:-o-pre-wrap; /* Opera 7 */}
	small{font-size:11px;}
	strong{color:#3e434a;}
	table{border:none; border-collapse:collapse; margin-bottom:45px;}
	td, th{border-bottom:1px solid #d7d7d7; color:#3e434a; padding:6px 12px;}
	th{}
	th}
	th}
	tr{}
	ul{}
	ul.plain{list-style:none; margin:0; padding:0;}
	ul.plain li{margin-bottom:9px;}
	

	.text, .textarea, .select{margin-bottom:9px;}
	.buttons .image{padding:0;}
	fieldset{padding: 10px; margin: 10px 0; border: 1px solid #999;}
	label{display: block;}
	
	
		#log {
			padding: 0px 10px;
			border: 1px solid #999;
			height: 150px;
			background-color: #eee;
			color: #555;
			font-size: 10px;
			overflow: auto;
			box-shadow:1px 1px 24px #ddd inset;
		}
		#log-wrapper{
			position: relative;
			
		}
		#log-wrapper:after{
			content: "Console";
			position: absolute;
			display: block;
			top:0px;
			right:0px;
			line-height: 17px;
			background-color: #999;
			color: #fff;
			padding: 2px 10px 2px 15px;
			border-radius:0 0 0 40px;
			font-weight: bold;
			font-size: 10px;
			
		}
		#log .log_failed{
			color: red;
		}
		#log p{
			margin-bottom: 5px;
		}

	</style>

</head>

<body>

	<form action="signUp.aspx" method="post" id="form-sign-up" name="signUp">

							<fieldset id="setup">
								<div class="top"></div>
								<h2>Set up your account</h2>



								<p>Please use a valid email address, you’ll need to verify it before you can send any campaigns.</p>
								<table width="100%">
									<tr>
										<td width="50%">
								<div class="text">
									<label for="ContactName">Name</label>
									<input class="required" type="text" name="ContactName" id="ContactName" value="" onblur="javascript:if(document.signUp.ContactName.value != '') pageTracker._trackPageview('/internal/form/signup/contactname');">
								</div>
								<div class="text">
									<label for="ea">Email Address</label>
									<input class="required" type="text" name="ea" id="ea" value="" onblur="javascript:if(document.signUp.ea.value != '') pageTracker._trackPageview('/internal/form/signup/email');">
								</div>
								<div class="text">
									<label for="username">Username</label>
									<input class="required" type="text" name="username" id="username" value="" onblur="javascript:if(document.signUp.username.value != '') pageTracker._trackPageview('/internal/form/signup/username');">
								</div>
								</td>
								<td>
	                            <div class="pass_field">
	                                <div class="form_left resetStrength" style="position: absolute; left: 344px;"> 
	                                    <div id="mypassword_text" class="resetText"></div>
	                                    <div id="mypassword_bar" class="resetBar"></div> 
	                                </div>
	                                <div class="text">
	                                    <label for="password">Password</label>
	                                    <input class="required form_left" type="password" name="password" id="password" value="" onblur="javascript:if(document.signUp.password.value != '') pageTracker._trackPageview('/internal/form/signup/password');" onkeyup="runPassword(this.value, 'mypassword');">
	                                </div>
	                            </div>
	                            <div class="form_clear"></div>
								<div class="text">
									<label for="CompanyName">Company</label>
									<input class="required" type="text" name="CompanyName" id="CompanyName" value="" onchange="suggestUrl();" onblur="checkPass(); if(document.signUp.CompanyName.value != '') pageTracker._trackPageview('/internal/form/signup/companyname');">
								</div>

								<input type="hidden" name="Country" value="Switzerland">
								<input type="hidden" name="CountryAutodetected" value="true">

								<div class="select">
									<label for="TimeZone">Timezone</label>
									<select name="TimeZone" id="timezone" class="required" onblur="javascript:pageTracker._trackPageview('/internal/form/signup/timezone');"><option value="">Please Select a Time Zone</option><option value="(GMT) Casablanca">(GMT) Casablanca</option><option value="(GMT) Coordinated Universal Time">(GMT) Coordinated Universal Time</option><option value="(GMT) Dublin, Edinburgh, Lisbon, London">(GMT) Dublin, Edinburgh, Lisbon, London</option><option value="(GMT) Monrovia, Reykjavik">(GMT) Monrovia, Reykjavik</option><option value="(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option><option value="(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option><option value="(GMT+01:00) Brussels, Copenhagen, Madrid, Paris">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option><option value="(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option><option value="(GMT+01:00) West Central Africa">(GMT+01:00) West Central Africa</option><option value="(GMT+01:00) Windhoek">(GMT+01:00) Windhoek</option><option value="(GMT+02:00) Amman">(GMT+02:00) Amman</option><option value="(GMT+02:00) Athens, Bucharest, Istanbul">(GMT+02:00) Athens, Bucharest, Istanbul</option><option value="(GMT+02:00) Beirut">(GMT+02:00) Beirut</option><option value="(GMT+02:00) Cairo">(GMT+02:00) Cairo</option><option value="(GMT+02:00) Damascus">(GMT+02:00) Damascus</option><option value="(GMT+02:00) Harare, Pretoria">(GMT+02:00) Harare, Pretoria</option><option value="(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option><option value="(GMT+02:00) Jerusalem">(GMT+02:00) Jerusalem</option><option value="(GMT+02:00) Minsk">(GMT+02:00) Minsk</option><option value="(GMT+03:00) Baghdad">(GMT+03:00) Baghdad</option><option value="(GMT+03:00) Kuwait, Riyadh">(GMT+03:00) Kuwait, Riyadh</option><option value="(GMT+03:00) Moscow, St. Petersburg, Volgograd">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option><option value="(GMT+03:00) Nairobi">(GMT+03:00) Nairobi</option><option value="(GMT+03:30) Tehran">(GMT+03:30) Tehran</option><option value="(GMT+04:00) Abu Dhabi, Muscat">(GMT+04:00) Abu Dhabi, Muscat</option><option value="(GMT+04:00) Baku">(GMT+04:00) Baku</option><option value="(GMT+04:00) Port Louis">(GMT+04:00) Port Louis</option><option value="(GMT+04:00) Tbilisi">(GMT+04:00) Tbilisi</option><option value="(GMT+04:00) Yerevan">(GMT+04:00) Yerevan</option><option value="(GMT+04:30) Kabul">(GMT+04:30) Kabul</option><option value="(GMT+05:00) Ekaterinburg">(GMT+05:00) Ekaterinburg</option><option value="(GMT+05:00) Islamabad, Karachi">(GMT+05:00) Islamabad, Karachi</option><option value="(GMT+05:00) Tashkent">(GMT+05:00) Tashkent</option><option value="(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option><option value="(GMT+05:30) Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option><option value="(GMT+05:45) Kathmandu">(GMT+05:45) Kathmandu</option><option value="(GMT+06:00) Astana">(GMT+06:00) Astana</option><option value="(GMT+06:00) Dhaka">(GMT+06:00) Dhaka</option><option value="(GMT+06:00) Novosibirsk">(GMT+06:00) Novosibirsk</option><option value="(GMT+06:30) Yangon (Rangoon)">(GMT+06:30) Yangon (Rangoon)</option><option value="(GMT+07:00) Bangkok, Hanoi, Jakarta">(GMT+07:00) Bangkok, Hanoi, Jakarta</option><option value="(GMT+07:00) Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option><option value="(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option><option value="(GMT+08:00) Irkutsk">(GMT+08:00) Irkutsk</option><option value="(GMT+08:00) Kuala Lumpur, Singapore">(GMT+08:00) Kuala Lumpur, Singapore</option><option value="(GMT+08:00) Perth">(GMT+08:00) Perth</option><option value="(GMT+08:00) Taipei">(GMT+08:00) Taipei</option><option value="(GMT+08:00) Ulaanbaatar">(GMT+08:00) Ulaanbaatar</option><option value="(GMT+09:00) Osaka, Sapporo, Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option><option value="(GMT+09:00) Seoul">(GMT+09:00) Seoul</option><option value="(GMT+09:00) Yakutsk">(GMT+09:00) Yakutsk</option><option value="(GMT+09:30) Adelaide">(GMT+09:30) Adelaide</option><option value="(GMT+09:30) Darwin">(GMT+09:30) Darwin</option><option value="(GMT+10:00) Brisbane">(GMT+10:00) Brisbane</option><option value="(GMT+10:00) Canberra, Melbourne, Sydney">(GMT+10:00) Canberra, Melbourne, Sydney</option><option value="(GMT+10:00) Guam, Port Moresby">(GMT+10:00) Guam, Port Moresby</option><option value="(GMT+10:00) Hobart">(GMT+10:00) Hobart</option><option value="(GMT+10:00) Vladivostok">(GMT+10:00) Vladivostok</option><option value="(GMT+11:00) Magadan">(GMT+11:00) Magadan</option><option value="(GMT+11:00) Solomon Is., New Caledonia">(GMT+11:00) Solomon Is., New Caledonia</option><option value="(GMT+12:00) Auckland, Wellington">(GMT+12:00) Auckland, Wellington</option><option value="(GMT+12:00) Coordinated Universal Time+12">(GMT+12:00) Coordinated Universal Time+12</option><option value="(GMT+12:00) Fiji">(GMT+12:00) Fiji</option><option value="(GMT+12:00) Petropavlovsk-Kamchatsky - Old">(GMT+12:00) Petropavlovsk-Kamchatsky - Old</option><option value="(GMT+13:00) Nuku'alofa">(GMT+13:00) Nuku'alofa</option><option value="(GMT-01:00) Azores">(GMT-01:00) Azores</option><option value="(GMT-01:00) Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option><option value="(GMT-02:00) Coordinated Universal Time-02">(GMT-02:00) Coordinated Universal Time-02</option><option value="(GMT-02:00) Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option><option value="(GMT-03:00) Brasilia">(GMT-03:00) Brasilia</option><option value="(GMT-03:00) Buenos Aires">(GMT-03:00) Buenos Aires</option><option value="(GMT-03:00) Cayenne, Fortaleza">(GMT-03:00) Cayenne, Fortaleza</option><option value="(GMT-03:00) Greenland">(GMT-03:00) Greenland</option><option value="(GMT-03:00) Montevideo">(GMT-03:00) Montevideo</option><option value="(GMT-03:30) Newfoundland">(GMT-03:30) Newfoundland</option><option value="(GMT-04:00) Asuncion">(GMT-04:00) Asuncion</option><option value="(GMT-04:00) Atlantic Time (Canada)">(GMT-04:00) Atlantic Time (Canada)</option><option value="(GMT-04:00) Cuiaba">(GMT-04:00) Cuiaba</option><option value="(GMT-04:00) Georgetown, La Paz, Manaus, San Juan">(GMT-04:00) Georgetown, La Paz, Manaus, San Juan</option><option value="(GMT-04:00) Santiago">(GMT-04:00) Santiago</option><option value="(GMT-04:30) Caracas">(GMT-04:30) Caracas</option><option value="(GMT-05:00) Bogota, Lima, Quito">(GMT-05:00) Bogota, Lima, Quito</option><option value="(GMT-05:00) Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option><option value="(GMT-05:00) Indiana (East)">(GMT-05:00) Indiana (East)</option><option value="(GMT-06:00) Central America">(GMT-06:00) Central America</option><option value="(GMT-06:00) Central Time (US &amp; Canada)">(GMT-06:00) Central Time (US &amp; Canada)</option><option value="(GMT-06:00) Guadalajara, Mexico City, Monterrey">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option><option value="(GMT-06:00) Saskatchewan">(GMT-06:00) Saskatchewan</option><option value="(GMT-07:00) Arizona">(GMT-07:00) Arizona</option><option value="(GMT-07:00) Chihuahua, La Paz, Mazatlan">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option><option value="(GMT-07:00) Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option><option value="(GMT-08:00) Baja California">(GMT-08:00) Baja California</option><option value="(GMT-08:00) Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option><option value="(GMT-09:00) Alaska">(GMT-09:00) Alaska</option><option value="(GMT-10:00) Hawaii">(GMT-10:00) Hawaii</option><option value="(GMT-11:00) Coordinated Universal Time-11">(GMT-11:00) Coordinated Universal Time-11</option><option value="(GMT-11:00) Samoa">(GMT-11:00) Samoa</option><option value="(GMT-12:00) International Date Line West">(GMT-12:00) International Date Line West</option></select>
								</div>
								</td>
								</tr>
								</table>
								<div class="btm"></div>
							</fieldset>
							<fieldset id="address">
								<div class="top"></div>
								<h2>Select your Campaign Monitor site address</h2>
								<p>This is your very own Campaign Monitor site address where you’ll login to your account. If you give any of your clients account access, they’ll login from this address too.</p>
								<div class="text su_site_address">

									<label for="AddressPrefix">Site Address</label>
									<input class="required" maxlength="50" type="text" name="AddressPrefix" id="AddressPrefix" onkeyup="checkSiteAddress(this.value);" value=""> <strong>.createsend.com</strong>
									<div class="clear"></div>
									<div id="is_available"></div>
								</div>
								<div class="btm"></div>
							</fieldset>

							<fieldset id="create">
								<div class="top"></div>
								<h2>Create your account</h2>
								<p>By clicking the button below, you agree to Campaign Monitor’s <a href="http://www.campaignmonitor.com/terms/" id="terms">Terms of Use</a>, <a href="http://www.campaignmonitor.com/privacy/" id="privacy">Privacy Policy</a> and <a href="http://www.campaignmonitor.com/anti-spam/" id="spam">Anti-spam Policy</a>.</p>
								<div class="checkbox">
									<input type="checkbox" name="MonthlyNewsletter" id="MonthlyNewsletter" onclick="javascript:pageTracker._trackPageview('/internal/form/signup/terms');" class="checkbox" value="MonthlyNewsletter"> 
									<label for="MonthlyNewsletter">Send me useful tips on email design every month or so (you can unsubscribe at any time).</label>
								</div>
								<div class="buttons">
									<input type="submit" name="submit" id="submit" value="submit" class="image" onclick="javascript:pageTracker._trackPageview('/internal/form/signup/submit');"> 
								</div>
								<div class="btm"></div>
							</fieldset>
							<input type="hidden" name="refererURL" value="http://www.google.ch/search?client=safari&amp;rls=en&amp;q=Campaign+Monitor&amp;ie=UTF-8&amp;oe=UTF-8&amp;redir_esc=&amp;ei=7ZuDTtbhM4qc0QWDwO3EAQ">
							<input type="hidden" name="dateOfFirstVisit" value="Wed, 28 Sep 2011 22:13:05 GMT">
							<input type="hidden" name="landingPage" value="http://www.campaignmonitor.com/">
							<input type="hidden" name="signupVar" value="">
						</form>


<?php
include('mr_config.php');
include('functions.php');
include('erm_builder.php');
include('data_builder.php');
include('erm.php');







function build_input($args){
	
}


class cms_form { 
	public $table;
	
	public function setTable($table) { 
		$this->table = $table; 
	}
	public function getTable() { 
		return $this->table; 
	}

	public function formstart() {
		return '<form>';
    }
	
	function make_formelement() {
		$return = $this->formstart(); 
		$return .= $this->getTable();
		$return .= $this->formend(); 
		return $return;
		
		
     } 

	public function formend() {
		return '</form>';
    }

}


class cms_form_template extends cms_form {

    // constructor
    public function __construct() {
        parent::__construct();
        $this->colour = "white";
        $this->weight = 600;
    }

    // define methods
    public function swim() {
        echo $this->name." is swimming... ";
    }
}


function autobuild_form($table, $id){
	$products_form = '';
	$data = data(array('table' => $table));
	
	foreach ($data[$id] as $key => $dat) {
			$products_form .= "<label for='{$key}_$dat[id]']'>$key</label><input type='text' name='$key' value='$dat' id='{$key}_$dat[id]' /><br />";
	}
	
	return $products_form;
	
}

function buildfield($data, $col, $id, $type, $relation){
	$products_form = '';
	
	
	switch ($type) {
		case 'text':
			$products_form .= "<label for='{$col}_$id']'>$col</label><input type='text' name='$col' value='" . $data[$id][$col] . "' id='{$col}_$id' /><br />";
			break;
			
		case 'select':
				$products_form .= '<select name="'.$col.'" id="'.$col.'_'.$id.'" onchange="" size="1">';
				foreach ($data[$id][$col] as $item) {
					$products_form .= "<option value='" . $item[$col.'_id'] . "'>" .  $item[$col.'_id'] . "</option>";
				}
				$products_form .= '</select>';
				break;
			
		default:
	
			break;
	}
	
	
	return $products_form;	
	
}

/*
require(myCLass.php); 

$newObject = new myClass(); 

$newObject->doSomething();

*/


$products_form = new cms_form(); 
$products_form->setTable("produkte");

//echo autobuild_form('produkte', '1');

$args = array(
	'table' => 'produkte',
	'joins' => array('technologien', 'gallery', 'typischeanwendungen') //no tweens!!!
);
$data = data($args);



//echo buildfield($data, 'name', '2', 'text', 'self');
//echo buildfield($data, 'gallery', '2', 'select', 's2m');









$args = array(
	'table' => 'produkte',
	'joins' => array('technologien', 'gallery', 'typischeanwendungen') //no tweens!!!
);
$data = data($args);



//echo '<textarea cols="50" rows="40">';
//print_r($data);
//echo '</textarea>';











?>


<script>
	document.getElementById("ContactName").focus();	
</script>

</body>
</html>