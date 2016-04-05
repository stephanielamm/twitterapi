<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1968176760-FT4k4xYAiacrn1LSSIM1qt8ye3j4keuTxOqtiq4",
    'oauth_access_token_secret' => "WBlbTTYQ9ptvSiuDeTW7rQPkG93hD2syFrBYTIohe9uSV",
    'consumer_key' => "6Q98Cp8LsAE2tOxvrWR8apZOU",
    'consumer_secret' => "Yh5Fzv8PDajC68uwUSvjWLa3cwaHof1tvxTKex8uKj4mSurZOB"

);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock',
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->buildOauth($url, $requestMethod)
//              ->setPostfields($postfields)
//              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23baseball';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
// echo $twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest();

$tweetData = json_decode($twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest(),$assoc = True);

foreach($tweetData['statuses'] as $index => $items)
{


  echo "<div class='twitter-tweet'>Tweet:" . $items['text'] . "'</div></br>'";
  echo "When: " . $items['created_at'] . "</br>";
  echo "Where: " .$items['location']. "</br>";
}
?>
