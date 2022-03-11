<?php
include_once("validate_user.php");
if(isset($_POST['reference'])){
	$reference=$_POST['reference'];
}
if(isset($_POST['userEmail'])){
	$userEmail=$_POST['userEmail'];
}
$data=array();
$result = array();
//The parameter after verify/ is the transaction reference to be verified
$url = "https://api.paystack.co/transaction/verify/$reference";

$ch = curl_init();//initialize or initiates connection
curl_setopt($ch, CURLOPT_URL, $url);//communicates with the specified url
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//return the transfer as a string if true(1) 
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_ceb52c9243d86ada2fb499813925dad1e8a8a031']
);

$request = curl_exec($ch);
if(curl_error($ch)){
		echo 'error:' . curl_error($ch);
 }
curl_close($ch);

if ($request) {
  $result = json_decode($request, true);
  	echo json_encode($result);
	print_r($result);
	exit();
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
	$data["status"]=$result["data"]["status"];
	$data["reference"]=$result["data"]["reference"];
	$data["id"]=$result["data"]["id"];
	$data["amount"]=$result["data"]["amount"];
	$data["date"]=$result["data"]["paid_at"];
	$data["displayName"]=$result["data"]["metadata"]["custom_fields"][0]["display_name"];
	$data["phoneNumber"]=$result["data"]["metadata"]["custom_fields"][0]["value"];
	$data["senderName"]=$result["data"]["metadata"]["custom_fields"][1]["display_name"];
	$data["senderValue"]=$result["data"]["metadata"]["custom_fields"][1]["value"];
	$data["channel"]=$result["data"]["channel"];
	
	$mysqli = new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die("could not connect to the database");
	$insert="INSERT INTO transaction_data(transaction_id,transaction_reference,amount,paid_by,phone_number,channel,email,date)VALUES('".$data['id']."',
			'".$data['reference']."','".$data['amount']."','".$data['senderValue']."','".$data['phoneNumber']."','".$data['channel']."','$userEmail','".$data['date']."')";
			$query=$mysqli->query($insert);
			if($mysqli->affected_rows==1){
  //echo "Transaction was successful";
	$insert="INSERT INTO transaction_admindata(transaction_id,transaction_reference,amount,paid_by,phone_number,channel,email,date)VALUES('".$data['id']."',
								'".$data['reference']."','".$data['amount']."','".$data['senderValue']."','".$data['phoneNumber']."','".$data['channel']."','$userEmail','".$data['date']."')";
								$query=$mysqli->query($insert);
									if($mysqli->affected_rows==1){
										
										echo json_encode($data);
									}
						}
					else{
							echo $mysqli->error;
						}
	//Perform necessary action
}
else{
		echo "unsuccessful";
}

?>