<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dbName = "petek";

if (!mysqli_select_db($conn, $dbName)) { // בודק עם מסד הנתונים לא קיים כבר
    $sql = "CREATE DATABASE $dbName";
    if ($conn->query($sql) === true) {
        echo "Database created successfully";
    } else {
        die("Error creating database: " . $conn->error);
    }
}

$conn = new mysqli($servername, $username, $password, $dbName);

$sql = " SELECT * FROM users ";
if (!$conn->query($sql)) {
    $sql = "CREATE TABLE users(`email` VARCHAR(50) PRIMARY KEY,
`password` VARCHAR(50) NOT NULL);";
    if ($conn->query($sql) === true) {
        echo "Table users created successfully";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$sql = " SELECT * FROM cookies ";
if (!$conn->query($sql)) {
    $sql = "CREATE TABLE cookies(`ID` int(11) PRIMARY KEY,
`Email` VARCHAR(50) references users(`email`),
`Private Account` bit,
`Is Family Head` bit );";
    if ($conn->query($sql) === true) {
        echo "Table cookies created successfully";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$sql = " SELECT * FROM Products ";
if (!$conn->query($sql)) {
    $sql = "CREATE TABLE Products(`ID` int AUTO_INCREMENT PRIMARY KEY,
`Product Name` VARCHAR(50) not null,
`Image Path` varchar(50) not null );";
    if ($conn->query($sql) === true) {
        echo "Table Products created successfully";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$sql = " SELECT * FROM usersProducts ";
if (!$conn->query($sql)) {
    $sql = "CREATE TABLE usersProducts(`User Mail` VARCHAR(50),
`List Number` int,`Product ID` int, Ouantity int, State bit,`Private Account` bit not null,
PRIMARY KEY(`User Mail`,`List Number`,`Product ID`,`Private Account`),
FOREIGN KEY (`User Mail`) REFERENCES Users(email),
FOREIGN KEY (`Product ID`) REFERENCES Products(ID)

);";

    if ($conn->query($sql) === true) {
        echo "Table User Products created successfully";
    } else {
        die("Error creating table: " . $conn->error);
    }
}
$sql = " SELECT * FROM familyHeads";
if (!$conn->query($sql)) {
    $sql = "CREATE TABLE familyHeads(`Email` VARCHAR(50) PRIMARY KEY,
`Family Name` VARCHAR(50),
FOREIGN KEY (`Email`) REFERENCES users(`email`)

);";
    if ($conn->query($sql) === true) {
        echo "Table familyHeads; created successfully";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

$sql = " SELECT * FROM familyMembers";
if (!$conn->query($sql)) {
    $sql = "CREATE TABLE familyMembers(`Email` VARCHAR(50) PRIMARY KEY,
`Family Head` VARCHAR(50) references familyHeads(`Email`),
`State` int,
`Join Date` datetime,
FOREIGN KEY (`Email`) REFERENCES users(`email`),
FOREIGN KEY (`Family Head`) references familyHeads(`Email`),
CHECK (`State` in (-1,0,1))

);";
    if ($conn->query($sql) === true) {
        echo "Table familyMember; created successfully";
    } else {
        die("Error creating table: " . $conn->error);
    }
}

require_once "api/initial_data_api.php";