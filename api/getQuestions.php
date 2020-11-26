<?php
    require '../db_config.php';

    $qr_id = $_GET["qr"];

    $sql = "SELECT DISTINCT qr.title AS heading, qr.name, t.description AS title, t.title_id AS titleid, ty.qname AS qtype
    FROM questionnaire AS qr 
    JOIN question AS q ON q.qr_id = qr.qr_id = '".$qr_id."'
    JOIN title AS t ON q.title_id = t.title_id 
    JOIN qtype AS ty ON q.type_id = ty.t_id
    ORDER BY t.description ASC";

    try
    {
        $questionsRes = $pdo->prepare($sql);
        $questionsRes->execute();
    }
        catch (PDOException $e)
    {
        die();
    }

    $json_response = array();

    $data['totalNumOfQstns'] = 0;
 
    while (is_array($questionsRow = $questionsRes->fetch(PDO::FETCH_ASSOC))){
        $data['heading'] = $questionsRow['heading'];
        $data['name'] = $questionsRow['name'];
        

        $qstnsQuery = "SELECT q.description, ty.qname AS qtype
        FROM question AS q
        JOIN qtype AS ty ON q.type_id = ty.t_id
        WHERE q.title_id = '".$questionsRow['titleid']."'";

        try
        {
            $questionRes = $pdo->prepare($qstnsQuery);
            $questionRes->execute();
        }
            catch (PDOException $e)
        {
            die();
        }
        $questionsArray = array();
        while (is_array($questionRow = $questionRes->fetch(PDO::FETCH_ASSOC))){
            array_push($questionsArray, array(
                'type' => $questionRow['qtype'],
                'item' => $questionRow['description'])
            );
            $data['totalNumOfQstns']++;
        }
        $data['details'][] = array(
            'title' => $questionsRow['title'],
            'questions' => $questionsArray
        );

    }

    /* Create the JSON string. */
    $json = json_encode($data, JSON_PRETTY_PRINT);

    /* Set the JSON content-type. */
    header('Content-Type: application/json');

    /* Return the JSON string. */
    echo $json;
?>