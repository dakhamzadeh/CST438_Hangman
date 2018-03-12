<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CST438 Assignment 1: Hangman</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css"></link>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<?php
include 'config.php';
include 'functions.php';
?>
<body>
    <center>
        <div class="page-header">
            <h1>CST 438: Assignment 1</h1>
            <h2>Hangman</h2>
        </div>

        <div class="container-fluid">
            <?php
            if (isset($_POST['newGame']))
                unset($_SESSION['secretWord']);
            if (!isset($_SESSION['secretWord'])) {
                $_SESSION['state'] = 0;
                echo '<img src="img/hangmanStart.png">';
                $secretWord = openTxtFile($WORDLISTFILE);
                $_SESSION['secretWord'] = $secretWord;
                $_SESSION['hidden'] = changeLetterToUnderscore($secretWord);
                echo 'STATE: ' . ($MAX_STATE -
                $_SESSION['state'] + 1);
            } else {
                if (isset($_POST['userGuess'])) {
                    $userGuess = $_POST['userGuess'];
                    $_SESSION['hidden'] = replaceLetter(strtoupper($userGuess), $_SESSION['hidden'], $_SESSION['secretWord']);
                    endGame($MAX_STATE, $_SESSION['state'], $_SESSION['secretWord'], $_SESSION['hidden']);
                }
                $_SESSION['state'] = $_SESSION['state'] + 1;
                $imgNo = intval($_SESSION['state']);
                echo "<img src='img/img$imgNo.png'>";
              
                echo '<tr><td align="center"></br> remaining lives: ' . ($MAX_STATE -
                $_SESSION['state'] + 1) . "</br></td></tr>";
            }
            $hidden = $_SESSION['hidden'];
            foreach ($hidden as $char)
                echo $char . "  ";
            ?>
            <script ty pe="application/javascript">
                function inputValidation()
                {
                var x=document.forms["inputForm"]["userGuess"].value;

                if (!/[a-zA-Z]/.test(x)) {
                alert("Invalid entry. Enter a valid character(A-Z/a-z).");
                return false;
                }

                }
            </script>
            <form name = "inputForm" action = "" method = "post">
                <tr><td align="center">Your Guess: <input name = "userGuess"
                                                          type = "text" size="1" maxlength="1"  /></td></tr>
                <tr><td align="center"><input type = "submit"  value = "Check"
                                              onclick="return inputValidation()"/></td></tr>
                <tr><td align="center"><input type = "submit" name = "newGame"
                                              value = "Try another Word"/></td></tr>
            </form>


        </div>

</body>
</html>
