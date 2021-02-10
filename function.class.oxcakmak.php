<?php
/*
* Author: Osman CAKMAK
* Username: oxcakmak
* E-Mail: info@oxcakmak.com
* Website: https://oxcakmak.com/
* Creation Date: 17.01.2020
* Latest Version: v1.1.6
*/
class oxcakmak {
    /*
    * Rewrite Variable (Echo)
    * Using: $oxcakmak->reWrite("Hello WORLD!");
    * Output: Hello WORLD!
    */
    public function reWrite($var){
        echo $var;
    }
    
    /*
    * Lowercase Letter
    * Using: $oxcakmak->strLow("Hello WORLD!");
    * Output: hello world!
    */
    public function strLow($str){
        return strtolower($str);
    }

    /*
    * Uppercase Letter
    * Using: $oxcakmak->strUp("Hello World");
    * Output: HELLO WORLD!
    */
    public function strUp($str){
        return strtoupper($str);
    }

    /*
    * First Character Lowercase
    * Using: $oxcakmak->strLowFirst("Hello World");
    * Output: hello World
    */
    public function strLowFirst($str){
        return lcfirst($str);
    }

    /*
    * First Character Uppercase
    * Using: $oxcakmak->strUpFirst("hello world");
    * Output: Hello world
    */
    public function strUpFirst($str){
        return ucfirst($str);
    }

    /*
    * Checks that the specified character begins with a sentence
    * Using: if($oxcakmak->strStartWith("https://oxcakmak.com/", "https://")){ echo "true"; }else{ echo "false"; }
    * Output: true
    */
    public function strStartWith($str, $target, int $position = null){
		$length = strlen($str);
		$position = null === $position ? 0 : +$position;
		if ($position < 0) {
			$position = 0;
		} elseif ($position > $length) {
			$position = $length;
		}
		return $position >= 0 && substr($str, $position, strlen($target)) === $target;
	}

    /*
    * Checks that the specified character ends with a sentence
    * Using: if($oxcakmak->strEndWith("oxcakmak.com", "com")){ echo "true"; }else{ echo "false"; }
    * Output: true
    */
    public function strEndWith($str, $target, int $position = null){
		$length = strlen($str);
		$position = null === $position ? $length : +$position;
		if ($position < 0) {
			$position = 0;
		} elseif ($position > $length) {
			$position = $length;
		}
		$position -= strlen($target);
		return $position >= 0 && substr($str, $position, strlen($target)) === $target;
    }

    /*
    * Description
    * Using: $oxcakmak->strToUtf($variable);
    * Output: Deneme
    */
    public function strToUtf($str){
        return iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
    }
    
    /*
    * Cleans the entered illegal characters
    * Using: $oxcakmak->strClean("<h1>Hello World</h1>");
    * Output: Hello World
    */
    public function strClean($str){
		return htmlspecialchars(strip_tags(stripslashes(trim($str))), ENT_QUOTES, 'UTF-8');
    }
	
    /*
    * Cleans the entered illegal characters
    * Using: $oxcakmak->hideImportantValues("info@oxcakmak.com", 4);
    * Output: info***********
    */
    public function hideImportantValues($str, $start = null){
        $strLen = strlen($str);
        $strLenStar = "";
        $strMinusStar = "";
        for($i=0;$i<$strLen;$i++){ $strLenStar .= "*"; }
        for($i=0;$i<($strLen - $start);$i++){ $strMinusStar .= "*"; }
        if(empty($start)){
            echo $strLenStar; 
        }else{
            if($strLen > $start){
                echo substr($str, 0, $start).$strMinusStar;
            }else{
               echo $strLenStar; 
            }
        }
        
    }
    
