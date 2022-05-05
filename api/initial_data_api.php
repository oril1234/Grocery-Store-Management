<?php
$users = [
    "donaldtrump@gmail.com11111",
    "billclinton@gmail.com22222",
    "georgebush@gmail.com33333",
    "johnkennedy@gmail.com44444",
    "barakobama@gmail.com55555",
    "ronaldreigen@gmail.com66666"];
/*
$products = [
"Asparagus",
"Apples",
"Almonds",
"beer",
"bread",
"broccoli",
"Bamba",
"Bisli",
"banana",
"cheese",
"cake",
"carrot",
"Chicken 1 kg",
"coffie",
"cookies",
"corn",
"cereal",
"cucumber",
"dates",
"dumplings",
"donuts",
"Doritos",
"eggs",
"enchilada",
"eggrolls",
"fish",
"French toast",
"Garlic",
"ginger",
"granola",
"grapes",
"green beans",
"Guancamole",
"ham",
"halibut",
"honey",
"hot dogs",
"ce cream",
"Irish stew",
"Italian bread",
"jambalaya",
"jelly",
"kale",
"kabobs",
"ketchup",
"kiwi",
"lobster",
"Lamb",
"Linguine",
"Lasagna",
"Meatballs",
"Moose",
"Milk",
"Milkshake",
"Noodles",
"Pizza",
"Pepperoni",
"Pancakes",
"Pesek Zman",
"potato",
"Pringles onion",
"Quesadilla",
"Quiche",
"Toast",
"Tortit",
"Twix",
"Yogurt",
"Zucchini",
];
 */

$sql = "SELECT * FROM Products";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    $filename = "../products.json";
    $data = file_get_contents($filename);
    $products = json_decode($data, true);
    foreach ($products as $product) {
        $productName = $product["productName"];
        $path = $product["imgPath"];
        $conn->query("INSERT INTO Products(`Product Name`,`Image Path`) Values('$productName','$path')");
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    foreach ($users as $user) {
        $len = strlen($user);
        $mail = substr($user, 0, $len - 5);
        $password = substr($user, $len - 5, $len);
        $conn->query("INSERT INTO users Values('$mail','$password')");
    }
}

$sql = "SELECT * FROM familyHeads";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $conn->query("INSERT INTO `familyHeads` VALUES ('donaldtrump@gmail.com','Trump')");
    $conn->query("INSERT INTO `familyHeads` VALUES ('billclinton@gmail.com','Clinton')");

}

$sql = "SELECT * FROM familymembers";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $conn->query("INSERT INTO `familymembers`
    VALUES ('donaldtrump@gmail.com','donaldtrump@gmail.com',1,now())");
    $conn->query("INSERT INTO `familymembers`
    VALUES ('billclinton@gmail.com','billclinton@gmail.com',1,now())");
    $conn->query("INSERT INTO `familymembers`
    VALUES ('georgebush@gmail.com','donaldtrump@gmail.com',1,now())");
    $conn->query("INSERT INTO `familymembers`
    VALUES ('johnkennedy@gmail.com','donaldtrump@gmail.com',-1,now())");
    $conn->query("INSERT INTO `familymembers`
    VALUES ('barakobama@gmail.com','donaldtrump@gmail.com',-1,now())");
    $conn->query("INSERT INTO `familymembers`
    VALUES ('ronaldreigen@gmail.com','billclinton@gmail.com',1,now())");
}

$sql = "SELECT * FROM usersproducts";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,1,3,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,2,10,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,3,2,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,4,1,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,1,5,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,2,3,1,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,8,3,1,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,11,3,1,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,23,3,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,1,2,0,0)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,11,1,1,0)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,15,30,1,0)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',1,35,15,0,1)");
    $conn->query("INSERT INTO `usersproducts`
  VALUES ('donaldtrump@gmail.com',1,40,10,0,0)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('billclinton@gmail.com',1,3,2,1,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('billclinton@gmail.com',1,1,7,0,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('billclinton@gmail.com',1,4,9,1,0)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('billclinton@gmail.com',2,19,10,0,0)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,1,6,1,1)");
    $conn->query("INSERT INTO `usersproducts`
 VALUES ('donaldtrump@gmail.com',2,15,1,1,1)");
    $conn->query("INSERT INTO `usersproducts`
VALUES ('johnkennedy@gmail.com',1,4,9,1,0)");
    $conn->query("INSERT INTO `usersproducts`
VALUES ('johnkennedy@gmail.com',2,19,10,0,0)");
    $conn->query("INSERT INTO `usersproducts`
VALUES ('johnkennedy@gmail.com',2,1,6,1,1)");
    $conn->query("INSERT INTO `usersproducts`
VALUES ('johnkennedy@gmail.com',2,15,1,1,1)");
}