<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="mobile.css">
    </head>

    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $file = explode("|", file_get_contents("statistics.bin"));
                for($i=0; $i < count($file); $i++){
                    $file[$i] = explode(",", $file[$i]);
                }


                if (isset($_POST['question1'])) {
                    $question1 = (int)($_POST['question1']);
                    $file[0][$question1] = (int)$file[0][$question1] + 1;
                }
                if (isset($_POST['question2'])) {
                    $question1 = (int)($_POST['question2']);
                    $file[1][$question1] = (int)$file[1][$question1] + 1;
                }
                if (isset($_POST['question3'])) {
                    $question1 = (int)($_POST['question3']);
                    $file[2][$question1] = (int)$file[2][$question1] + 1;
                }
                if (isset($_POST['question7'])) {
                    $question1 = (int)($_POST['question7']);
                    $file[3][$question1] = (int)$file[3][$question1] + 1;
                }




                $output = "";
                for ($i=0; $i < 4; $i++) {
                    for ($j=0; $j < count($file[$i]); $j++) {
                        $output = $output . strval($file[$i][$j]);
                        if ($j < count($file[$i])-1){
                            $output = $output . ",";
                        }
                    }
                    if ($i < 3){
                        $output = $output . "|";
                    }
                }

                file_put_contents("statistics.bin", $output);
            }
        ?>

        <div class = "box-div">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <h1>Fun Math Quiz</h1>
                <fieldset class = "question">
                    <legend>What is 0 devided by 0?</legend>
                    <div><input type="radio" name="question1" class="checkbox" value="0"><label>Infinity</label></div>
                    <div><input type="radio" name="question1" class="checkbox" value="1"><label>Zero</label></div>
                    <div><input type="radio" name="question1" class="checkbox" value="2"><label>One</label></div>
                    <div><input type="radio" name="question1" class="checkbox" value="3"><label>Not Defined</label></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>What is 2 devided by 3?</legend>
                    <div><input type="radio" name="question2" class="checkbox" value="0"><label>2/3</label></div>
                    <div><input type="radio" name="question2" class="checkbox" value="1"><label">0.66666...</label></div>
                    <div><input type="radio" name="question2" class="checkbox" value="2"><label>Not defined</label></div>
                    <div><input type="radio" name="question2" class="checkbox" value="3"><label>3/2</label></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>What is 0 factorial?</legend>
                    <div><input type="radio" name="question3" class="checkbox" value="0"><label>One</label></div>
                    <div><input type="radio" name="question3" class="checkbox" value="1"><label>Zero</label></div>
                    <div><input type="radio" name="question3" class="checkbox" value="2"><label>Minus one</label></div>
                    <div><input type="radio" name="question3" class="checkbox" value="3"><label>Not Defined</label></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Explain Question 1:</legend>
                    <div><input type="text" name="question4" class="textbox"></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Explain Question 2:</legend>
                    <div><input type="text" name="question5" class="textbox"></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Explain Question 3:</legend>
                    <div><input type="text" name="question6" class="textbox"></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Did you like this Math Quiz (Explain your answer)?</legend>
                    <div><input type="radio" name="question7" class="yesNo" value="0"><label>Yes</label></div>
                    <div><input type="radio" name="question7" class="yesNo" value="1"><label>No</label></div>
                    <div><input type="text" name="question7.2" class="textbox"></div>
                </fieldset>
                <input type="submit" value="SUBMIT" id="submit">
            </form>
            <h1 id="counter"><?php
                echo(file_get_contents("statistics.bin"));
            ?></h1>
        </div>
        <script src="script.js"></script>
    </body>

</html>