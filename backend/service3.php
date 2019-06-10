<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'Slim/vendor/autoload.php';
require 'connect.php';
$app = new \Slim\App;
/*
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
*/


//Add new transaction
$app->post('/transaction/add/' , function($request,$response,$args){
    global $conn;
    $data = $request->getParsedBody();

    $username = $data['username']; //username or user id
    $_type = $data['type'];
    $_provider = $data['provider'];
    $bill_id = $data['bill_id'];
    $month = date('m');

    $total = 200000;


    $sql = $conn->prepare("INSERT INTO transaction ( username, type, provider , bill_id, total, month ) VALUES ( ?, ?, ?, ?, ?, ?)");
    $sql->bind_param('ssssii', $username,$_type,$_provider,$bill_id,$total,$month);
	if($sql->execute()){
        $message = array();
        $message['code'] = "success";
        $message['message'] = "Your transaction request has been made. To finish this transaction please complete the payment";
        $message['id'] = $conn->insert_id;
        $message['total'] = $total;
        return $response->withJson($message,201);
        //return $response->withStatus(201)->write(json_encode($message));
    }else{
        $message['code'] = "failed";
        $message['message'] = "You have made this request before, please check your pending transaction!";
        $message['id'] = '';
        $message['total'] = '';
        return $response->withJson($message,500);
        //return $response->withStatus(500)->write(json_encode($message));

    }

});

//view all transaction atau transaction history;
$app->get('/transaction/{username}/[{filter}]', function ($request,$response,$args) {
    global $conn;
    $optional = '';
    $username = $args['username'];
    $message = array();
    $message['code'] = 'failed';
    $message['message'] = 'not found';
    if(isset($args['filter'])){
        $filter = $args['filter'];
        $optional = "AND status = '$filter'";
    }
    $sql = "SELECT * FROM transaction WHERE username = '$username' ".$optional;

    if ($result = $conn->query($sql)) {
    	if (($rows = $result->num_rows) > 0) {
    		$response = $response->withJson($result->fetch_all(MYSQLI_ASSOC));
    	}
    	$result->close();
    }
    return ($rows > 0) ?
        $response :
    	$response->withJson($message,404);

});

//finish transaction
$app->put('/transaction/complete', function($request,$response,$args){
    global $conn;
    $data = $request->getParsedBody();
    $status = $data['status'];
    $transaction_id = $data['tid'];
    $message = array();
    $message['code'] = 'failed'; //default return code;

    //check if the requested transaction is exist;
    $sql = "SELECT status FROM transaction WHERE transaction_id = $transaction_id";
    if($result = mysqli_query($conn,$sql)){
        $rows = mysqli_fetch_assoc($result);
        //check if the requested transaction is on pending status
        if($rows['status'] == 'pending'){

            //if it is pending , complete the transaction and then change the return code;
            $sql = "UPDATE transaction SET status = '$status' , date_made = date_made WHERE transaction_id = $transaction_id";
            if(mysqli_query($conn,$sql)){
                if(mysqli_affected_rows($conn) > 0){
                    $message['code'] = 'success';
                }
            }

        }
    }
    //set return message then return the response;
    if($message['code'] == 'success'){
        $message['message'] = "The transaction is now complete, you can check it on your transaction hisotry!";
        return $response->withJson($message,200);
    }
    else{
        $message['message'] = "This transaction is already complete or could not be found, please check your transaction id!";
        return $response->withJson($message,404);
    }

});




$app->run();

?>
