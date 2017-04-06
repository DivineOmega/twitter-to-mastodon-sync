<?php

require_once __DIR__.'/../vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;
use rapidweb\RWFileCache\RWFileCache;
use theCodingCompany\Mastodon;
use DivineOmega\TwitterToMastodonSync\Objects\TweetToTootConvertor;

$cacheDirectory = __DIR__.'/../cache/';

mkdir($cacheDirectory);

$cache = new RWFileCache();
$cache->changeConfig([
        'unixLoadUpperThreshold' => 999,
        'gzipCompression'        => false,
        'cacheDirectory'         => $cacheDirectory,
        'fileExtension' => 'cache'
    ]);

echo PHP_EOL;
echo 'Twitter to Mastodon Sync Tool';
echo PHP_EOL;
echo '------------------------------';
echo PHP_EOL;
echo PHP_EOL;

/*
$twitterAppDetails = $cache->get('twitterAppDetails');

if ($twitterAppDetails) {
    do {
        echo 'Would you like to use previously remembered Twitter app details? [y/n]: ';
        $useRemembered = trim(fgets(STDIN));
    } while($useRemembered != 'y' && $useRemembered != 'n');
}

if (!$twitterAppDetails || $useRemembered == 'n') {

    echo 'You need to create a new Twitter app for this tool to use.';
    echo PHP_EOL;
    echo PHP_EOL;
    echo '1. Go to https://apps.twitter.com/ to do this, leaving the \'Callback URL\' field blank.';
    echo PHP_EOL;
    echo '2. Go to your app\'s \'Keys and Access Tokens\' tab.';
    echo PHP_EOL;
    echo '3. Click the \'Create my access token\' button.';
    echo PHP_EOL;
    echo '4. Enter the required API keys below.';
    echo PHP_EOL;
    echo PHP_EOL;

    $twitterAppDetails = [];

    echo 'Consumer Key: ';
    $twitterAppDetails['consumerKey'] = trim(fgets(STDIN));

    echo 'Consumer Secret: ';
    $twitterAppDetails['consumerSecret'] = trim(fgets(STDIN));

    echo 'Access Token: ';
    $twitterAppDetails['accessToken'] = trim(fgets(STDIN));

    echo 'Access Token Secret: ';
    $twitterAppDetails['accessTokenSecret'] = trim(fgets(STDIN));

    do {
        echo 'Would you like to remember these details? [y/n]: ';
        $remember = trim(fgets(STDIN));
    } while($remember != 'y' && $remember != 'n');

    if ($remember == 'y') {
        $cache->set('twitterAppDetails', $twitterAppDetails);
    }

}

$connection = new TwitterOAuth(
        $twitterAppDetails['consumerKey'], 
        $twitterAppDetails['consumerSecret'], 
        $twitterAppDetails['accessToken'], 
        $twitterAppDetails['accessTokenSecret']
    );

$tweets = $connection->get('statuses/user_timeline', ['count' => 200]);


foreach($tweets as $tweet) {

    if (strtotime($tweet->created_at) > strtotime('-1 hour')) {
        
        if($tweet->in_reply_to_user_id == null) {

            $tweetToTootConvertor = new TweetToTootConvertor($tweet->text);
            
            echo $tweetToTootConvertor->getToot();
            echo PHP_EOL;
        }

    }
}

echo PHP_EOL;
echo PHP_EOL;
*/



echo PHP_EOL;

echo 'Mastodon Domain: ';
$mastondonAppDetails['domain'] = trim(fgets(STDIN));

$mastodon = new Mastodon($mastondonAppDetails['domain']);
$tokenInfo = $mastodon->createApp("TwitterToMastodonSync", "http://example.com/");
$authUrl = $mastodon->getAuthUrl();

echo PHP_EOL;
echo PHP_EOL;
echo 'Authorise the applicaton at the following URL and copy the authorization token it gives you.';
echo PHP_EOL;
echo PHP_EOL;
echo $authUrl;
echo PHP_EOL;
echo PHP_EOL;

echo 'Mastodon Authorization Token: ';
$mastondonAppDetails['authorizationToken'] = trim(fgets(STDIN));

$tokenInfo = $mastodon->getAccessToken($mastondonAppDetails['authorizationToken']);

var_dump($tokenInfo);