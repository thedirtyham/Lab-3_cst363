<?php

    function displayRandomCard(&$array,&$deck)
    {
        $suits = array("clubs", "diamonds", "spades", "hearts");
    
        $randSuite = rand(0,3); //random 
        $randIndex = rand(1,13); 
        
        $randNumber = ($randSuite * 13) + $randIndex; // card value in deck
        
      
        while (sequentialSearch($array,$randNumber) || sequentialSearch($deck,$randNumber))
        {
            $randSuite = rand(0,3);
            $randIndex = rand(1,13);
            $randNumber = ($randSuite * 13) + $randIndex;
        }
        
        //creates the image with the card value
        echo "<img src='img/cards/$suits[$randSuite]/" . $randIndex. ".png' />";
        $array[] = $randNumber;
        $deck[] = $randNumber;
    }
    
    
     function getPlayerByRamdomIndex(&$hasBeenDisplayed,&$index){
        global $MarioCards,$LuigiCards,$YoshiCards,$PeachCards;
        $players = array($MarioCards,$LuigiCards,$YoshiCards,$PeachCards);
        $randIndex = rand(0,3);
        while (sequentialSearch($hasBeenDisplayed,$randIndex))
        {
            $randIndex = rand(0,3);
        }
        $hasBeenDisplayed[] = $randIndex;
        $index = $randIndex;
        return $players[$randIndex];
    }
    
    function sequentialSearch($array,$element)
    {
        for ($i = 0; $i < count($array);$i++)
        {
            if ($array[$i] == $element)
            {
                return true;
            }
        }
        
        return false;
    }
    
    function getCardValue($card)
    {
    
        // Jack
        if ($card % 13 == 11)
        {
            return 11;
        }
        //Queen
        else if ($card % 13 == 12)
        {
            return 12;
        }
        //King
        else if ($card % 13 == 0 && $card != 0)
        {
            return 13;
        }
        //Other
        else
        {
            return $card % 13;
        }
    
    }
    
    
    
    function getWinningSum($winner,$score1, $score2,$score3,$score4)
    {
        if ($winner[0] == "All Loose !")
        {
            $sums = array();
            $sums[] = 0;
            return $sums;
        }
        else
        {
            $scores = array();
            $scores[] = $score1;
            $scores[] = $score2;
            $scores[] = $score3;
            $scores[] = $score4;
            $players = array("Mario","Luigi","Yoshi","Peach");
            $sums = array();
            
            for ($i = 0; $i < count($winner);$i++)
            {
                for ($j = 0; $j < count($scores);$j++)
                {
                    if ($winner[$i] != $players[$j])
                    {
                        $sums[$i] += $scores[$j];
                    }
                }
            }
            
            return $sums;
        }
    }


    function deckSum($array)
    {
        
        if (count($array) < 1)
        {
            return 0;
        }
        else
        {
            $sum = 0;
            
            for ($i = 0; $i < count($array);$i++)
            {
                $sum += getCardValue($array[$i]);
            }
            
        return $sum;
        }
    }
    
    function getHighScore($score1, $score2,$score3,$score4)
    {
        $scores = array();
        $scores[] = $score1;
        $scores[] = $score2;
        $scores[] = $score3;
        $scores[] = $score4;
        $players = array("Mario","Luigi","Yoshi","Peach");
        $high_score = 0;
        $allBusted = true;
        for ($i = 0; $i < count($scores);$i++)
        {
            if ($scores[$i] <= 42)
            {
                $allBusted = false;
            }
        }
        
        if ($allBusted)
        {
            return -1;
        }
        else{

            for ($i = 0; $i < count($scores);$i++)
            {
                if (($scores[$i] > $high_score) && ($scores[$i] <= 42))
                {
                    $high_score = $scores[$i];
                }
            }
            
            return $high_score;
        }
    }

    function getWinners($score1, $score2,$score3,$score4,&$winners)
    {
        
        $high_score = getHighScore($score1, $score2,$score3,$score4);
        if ($high_score == -1)
        {
            $winners[] = "All loose !";
        }
        else
        {
            $players = array("Mario","Luigi","Yoshi","Peach");
            $scores = array();
            
            $scores[] = $score1;
            $scores[] = $score2;
            $scores[] = $score3;
            $scores[] = $score4;
            
            for ($i = 0; $i < count($players);$i++)
            {
                if ($scores[$i] ==$high_score)
                {
                    $winners[] = $players[$i];
                }
            }
            
        }
    }
    
function playAgain()
{  
    if (isset($_GET['submitForm'])) 
    {
        return " https://cst336-spring2017-alex2808.c9users.io/Labs/Lab%203%20:%20PHP%20Arrays/Lab3.php;";
       
    }
 
}


  
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="lab3.css" type="text/css" />
    </head>
    <body>
        <?php
        $deck = array();
        $players = array("Mario","Luigi","Yoshi","Peach");
        $scores = array();
        $MarioCards = array();
        $LuigiCards = array();
        $YoshiCards = array();
        $PeachCards = array();



        //Images Players 
        $MarioCards[0] = "Players/Mario.png";
        $LuigiCards[0] = "Players/Luigi.png";
        $YoshiCards[0] = "Players/Yoshi.png";
        $PeachCards[0] = "Players/Peach.png";
        echo "<main>";
        echo "<h1> Silver Jack Super Mario </h1>";
        for ($j = 0; $j < 4;$j++)
        {
            echo "<table>";
            $tempIndex = 0;
            $tempArr = getPlayerByRamdomIndex($hasBeenDisplayed,$tempIndex);
            echo "<tr><td> <img src='img/$tempArr[0]'/>";
            $scores[$tempIndex] = 0;
            
            for ($i = 0; deckSum($tempArr) < 42 ;$i++)
            {
                if ( $i== 6)
                {
                   
                    break;
                }
                displayRandomCard($tempArr,$deck);
                $scores[$tempIndex] = deckSum($tempArr);
              
            }
            
            echo "<text>".$players[$tempIndex] . "  " . $scores[$tempIndex]. "</text>";
            echo "<br/>";
            $tempIndex = 0;
            echo "</tr></td>";
            echo "</table>";
            
        }   

        $winners = array();
        getWinners($scores[0],$scores[1],$scores[2],$scores[3],$winners);
        echo "<h2 id=winner style=color:#290a6b;>$winners[0] Wins! ";
        echo "<br/>";
        ?>
        
        <form method="GET">
         <input type="submit" name="submitForm" value="Play Again"/>
        </form>
    </body>
</html>