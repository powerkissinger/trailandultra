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
	

//	$source="http://www.wser.org/news/"; 
//	$source="http://hardrock100.com/"; 
	$source="https://northburn100.co.nz/";

	$html = file_get_html($source);
	echo 'Job start<br>';

/* WS100
	foreach($html->find('.postmetadata') as $element2)
	{
		$pos0=strpos($element2->innertext,'on:');
		$pos00=strpos($element2->innertext,'by');
		echo substr($element2->innertext,$pos0+3,$pos00-$pos0-7);
	    $pos000=strpos($element2->innertext,'Comments');
		echo substr($element2->innertext,$pos000+48).'<br>';}
*/

/*
	//hardrock news
	foreach($html->find('h2') as $element)
	{
		echo $element->innertext.'<br>';
	}
*/
	//northburne100 recent posts
	foreach($html->find('#recent-posts-3') as $element)
	{
		$html2=str_get_html($element);
		foreach($html2->find('a') as $element2)
		echo $element2->innertext.'<br>';
	}

	//twitter crawler
	$settings = array(
		'oauth_access_token' => "23936419-SJLZqsQmDndXF8Puig8nSoi79BXTP2MyFebdROEtA",
		'oauth_access_token_secret' => "rCpAVwYMo1Zd10nho2c3rv2hKsCTYFQmH5NHzr0GMjrFT",
		'consumer_key' => "8xubOuI5MPPOYySyFpr0dcCGG",
		'consumer_secret' => "kHLIp6VdV1u74OLtWnMa7x6LZ5ReLLsi5kwXU2woBjS5o3ePxn"
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=gow100s&count=1';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	echo $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();


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