<?php
  require("lib/Yahoo.inc");
  
  // When you replaced with your own keys here and once run this should go to Yahoo login page else some thing went wrong in your app registration and keys

  // Your Consumer Key (API Key) goes here.
  define('CONSUMER_KEY', "dj0yJmk9UGpaMXcyc3NtMkRtJmQ9WVdrOWRWaExhMUJ2TmpJbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD1lMA--");

  // Your Consumer Secret goes here.
  define('CONSUMER_SECRET', "823bba857d8f8e3ee6ccf4ae3c6050f1cfd95849");

  // Your application ID goes here.
  define('APPID', "uXKkPo62");

  $session = YahooSession::requireSession(CONSUMER_KEY,CONSUMER_SECRET,APPID);
?>