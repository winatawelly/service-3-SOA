<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'Slim/vendor/autoload.php';
require 'connect.php';
$app = new \Slim\App;

$app->get("/billing/internet/unpaid/{customer_number}", function($request,$response,$args){
    $output = array();
    $customer_number = $args['customer_number'];
    global  $conn;
    $sql = "SELECT * from customer WHERE customer_number = '$customer_number'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['status']=="lunas" || $rows['tipe'] != 'internet'){
        $output['code'] = 'failed';
        $output['message'] = 'Your customer bill doesnt exist or already paid';
        return $response->withJson($output,400);
    }else{
        $bill_id = 'bill'.$customer_number;
        $sql = $conn->prepare("INSERT INTO bill ( bill_id ,customer_number , tipe , provider, price, month , year ) VALUES ( ?, ?, ?, ?, ?, ? , ?)");
        $sql->bind_param('ssssiii', $bill_id,$customer_number,$rows['tipe'],$rows['provider'],intval($rows['price']),intval($rows['month']),intval($rows['year']));
        if($sql->execute()){
            $output['code'] = "success";
            $output['message'] = "Your payment request has been made, please complete the payment to finish this transaction";
            $output['bill_id'] = $bill_id;
            $output['tipe'] = $rows['tipe'];
            $output['provider'] = $rows['provider'];
            $output['price'] = $rows['price'];
            $output['month'] = $rows['month'];
            $output['year'] = $rows['year'];
            return $response->withJson($output,200);
        }else{
            $output['code'] = "success";
            $output['message'] = "Your payment request has been made, please complete the payment to finish this transaction";
            $output['bill_id'] = $bill_id;
            $output['tipe'] = $rows['tipe'];
            $output['provider'] = $rows['provider'];
            $output['price'] = $rows['price'];
            $output['month'] = $rows['month'];
            $output['year'] = $rows['year'];
            return $response->withJson($output,200);
        }

    }
   
});

$app->get("/billing/tv/unpaid/{customer_number}", function($request,$response,$args){
    $output = array();
    $customer_number = $args['customer_number'];
    global  $conn;
    $sql = "SELECT * from customer WHERE customer_number = '$customer_number'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['status']=="lunas" || $rows['tipe'] != 'tv'){
        $output['code'] = 'failed';
        $output['message'] = 'Your customer bill doesnt exist or already paid';
        return $response->withJson($output,400);
    }else{
        $bill_id = 'bill'.$customer_number;
        $sql = $conn->prepare("INSERT INTO bill ( bill_id ,customer_number , tipe , provider, price, month , year ) VALUES ( ?, ?, ?, ?, ?, ? , ?)");
        $sql->bind_param('ssssiii', $bill_id,$customer_number,$rows['tipe'],$rows['provider'],intval($rows['price']),intval($rows['month']),intval($rows['year']));
        if($sql->execute()){
            $output['code'] = "success";
            $output['message'] = "Your payment request has been made, please complete the payment to finish this transaction";
            $output['bill_id'] = $bill_id;
            $output['tipe'] = $rows['tipe'];
            $output['provider'] = $rows['provider'];
            $output['price'] = $rows['price'];
            $output['month'] = $rows['month'];
            $output['year'] = $rows['year'];
            return $response->withJson($output,200);
        }else{
            $output['code'] = "success";
            $output['message'] = "Your payment request has been made, please complete the payment to finish this transaction";
            $output['bill_id'] = $bill_id;
            $output['tipe'] = $rows['tipe'];
            $output['provider'] = $rows['provider'];
            $output['price'] = $rows['price'];
            $output['month'] = $rows['month'];
            $output['year'] = $rows['year'];
            return $response->withJson($output,200);
        }

    } 
});

$app->get('/billing/internet/completed/{customer_number}' , function($request , $response , $args){
    global $conn;
    $output = array();
    $customer_number = $args['customer_number'];
    $sql = "SELECT * from customer WHERE customer_number = '$customer_number' and status = 'lunas'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['tipe'] != 'internet'){
        $output['code'] = 'failed';
        $output['message'] = 'Your customer number doesnt exist or hasnt been paid, please check again';
        return $response->withJson($output,404);
    }else{
        $output['code'] = 'success';
        $output['message'] = 'details';
        $output['customer_number'] = $rows['customer_number'];
        $output['tipe'] = $rows['tipe'];
        $output['provider'] = $rows['provider'];
        $output['price'] = $rows['price'];
        $output['month'] = $rows['month'];
        $output['year'] = $rows['year'];
        $output['status'] = $rows['status'];
        return $response->withJson($output,200);

    }
});

