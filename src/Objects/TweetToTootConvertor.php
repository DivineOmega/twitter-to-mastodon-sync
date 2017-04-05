<?php
namespace DivineOmega\TwitterToMastodonSync\Objects;

class TweetToTootConvertor
{
    private $tweetText = null;

    public function __construct($tweetText)
    {
        $this->tweetText = $tweetText;
    }

    public function getTweet()
    {
        return $this->tweetText;
    }

    public function getToot()
    {
        return $this->convert();
    }

    private function convert()
    {
        $text = $this->tweetText;

        $text = ' '.$text.' ';
        $text = str_replace(' @', ' https://twitter.com/', $text);
        $text = str_replace('.@', 'https://twitter.com/', $text);
        $text = trim($text);

        return $text;
    }
}