<html>
 <head>
  <title>This is a simple test</title>
 </head>
 <body>
<?php 

/**
 *  test page
 *
 */
  
    /********* 1.page **********/
	//DOM class
	include_once('./simple_html_dom.php');
	//twitter api class
	require_once('TwitterAPIExchange.php');	
	//encodeing
	header("Content-type: text/html; charset=utf-8");

	function display_web($url){
		$html = file_get_html($url);
		switch($url){
			case "http://www.wser.org/news/": // WS100
					foreach($html->find('.postmetadata') as $element2)
					{
						$pos0=strpos($element2->innertext,'on:');
						$pos00=strpos($element2->innertext,'by');
						$pos000=strpos($element2->innertext,'Comments');
						echo 'Western states: '.substr($element2->innertext,$pos0+3,$pos00-$pos0-7).substr($element2->innertext,$pos000+48).'<br>';
					}
					break;
			case "http://hardrock100.com/": //hardrock news
					foreach($html->find('h2') as $element)
					{
						echo 'hardrock: '.$element->innertext.'<br>';
					}
					break;
			case "http://northburn100.co.nz/": //northburne100 recent posts
					foreach($html->find('#recent-posts-3') as $element)
					{
						$html2=str_get_html($element);
						foreach($html2->find('a') as $element2)
						echo 'northburn: '.$element2->innertext.'<br>';
					}
					break;
		}
	}

	function display_twitter($name){

			//twitter crawler
		$settings = array(
			'oauth_access_token' => "23936419-SJLZqsQmDndXF8Puig8nSoi79BXTP2MyFebdROEtA",
			'oauth_access_token_secret' => "rCpAVwYMo1Zd10nho2c3rv2hKsCTYFQmH5NHzr0GMjrFT",
			'consumer_key' => "8xubOuI5MPPOYySyFpr0dcCGG",
			'consumer_secret' => "kHLIp6VdV1u74OLtWnMa7x6LZ5ReLLsi5kwXU2woBjS5o3ePxn"
		);

		$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield = '?screen_name='.$name.'&count=1';
		$requestMethod = 'GET';

		$twitter = new TwitterAPIExchange($settings);
		$html3=$twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
		$text_pos=strpos($html3,'"text":"');
		$next_pos=strpos($html3,'"',$text_pos+8);
		echo $name.':'.substr($html3,$text_pos+8,$next_pos-$text_pos-8).'<br>';
	}


	echo 'Job start<br>';

	$url_arr=array(
	"http://www.wser.org/news/",
	"http://hardrock100.com/",
	"http://northburn100.co.nz/"
	);

	$twitter_array =array(
	"UTAAUS",
	"gow100s",
	"wser100",
	"StefanaMarie",
	"antonkrupicka",
	"UTMBMontBlanc",
	"taraweraultra",
	"thatdakotajones",
	"BillyYang",
	"SageCanaday",
	"Transvulcania"
	);

	foreach ($url_arr as $url) {
		display_web($url);
	};

	foreach ($twitter_array as $name) {
		display_twitter($name);
	}


	// find all images
//	foreach($html->find('img') as $element) 
//       echo 'date:'.$element. '<br>';
	// Find all links 
//	foreach($html->find('a') as $element) 
//       echo 'link: '. $element->href . '<br>';

	echo 'job completed<br>';
?>
 </body>
</html>