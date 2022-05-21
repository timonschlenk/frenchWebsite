<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $file = explode(",", file_get_contents("storage.bin"));
                if (isset($_POST['question1'])) {
                    $question1 = (int)($_POST['question1']);
                    echo($question1);
                    $file[$question1] = (int)$file[$question1] + 1;
                }
                $output = "";
                for ($i=0; $i < 4; $i++) {
                    $output = $output . strval($file[$i]);
                    if ($i < 3){
                        $output = $output . ",";
                    }
                }

                file_put_contents("storage.bin", $output);
            }
        ?>

        <div id="bruh">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <fieldset>
                    <legend>What is 0 devided by 0?</legend>
                    <input type="radio" name="question1" class="checkbox" value="0"><label for="Infinity">Infinity</label><br>
                    <input type="radio" name="question1" class="checkbox" value="1"><label for="Zero">Zero</label><br>
                    <input type="radio" name="question1" class="checkbox" value="2"><label for="One">One</label><br>
                    <input type="radio" name="question1" class="checkbox" value="3"><label for="NotDefined">Not Defined</label><br>
                </fieldset>
                <input type="submit" value="SUBMIT">
            </form>
            <h1 id="counter"><?php
                echo(file_get_contents("storage.bin"));
            ?></h1>
        </div>
        <script src="script.js"></script>
    </body>

</html>