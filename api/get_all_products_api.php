<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

//Get all the products that are in the system
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

if ($result == true) {
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode($conn->error);
}

$conn->close();