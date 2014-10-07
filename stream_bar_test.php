<html>

        <head>
                <title>Streamlist</title>
        </head>
        <body>
                <?php
					 $streamList = array("beyondthesummit", "maegis");
					 $userGrab = "http://api.justin.tv/api/stream/list.json?channel=";
					 $checkedOnline = array();
					 
					 foreach($streamList as $singleStream){
                                                        $userGrab .= ",";
                                                        $userGrab .= $singleStream;
                                        }
										
					$json_file = file_get_contents($userGrab);
                                        $json_array = json_decode($json_file, true);
										
					foreach($streamList as $i => $singleStream){
                                                        if(isset($json_array[$i]))
                                                        {
                                                                $title = $json_array[$i]['channel']['channel_url'];
                                                                $array = explode('/', $title);
                                                                $online = end($array);
                                                                $viewers = $json_array[$i]['stream_count'];                    
                                                                if(checkOnline($online, $viewers))
                                                                {
                                                                        $checkedOnline[] = $online;
                                                                }      
                                                        }
                                                                                                               
                                        }
										
					function checkOnline($online, $viewers)
                                        {  
                                                        if ($online != null)
                                                        {
                                                                        echo '<a href="http://www.twitch.tv/'.$online.'"> <strong>'.$online.'</strong></a>';
                                                                        echo '&nbsp <img src="images/online.png"><strong> Status:</strong> Online! </br>';
                                                                        echo '<img src="images/viewers.png"><strong>Viewers:</strong> &nbsp' .$viewers.'</br>';
                                                                        return true;
                                                        }
                                        }              
                ?>
                <hr>
                <?php
					 foreach ($streamList as $i => $singleStream)
                                        {
                                                        if(in_array($singleStream, $checkedOnline))
                                                        {
                                                                        unset($streamList[$i]);
                                                        }                                      
                                        } 
                                        foreach ($streamList as $i => $singleStream) {
                                                        echo '<a href="http://www.twitch.tv/'.$singleStream.'"> <strong>'.$singleStream.'</strong></a>';
                                                        echo '&nbsp<img src="images/offline.png"> <strong> Status :</strong> Offline! </br>';
                                        }
                ?>
        </body>
</html>