$app->get('/billing/tv/completed/{customer_number}' , function($request , $response , $args){
    global $conn;
    $output = array();
    $customer_number = $args['customer_number'];
    $sql = "SELECT * from customer WHERE customer_number = '$customer_number' and status = 'lunas'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['tipe'] != 'tv'){
        $output['code'] = 'failed';
        $output['message'] = 'Your customer number doesnt exist or hasnt been paid, please check again';
        return $response->withJson($output,404);
    }else{
        $output['code'] = 'success';
        $output['message'] = 'details';
        $output['customer_number'] = $rows['customer_number'];
        $output['tipe'] = $rows['tipe'];
        $output['provider'] = $rows['provider'];
        $output['price'] = $rows['price'];
        $output['month'] = $rows['month'];
        $output['year'] = $rows['year'];
        $output['status'] = $rows['status'];
        return $response->withJson($output,200);

    }
});

//service ini diakses oleh service 6 (payment)
$app->get('/billing/internet/{bill_id}', function($request,$response,$args){
    global $conn;
    $output = array();
    $bill_id = $args['bill_id'];
    $sql = "SELECT * from bill WHERE bill_id = '$bill_id'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['tipe'] != 'internet'){
        $output['code'] = 'failed';
        $output['message'] = 'Your bill doesnt exist or already paid';
        return $response->withJson($output,404);
    }else{
        $output['code'] = "success";
        $output['message'] = "bill details";
        $output['bill_id'] = $rows['bill_id'];
        $output['tipe'] = $rows['tipe'];
        $output['provider'] = $rows['provider'];
        $output['price'] = $rows['price'];
        $output['month'] = $rows['month'];
        $output['year'] = $rows['year'];
        $output['status'] = $rows['status'];
        $output['date_made'] = $rows['date_made'];
        $output['date_complete'] = $rows['date_complete'];
        return $response->withJson($output,200);
    }
    

});
//service ini diakses oleh service 6 (payment)
$app->get('/billing/tv/{bill_id}', function($request,$response,$args){
    global $conn;
    $output = array();
    $bill_id = $args['bill_id'];
    $sql = "SELECT * from bill WHERE bill_id = '$bill_id'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['tipe'] != 'tv'){
        $output['code'] = 'failed';
        $output['message'] = 'Your bill doesnt exist or already paid';
        return $response->withJson($output,404);
    }else{
        $output['code'] = "success";
        $output['message'] = "bill details";
        $output['bill_id'] = $rows['bill_id'];
        $output['tipe'] = $rows['tipe'];
        $output['provider'] = $rows['provider'];
        $output['price'] = $rows['price'];
        $output['month'] = $rows['month'];
        $output['year'] = $rows['year'];
        $output['status'] = $rows['status'];
        $output['date_made'] = $rows['date_made'];
        $output['date_complete'] = $rows['date_complete'];
        return $response->withJson($output,200);
    }
    

});

$app->put('/billing/internet/{bill_id}', function($request,$response,$args){
    global $conn;
    $output = array();
    $bill_id = $args['bill_id'];
    $sql = "SELECT * from bill where bill_id = '$bill_id'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['status'] == 'lunas' || $rows['tipe'] != 'internet'){
        $output['code'] = 'failed';
        $output['message'] = 'Your bill doesnt exist or already paid';
        return $response->withJson($output,400);
    }else{
        
        $sql = "UPDATE bill SET status = 'lunas' , date_made = date_made WHERE bill_id = '$bill_id'";
        if(mysqli_query($conn,$sql)){
            $output['code'] = 'success';
            $output['message'] = 'Your transaction is now complete';
            $output['bill_id'] = $bill_id;
        }
        $customer_number = $rows['customer_number'];
        $sql = "UPDATE customer SET status = 'lunas' WHERE customer_number = '$customer_number'";
        mysqli_query($conn,$sql);
        return $response->withJson($output,202);

    }
});

$app->put('/billing/tv/{bill_id}', function($request,$response,$args){
    global $conn;
    $output = array();
    $bill_id = $args['bill_id'];
    $sql = "SELECT * from bill where bill_id = '$bill_id'";
    $result = $conn->query($sql);
    $rows = mysqli_fetch_assoc($result);
    if($rows == null || $rows['status'] == 'lunas' || $rows['tipe'] != 'tv'){
        $output['code'] = 'failed';
        $output['message'] = 'Your bill doesnt exist or already paid';
        return $response->withJson($output,400);
    }else{
        
        $sql = "UPDATE bill SET status = 'lunas' , date_made = date_made WHERE bill_id = '$bill_id'";
        if(mysqli_query($conn,$sql)){
            $output['code'] = 'success';
            $output['message'] = 'Your transaction is now complete';
            $output['bill_id'] = $bill_id;
        }
        $customer_number = $rows['customer_number'];
        $sql = "UPDATE customer SET status = 'lunas' WHERE customer_number = '$customer_number'";
        mysqli_query($conn,$sql);
        return $response->withJson($output,202);

    }
});

/*
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});



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
*/
$app->run();

?>
