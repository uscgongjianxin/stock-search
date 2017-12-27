<?php
  // echo "hello world";
  header("Access-Control-Allow-Origin: *");
  date_default_timezone_set("America/New_York");
  
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // get autocomplete JSON data
    if(isset($_GET["markit"])){
      $markitData  = file_get_contents('http://dev.markitondemand.com/MODApis/Api/v2/Lookup/json?input='.$_GET["markit"]);
      echo($markitData);
    }
    
    // get price & volume data
    if(isset($_GET["price"])){
      $priceData = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='.$_GET["price"].'&outputsize=full&apikey=2G9LGGA6W80CHBQ0');
      echo($priceData);
    }

    //get SMA data
    if(isset($_GET["sma"])){
      $smaData = file_get_contents('https://www.alphavantage.co/query?function=SMA&symbol=' . $_GET["sma"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($smaData);
    }

    //get EMA data
    if(isset($_GET["ema"])){
      $emaData = file_get_contents('https://www.alphavantage.co/query?function=EMA&symbol=' . $_GET["ema"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($emaData);
    }

    //get STOCH data
    if(isset($_GET["stoch"])){
      $stochData = file_get_contents('https://www.alphavantage.co/query?function=STOCH&symbol=' . $_GET["stoch"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($stochData);
    }

    //get RSI data
    if(isset($_GET["rsi"])){
      $rsiData = file_get_contents('https://www.alphavantage.co/query?function=RSI&symbol=' . $_GET["rsi"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($rsiData);
    }

    //get ADX data
    if(isset($_GET["adx"])){
      $adxData = file_get_contents('https://www.alphavantage.co/query?function=ADX&symbol=' . $_GET["adx"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($adxData);
    }

    //get CCI data
    if(isset($_GET["cci"])){
      $cciData = file_get_contents('https://www.alphavantage.co/query?function=CCI&symbol=' . $_GET["cci"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($cciData);
    }

    //get BBANDS data
    if(isset($_GET["bbands"])){
      $bbandsData = file_get_contents('https://www.alphavantage.co/query?function=BBANDS&symbol=' . $_GET["bbands"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($bbandsData);
    }

    //get MACD data
    if(isset($_GET["macd"])){
      $macdData = file_get_contents('https://www.alphavantage.co/query?function=MACD&symbol=' . $_GET["macd"] . '&interval=daily&time_period=10&series_type=open&apikey=2G9LGGA6W80CHBQ0');
      echo($macdData);
    }

    //get news data
    if(isset($_GET["news"])){
      $xmlurl = "https://seekingalpha.com/api/sa/combined/" . $_GET["news"] . ".xml";
      $xml=simplexml_load_file($xmlurl) or die("Error: Cannot create object");
      $channel = $xml->channel;
      $titleArr = array();
      $linkArr = array();
      $pubDateArr = array();
      $authorArr = array();
      $i = 0;
      $j = 0;
      while($j < 5){
        $thislink = $channel->item[$i]->link;
        $pos = strpos($thislink, "article");
        if($pos !== false){
          array_push($titleArr,$channel->item[$i]->title);
          array_push($linkArr,$channel->item[$i]->link);
          array_push($pubDateArr,$channel->item[$i]->pubDate);
          array_push($authorArr,$channel->item[$i]->children('sa', true)->author_name);
          $j++;
        }
        $i++;
      }
      // create a json array
      $myArray = array($titleArr, $linkArr, $authorArr, $pubDateArr);
      $myJSON = json_encode($myArray);
      echo($myJSON);
    }
  } 
?>
