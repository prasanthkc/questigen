<?php
    require '../db_config.php';

    $sql = "SELECT name FROM questionnaire";
    try
    {
        $questionnairesRes = $pdo->prepare($sql);
        $questionnairesRes->execute();
    }
        catch (PDOException $e)
    {
        die();
    }

    $data['Questionnaires'] = array();

    while (is_array($questionnairesRow = $questionnairesRes->fetch(PDO::FETCH_ASSOC))){
        $data['Questionnaires'][] = $questionnairesRow['name'];
    }

    /* Create the JSON string. */
    $json = json_encode($data, JSON_PRETTY_PRINT);

    /* Set the JSON content-type. */
    header('Content-Type: application/json');

    /* Return the JSON string. */
    echo $json;
?>