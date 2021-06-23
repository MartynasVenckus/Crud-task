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

    $orderNumberQuery = "SELECT orderNumber FROM orders ORDER BY orderNumber DESC LIMIT 1";
    
    foreach ($connect->query($orderNumberQuery) as $row){
        $newOrderNumber = "U" .str_pad(substr($row['orderNumber'], -6) + 1, 6, "0", STR_PAD_LEFT);
    }
    
    $data = array(

        ':date' => $recieved_data->date,
        ':client' => $recieved_data->client,
        ':license_plate' => $recieved_data->licensePlate,
        ':order_number' => $newOrderNumber,
    );

    $query = "INSERT INTO orders(date, client, truckLicensePlate, orderNumber) VALUES(:date, :client, :license_plate, :order_number)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message' => 'Užsakymas pridėtas'
    );
    echo json_encode($output);
}

if($recieved_data->action == "fetchSingle") {
    $query = "SELECT * FROM orders WHERE id = '".$recieved_data->id."'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach($result as $row){
        $data['id'] = $row['id'];
        $data['date'] = $row['date'];
        $data['client'] = $row['client'];
        $data['license_plate'] = $row['truckLicensePlate'];
    }
    echo json_encode($data);
}

if ($recieved_data->action == "update") {

    $data = array(
        ':date' => $recieved_data->date,
        ':client' => $recieved_data->client,
        ':license_plate' => $recieved_data->licensePlate,
        ':id' => $recieved_data->hiddenId,
    );

    $query = "UPDATE orders SET date = :date, client = :client, truckLicensePlate = :license_plate WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(
        'message' => 'Užsakymas pakeistas'
    );
    
    echo json_encode($output);
}

if ($recieved_data->action == "delete") {
    $query = "DELETE FROM orders WHERE id = '".$recieved_data->id."'";

    $statement = $connect->prepare($query);
    $statement->execute();

    $output = array(
        'message' => 'Užsakymas pašalintas'
    );

    echo json_encode($output);
}


?>