
<?php
$maxScore = 42;
$ammountOfCards;
$numOfPlayers;
$score = 0;
$playerWinner;
$playerScores = array();
$hearts = array($src);
$spades = array();
$dimonds = array();
$clubs = array();

for ($i = 1; $i <= 13; $i++){
    $hearts["cards/hearts/$i.png"] = "$i";
    $spades["cards/spades/$i.png"] = "$i";
    $dimonds["cards/diamonds/$i.png"] = "$i";
    $clubs["cards/clubs/$i.png"] = "$i";
    /*
    $src = $hearts[$i-1];
    echo "<img src = '$src' /> <br />";
    */
}   
$orderedDeck = array_merge($hearts, $spades, $dimonds, $clubs);
  $shuffledDeck =  shuffle_assoc($orderedDeck);
  $ammountOfCards = getRandom();
  $numOfPlayers = 4;
  $i = 0;
  $j = 0;
   foreach($shuffledDeck as $x => $x_values) 
   if($j < $numOfPlayers){
     if($i <= $ammountOfCards ){
          $i++;
           if ($x_values < 1) continue;
            $src = $x;
            $score += $x_values;
            $playerScores[$j] = $score;
            echo "<img src = '$src' />";
            //echo $x_values;
   } else{
       echo "score: $score"; 
       echo "<br>";
       $ammountOfCards = getRandom();
       $i = 0;
       $score = 0;
       $j++;
   }};
   
   for ($i = 0; $i <= count($playerScores); $i++) {
        echo $playerScores[$i] .  " ";
   }
   $playerWinners = winner($playerScores);
   for ($i = 0; $i <= count($playerWinners); $i++) {
       //echo "Winner/s " . $playerWinners[$i];
   }
   /*
for ($i = 1; $i <= 54; $i++){
    $src = $suffledDeck[$i - 1];
    echo "<img src = '$src' />";
}*/

//$numOfEmelents = count($orderedDeck);
//echo "$numOfEmelents";

//$suffledDeck = resetDeck($orderedDeck, $suffledDeck);
//for ($i = 1; $i <= 52; $i++){
 //   $src = $suffledDeck[$i-1];
   // echo "<img src = '$src' /> <br />";
//}

function getRandom(){
    return rand(4, 6);
}
function shuffle_assoc($list) { 
  if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) { 
    $random[$key] = $list[$key]; 
  }
  return $random; 
} 

function resetDeck($orginal, $array){
    $array = $orginal;
    return $array;
}
function pc_array_shuffle($array) {
    $i = count($array);

    while(--$i) {
        $j = mt_rand(0, $i);

        if ($i != $j) {
            // swap elements
            $tmp = $array[$j];
            $array[$j] = $array[$i];
            $array[$i] = $tmp;
        }
    }

    return $array;
}

function deal($deck){
    
}

function winner($playerScore){
    $winner = array();
    $maxScore = 42;
    for($i = 0; $i < count($playerScore); $i++){
        
        if($playerScore[$i] < $maxScore)
        {
           echo "winners: " . $winner[$i];
            $winner[0] = $playerScore[$i];
            if($playScore[$i] == $winner)
            $winner[1] = $playerScore[$i];
            if($playerScore[$i] > $winner){
                $winner = $playerScore[$i];
            }
        } 
    }
        return $winner;
}

?>
