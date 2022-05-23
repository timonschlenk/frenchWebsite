<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <?php
            $percentages = getStatistics(getFile());
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if( !ipAdressExists($_SERVER['REMOTE_ADDR']) ){
                    $file = getFile();

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
                
                if(isset($_POST['question8'])){
                    if($_POST['question8']==file_get_contents("password")){
                        resetDocuments();
                    }
                }
                $percentages = getStatistics(getFile());

            }

            function getStatistics($mfile){
                $returnPercentages = array("50%","50%","50%","50%");
                if (($mfile[0][0]+$mfile[0][1]+$mfile[0][2]+$mfile[0][3]) > 0){
                    $returnPercentages[0] = strval( $mfile[0][3] / ($mfile[0][0]+$mfile[0][1]+$mfile[0][2]+$mfile[0][3]) * 100) . "%";
                }
                if (($mfile[1][0]+$mfile[1][1]+$mfile[1][2]+$mfile[1][3]) > 0){
                    $returnPercentages[1] = strval( ($mfile[1][0]+$mfile[1][1]) / ($mfile[1][0]+$mfile[1][1]+$mfile[1][2]+$mfile[1][3]) * 100) . "%";
                }
                if (($mfile[2][0]+$mfile[2][1]+$mfile[2][2]+$mfile[2][3]) > 0){
                    $returnPercentages[2] = strval( $mfile[2][0] / ($mfile[2][0]+$mfile[2][1]+$mfile[2][2]+$mfile[2][3]) * 100) . "%";
                }
                if (($mfile[3][0]+$mfile[3][1]) > 0){
                    $returnPercentages[3] = strval( $mfile[3][0] / ($mfile[3][0]+$mfile[3][1]) * 100) . "%";
                }
                return $returnPercentages;
            }

            function getFile(){
                $returnFile = explode("|", file_get_contents("statistics.bin"));
                for($i=0; $i < count($returnFile); $i++){
                    $returnFile[$i] = explode(",", $returnFile[$i]);
                }
                return $returnFile;
            }

            function ipAdressExists($adress){
                $adresses = json_decode(file_get_contents("ipadresses.bin"));
                if($adresses === null){
                    $adresses[0] = strval($adress);
                    file_put_contents("ipadresses.bin", json_encode($adresses));
                    return false;
                } else if (in_array(strval($adress), $adresses)){
                    return true;
                } else {
                    array_push(strval("," . $adress));
                    file_put_contents("ipadresses.bin", json_encode($adresses));
                    return false;
                }
            }

            function resetDocuments(){
                file_put_contents("ipadresses.bin", "");
                file_put_contents("statistics.bin", "0,0,0,0|0,0,0,0|0,0,0,0|0,0");
            }
        ?>

        <div class = "box-div">
            <h1 id="title">Fun Math Quiz</h1> 
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  onkeydown="return event.key != 'Enter';">
                <fieldset class = "question">
                    <legend>What is 0 devided by 0?</legend>
                    <div><input type="radio" name="question1" class="checkbox" value="0" checked="checked"><label>Infinity</label></div>
                    <div><input type="radio" name="question1" class="checkbox" value="1"><label>Zero</label></div>
                    <div><input type="radio" name="question1" class="checkbox" value="2"><label>One</label></div>
                    <div><input type="radio" name="question1" class="checkbox" value="3"><label>Not Defined</label></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>What is 2 devided by 3?</legend>
                    <div><input type="radio" name="question2" class="checkbox" value="0" checked="checked"><label>2/3</label></div>
                    <div><input type="radio" name="question2" class="checkbox" value="1"><label">0.66666...</label></div>
                    <div><input type="radio" name="question2" class="checkbox" value="2"><label>Not defined</label></div>
                    <div><input type="radio" name="question2" class="checkbox" value="3"><label>3/2</label></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>What is 0 factorial?</legend>
                    <div><input type="radio" name="question3" class="checkbox" value="0" checked="checked"><label>One</label></div>
                    <div><input type="radio" name="question3" class="checkbox" value="1"><label>Zero</label></div>
                    <div><input type="radio" name="question3" class="checkbox" value="2"><label>Minus one</label></div>
                    <div><input type="radio" name="question3" class="checkbox" value="3"><label>Not Defined</label></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Explain Question 1:</legend>
                    <div><input type="textarea" name="question4" class="textbox"></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Explain Question 2:</legend>
                    <div><input type="textarea" name="question5" class="textbox"></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Explain Question 3:</legend>
                    <div><input type="textarea" name="question6" class="textbox"></div>
                </fieldset>
                <fieldset class = "question">
                    <legend>Did you like this Math Quiz (Explain your answer)?</legend>
                    <div id="divYN"><input type="radio" name="question7" class="yesNo" value="0" style="accent-color:#FD9800" checked="checked"><label>Yes</label>
                         <input type="radio" name="question7" class="yesNo" value="1" style="accent-color:#0000ff"><label>No</label></div>
                    <div><input type="textarea" name="question8" class="textbox"></div>
                </fieldset>
                <input type="submit" value="SUBMIT" id="submit">
            </form>
            <div id= "statistics">
                <figure class="pie-chart" style="background:
                    radial-gradient(
                        circle closest-side,
                        white 0,
                        white 26.22%,
                        transparent 26.22%,
                        transparent 46%,
                        white 0
                    ),
                    conic-gradient(
                        #00ff00 0,
                        #00ff00 <?php echo($percentages[0]) ?>,
                        #ff0000 0,
                        #ff0000 100%
                    );">
                    <h2>Question 1</h2>
                </figure>
                <figure class="pie-chart" style="background:
                    radial-gradient(
                        circle closest-side,
                        white 0,
                        white 26.22%,
                        transparent 26.22%,
                        transparent 46%,
                        white 0
                    ),
                    conic-gradient(
                        #00ff00 0,
                        #00ff00 <?php echo($percentages[1]) ?>,
                        #ff0000 0,
                        #ff0000 100%
                    );">
                    <h2>Question 2</h2>
                </figure>
                <figure class="pie-chart" style="background:
                    radial-gradient(
                        circle closest-side,
                        white 0,
                        white 26.22%,
                        transparent 26.22%,
                        transparent 46%,
                        white 0
                    ),
                    conic-gradient(
                        #00ff00 0,
                        #00ff00 <?php echo($percentages[2]) ?>,
                        #ff0000 0,
                        #ff0000 100%
                    );">
                    <h2>Question 3</h2>
                </figure>
                <figure class="pie-chart" style="background:
                    radial-gradient(
                        circle closest-side,
                        white 0,
                        white 26.22%,
                        transparent 26.22%,
                        transparent 46%,
                        white 0
                    ),
                    conic-gradient(
                        #FD9800 0,
                        #FD9800 <?php echo($percentages[3]) ?>,
                        #0000ff 0,
                        #0000ff 100%
                    );">
                    <h2>Question 7</h2>
                </figure> 
            </div>
        </div>
        <script src="script.js"></script>
    </body>

</html>