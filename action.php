<?php 

$connect = new PDO("mysql:host=localhost;dbname=crud", "root", "");
$recieved_data = json_decode(file_get_contents("php://input"));
$data = array();

if($recieved_data->action == "fetchall") {
    $query = "SELECT * FROM orders";
    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    
    echo json_encode($data);
}

if($recieved_data->action == "insert") {
    
    $data = array(
        ':date' => $recieved_data->date,
        ':client' => $recieved_data->client,
        ':license_plate' => $recieved_data->licensePlate,
        ':order_number' => "U".str_pad(1, 6, "0", STR_PAD_LEFT)."",
        
    );

    $query = "INSERT INTO orders(date, client, truckLicensePlate, orderNumber) VALUES(:date, :client, :license_plate, :order_number)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message' => 'Užsakymas pridėtas'
    );

    echo json_encode($output);
}


?>