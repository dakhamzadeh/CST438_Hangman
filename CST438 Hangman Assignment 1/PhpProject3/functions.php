<?php



// Opens the hangman txt file 
// and access the words 
    function openTxtFile($wordFile)
    {
        $txtFile = fopen($wordFile,'r');
           if ($txtFile)
        {
            $line = null;
            $count = 0;
            $random_word = null;
            
            while (($line = fgets($txtFile)) !== false)
            {
                $count++;
                if(rand() % $count == 0)
                {
                      $random_word = trim($line);
                }
        }
        if (!feof($txtFile))
        {
            fclose($txtFile);
            return null;
        }else
        {
            fclose($txtFile);
        }
    }
        $word = str_split($random_word);
        return $word;
    }

    // changes all the letters of the word
    // to underscores
    function changeLetterToUnderscore($word)
    {
        $wordLen = floor((sizeof($word)/2) + 1);
        $count = 0;
        $hidden = $word;
        while ($count < $wordLen )
        {
            $rand_element = rand(0,sizeof($word)-2);
            if( $hidden[$rand_element] != '_' )
            {
                $hidden = str_replace($hidden[$rand_element],'_',
                  $hidden,$replace_count);
                $count = $count + $replace_count;
            }
        }
        return $hidden;
    }

    function replaceLetter($userInput, $hidden, $answer)
    {
        $i = 0;
        $incorrect = true;
        while($i < count($answer))
        {
            if ($answer[$i] == $userInput)
            {
                $hidden[$i] = $userInput;
                $incorrect = false;
            }
            $i = $i + 1;
        }
        if (!$incorrect) $_SESSION['attempts'] = $_SESSION['attempts'] - 1;
        return $hidden;
    }



// End game if 
    function endGame($MAX_STATE,$userState, $userGuess, $secretWord)
    {
        if ( $userGuess == $secretWord)
            {
                echo 'Great Job! You won!</br> You guessed correctly: </br>';
                foreach ($userGuess as $letter) echo $letter;
                echo '<form action = "" method = "post">';
                echo '<input type = "submit"';
                echo 'name = "newGame" value = "Start another game"/>';
                echo '</form><';
                die();
            }
        if ($userState >= $MAX_STATE)
            {
              echo 'Your lost! Game Over :(</br> The correct word is: </br>';
              foreach ($userGuess as $letter) echo $letter;
              echo '<form action = "" method = "post">';
              echo '<input type = "submit"';
              echo 'name = "newGame" value = "Try another Word"/>';
              echo '</form>';
                die();
            }
            
    }
?>
