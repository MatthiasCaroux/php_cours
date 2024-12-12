<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <?php
    require_once("Question.php");
    $json = file_get_contents("model.json");
    $questions = json_decode($json, true);

    for ($i = 0; $i < count($questions); $i++) {
        $question = new Question($questions[$i]["label"], $questions[$i]["choices"], $questions[$i]["correct"]);
        echo $question->getQuestion() . "<br>";
        echo implode(", ", $question->getChoices()) . "<br><br>";
    }

    ?>
</body>
</html>