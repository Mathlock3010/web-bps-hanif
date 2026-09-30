<?php
include 'dbconn.php';
try {
    $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : "";
    
    $sql = "SELECT judul FROM publikasi WHERE judul LIKE :keyword";
    $stmtQuery = $pdo->prepare($sql);
    $stmtQuery->execute(['keyword' => '%' . $keyword . '%']);
    $stmt = $stmtQuery->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    if ($stmt) {
        echo json_encode($stmt);
    } else {
        $response[] = array(
            'judul' => 'no suggestion'
        );
        echo json_encode($response);
    }
    
    $pdo = NULL;
}
catch (PDOException $e) {
    exit("PDO Error: ".$e->getMessage()."<br>");
}
?>