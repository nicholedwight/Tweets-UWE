<!DOCTYPE html>
<html>
  <head>
    <title>Tweets@UWE</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <header class="title">
      <h1>Tweets@UWE</h1>
      <p>By Nichole Dwight</p>
    </header>
        <?php
        //Based on code by James Mallison, see https://github.com/J7mbo/twitter-api-php
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');

        // header('Content-Type: text/html; charset="UTF-8"');

        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => "1658174634-C6uoYZsW7kbPEqHohj039CRMjVvgZKGrWJGgfYs",
            'oauth_access_token_secret' => "qfjAOsaUdTKk3lJIbnkntNe4fpnQdampC6hs2SqZESBVR",
            'consumer_key' => "cUoJtlCdfGW4rMDpnORVz6Mfu",
            'consumer_secret' => "RbNDMvbH16pRRyL2a1Q1kia5ZqegwajY3p0fsbGUYH4CoVzZnu"
        );

        /** Perform a GET request and echo the response **/
        /** Note: Set the GET field BEFORE calling buildOauth(); **/
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield = '?q=&geocode=51.502,-2.545,2km';
        // $getfield = '?q=&geocode=34.097497,-84.517725,2km';
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $data=$twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();

        //Use this to look at the raw JSON
        // echo($data);

        // Read the JSON into a PHP object
        $phpdata = json_decode($data, true);

        // Debug - check the PHP object
        ?>
        <pre>
          <?php
          // var_dump($phpdata["statuses"]);
          ?>
        </pre>
      <main role="main" class="content_wrapper">
        <?php
        //Loop through the status updates and print out the text of each
        foreach ($phpdata["statuses"] as $status){
          $screen_name = "@" . $status["user"]["screen_name"];
          $name = $status["user"]["name"];
          $tweet = $status["text"];
          $profileimage = $status["user"]["profile_image_url"];
        ?>
        <div class="tweet_box">
          <div class="inner">
            <p>
              <a href="http://www.twitter.com/<?php echo $name; ?>" target="_blank">
                <img src="<?php echo $profileimage; ?>" alt="<?php echo $name; ?>'s Profile Image">
                <?php echo $name; ?>
                <span class="sub"><?php echo $screen_name;?></span>
              </a>
            </p>
            <p class="tweet"> <?php echo $tweet;?> </p>
          </div>
        </div>
        <?php
        }
        ?>
      </main>
  </body>
</html>