    /*
    * Convert the entered text to seo link (Turkish Character Support Available)
    * Using: $oxcakmak->slugify("Hello My World Again");
    * Output: hello-my-world-again
    */
    public function slugify($string){
		$preg = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',', '+', '#', '.', '_');
		$match = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','', '', '', '', '');
		$perma = strtolower(str_replace($preg, $match, $string));
		$perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
		$perma = trim(preg_replace('/\s+/', ' ', $perma));
		$perma = str_replace(' ', '-', $perma);
		return $perma;
    }
    
    /*
    * Encrypt text
    * Using: $oxcakmak->hashPassword("admin");
    * Output: 3095ee219dea85f67c1e3a87898c1d5f7b712d20
    */
    public function hashPassword($string){
		$string = hash("md2", $string);
		$string = hash("sha1", $string);
		$string = hash("md4", $string);
		$string = hash("sha256", $string);
		$string = hash("md5", $string);
		$string = hash("sha384", $string);
		$string = hash("ripemd128", $string);
		$string = hash("sha512", $string);
		$string = hash("ripemd160", $string);
		$string = hash("whirlpool", $string);
		$string = hash("ripemd256", $string);
		$string = hash("snefru", $string);
		$string = hash("ripemd320", $string);
		$string = hash("gost", $string);
		$string = hash("crc32", $string);
		$string = hash("adler32", $string);
		$string = hash("crc32b", $string);
		$string = hash("sha1", $string);
		return $string;
    }
    
    /*
    * Password check
    * Using: if($oxcakmak->checkPassword("3095ee219dea85f67c1e3a87898c1d5f7b712d20", "3095ee219dea85f67c1e3a87898c1d5f7b712d20")){ echo "equal"; }else{ echo "not_equal"; }
    * Output: equal
    */
    public function checkPassword($hash, $stored){
        if($hash == $stored){ return 1; }else{ return 0; }
    }

    /*
    * Generates random character length MD5
    * Using: $oxcakmak->randomHash();
    * Output: (MD5) 3176a0571973682d06a05e3a064b09c7
    */
    public function randomHash(){
		return bin2hex(openssl_random_pseudo_bytes(16));
    }

    /*
    * Parses youtube id address
    * Using: $oxcakmak->parseYtId("https://www.youtube.com/watch?v=FzG4uDgje3M");
    * Output: FzG4uDgje3M
    */
    public function parseYtId($url){
        $pattern = '#^(?:https?://)?';
        $pattern .= '(?:www\.)?';
        $pattern .= '(?:';
        $pattern .= 'youtu\.be/';
        $pattern .= '|youtube\.com';
        $pattern .= '(?:';
        $pattern .= '/embed/';
        $pattern .= '|/v/';
        $pattern .= '|/watch\?v=';
        $pattern .= '|/watch\?.+&v=';
        $pattern .= ')';
        $pattern .= ')';
        $pattern .= '([\w-]{11})';
        $pattern .= '(?:.+)?$#x';
        preg_match($pattern, $url, $matches);
        return (isset($matches[1])) ? $matches[1] : FALSE;
    }

    /*
    * Generate a random floating digit number
    * 0 / 1 - true or false
    * Using: (Default) $oxcakmak->genRandNum(0, 100);  or $oxcakmak->genRandNum(0, 100, 0); or $oxcakmak->genRandNum(0, 100, false); 
    * Output: (Default) 73 (Float) 66.052140093433
    */
    public function genRandNum($lower = null, $upper = null, $floating = null){
		if (null === $floating) {
			if (is_bool($upper)) {
				$floating = $upper;
				$upper = null;
			} elseif (is_bool($lower)) {
				$floating = $lower;
				$lower = null;
			}
		}
		if (null === $lower && null === $upper) {
			$lower = 0;
			$upper = 1;
		} elseif (null === $upper) {
			$upper = $lower;
			$lower = 0;
		}
		if ($lower > $upper) {
			$temp = $lower;
			$lower = $upper;
			$upper = $temp;
		}
		$floating = $floating || (is_float($lower) || is_float($upper));
		if ($floating || $lower % 1 || $upper % 1) {
			$randMax = mt_getrandmax();
			return $lower + abs($upper - $lower) * mt_rand(0, $randMax) / $randMax;
		}
		return rand((int) $lower, (int) $upper);
    }
    
    /*
    * Calculate file size
    * Using: $oxcakmak->calcFileSize("5456786");
    * Output: 5.2 MB
    */
    public function calcFileSize($size){
        if ($size < 1024){ return $size . ' B'; }else{ $size = $size / 1024; $units = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"]; foreach ($units as $unit){ if(round($size, 2) >= 1024){ $size = $size / 1024; }else{ break; } } return round($size, 2) . ' ' . $unit; }
    }
    
    /*
    * Checks the extensions of the entered e-mail addresses (Blocks temporary e-mail addresses)
    * Initialize: $domains = array('gmail.com','yahoo.com','hotmail.com','outlook.com','msn.com','yandex.com');
    * Using: $oxcakmak->checkIsMail("info@oxcakmak.com", $domains);
    * Output: 0
    */
    public function checkIsMail($email, $domains){
		foreach ($domains as $domain) { 
			$pos = @strpos($email, $domain, strlen($email) - strlen($domain));
			if ($pos === false){ continue; } 
			if ($pos == 0 || $email[(int) $pos - 1] == "@" || $email[(int) $pos - 1] == "."){ return 1;  } 
		}
		return 0;
	}

    /*
    * Returns ip address
    * Using: $oxcakmak->getIPAddress();
    * Output: 127.0.0.1
    */
    public function getIPAddress(){
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote = $_SERVER['REMOTE_ADDR'];
		if(filter_var($client, FILTER_VALIDATE_IP)){ $ip = $client; }
		elseif(filter_var($forward, FILTER_VALIDATE_IP)){ $ip = $forward;
		}else{ $ip = $remote; }
		return $ip;
    }

    /*
    * Withdrawing Alexa site information
    * Using: $oxcakmak->fetchAlexaInfo("oxcakmak.com");
    * Output: Array ( [globalRank] => 418,994 [countryName] => Turkey [countryCode] => TR [countryRank] => 12,893 )
    */
    public function fetchAlexaInfo($url){
        $alexaXML = simplexml_load_file("http://data.alexa.com/data?cli=10&dat=snbamz&url=".$url);
        $alexaJson = json_decode(json_encode($alexaXML),true);
        $data = array(
            'globalRank' => substr(number_format($alexaJson['SD'][1]['POPULARITY']['@attributes']['TEXT'], 3), 0, -4),
            'countryName' => $alexaJson['SD'][1]['COUNTRY']['@attributes']['NAME'],
            'countryCode' => $alexaJson['SD'][1]['COUNTRY']['@attributes']['CODE'],
            'countryRank' => substr(number_format($alexaJson['SD'][1]['COUNTRY']['@attributes']['RANK'], 3), 0, -4)
        );
        return $data;
    }

    /*
    * Getting a site Google Analytics UA ID
    * Using: $oxcakmak->fetchGoogleAnalyticsUAID("https://oxcakmak.com");
    * Output: UA-XXX6227XX-1
    */
    public function fetchGoogleAnalyticsUAID($googleAnalyticsURL){
        $script_regex = "/<script\b[^>]*>([\s\S]*?)<\/script>/i";
        $ua_regex = "/UA-[0-9]{5,}-[0-9]{1,}/";
        preg_match_all($script_regex, file_get_contents($googleAnalyticsURL), $inside_script); 
        for ($i = 0; $i < count($inside_script[0]); $i++){ if (stristr($inside_script[0][$i], "ga.js")) $flag2_ga_js = TRUE; }
        preg_match_all($ua_regex, file_get_contents($googleAnalyticsURL), $ua_id);
        return ($ua_id[0][0])? $ua_id[0][0] : 'Not Found';
    }

    /*
    * Meta Title
    * Using: $oxcakmak->metaTitle("Blog", "-", "oxcakmak");
    * Output: <title>Blog - oxcakmak</title>
    */
    public function metaTitle($title, $sperator, $stuck){
        echo '<title>'.$title.' '.$sperator.' '.$stuck.'</title>'."\n";
    }

    /*
    * Meta Description
    * Using: $oxcakmak->metaDescription("Welcome my website!");
    * Output: <meta name="description" content="Welcome my website!">
    */
    public function metaDescription($description){
        echo '<meta name="description" content="'.$description.'">'."\n";
    }

    /*
    * Meta Keywords
    * Using: $oxcakmak->metaKeywords("oxcakmak, developer, freelance");
    * Output: <meta name="keywords" content="oxcakmak, developer, freelance">
    */
    public function metaKeywords($keywords){
        echo '<meta name="keywords" content="'.$keywords.'">'."\n";
    }

    /*
    * Meta Charset
    * Using: $oxcakmak->metaCharset();
    * Output: <meta charset="UTF-8">
    */
    public function metaCharset(){
        echo '<meta charset="UTF-8">'."\n";
    }

    /*
    * Meta Author
    * Using: $oxcakmak->metaAuthor("oxcakmak");
    * Output: <meta name="author" content="oxcakmak">
    */
    public function metaAuthor($author){
        echo '<meta name="author" content="'.$author.'">'."\n";
    }

    /*
    * Meta Base
    * Using: $oxcakmak->metaBaseHref("https://oxcakmak.com/");
    * Output: <base href="https://oxcakmak.com/">
    */
    public function metaBaseHref($url){
        echo '<base href="'.$url.'">'."\n";
    }

    /*
    * Meta Css Single
    * Using: $oxcakmak->metaCss("path/to/style.css");
    * Output: <link rel="stylesheet" href="path/to/style.css" />
    */
    public function metaCss($css){
        echo '<link rel="stylesheet" href="'.$css.'" />'."\n";
    }

    /*
    * Meta Css Multiple
    * Using: $oxcakmak->metaMultipleCss("path/to/style.css");
    * Output: <link rel="stylesheet" href="path/to/style.css" />
    */
    public function metaMultipleCss($css){
        foreach($css as $file){
            echo '<link rel="stylesheet" href="'.$file.'" />'."\n";
        }
    }

    /*
    * Meta Js Single
    * Using: $oxcakmak->metaCss("path/to/javascript.js");
    * Output: <script type="text/javascript" src="path/to/javascript.js" />
    */
    public function metaJs($js){
        echo '<script type="text/javascript" src="'.$js.'" />'."\n";
    }

    /*
    * Meta Js Multiple
    * Using: $oxcakmak->metaMultiples("path/to/javascript.js");
    * Output: <script type="text/javascript" src="path/to/javascript.js" />
    */
    public function metaMultipleJs($js){
        foreach($js as $file){
            echo '<script type="text/javascript" src="'.$file.'"></script>'."\n";
        }
    }

    /*
    * Meta Open Graph
    * Using: $oxcakmak->metaOpenGraph($variable);
    * Output: Deneme
    */
    public function metaOpenGraph($title, $url, $image, $description){
        echo '<meta name="og:title" content="'.$title.'">'."\n".'<meta name="og:url" content="'.$url.'">'."\n".'<meta name="og:image" content="'.$image.'">'."\n".'<meta name="og:description" content="'.$description.'">';
    }

    /*
    * Description
    * Using: $oxcakmak->Function($variable);
    * Output: Deneme
    */
}
?>
