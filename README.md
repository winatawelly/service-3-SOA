Service 3
Internet dan TV Kabel

- Add New Transaction

Service ini ini berguna untuk menambahkan transaksi baru kedalam database
URL : soa/backend/service3.php/transaction/add/
Setiap transaksi yang masuk, akan mendapat status “pending”. Status dapat diubah dengan “Complete Transaction Service” jika pembayaran sudah terkonfirmasi oleh payment gateway.  
Expected method : POST
Expected data (header) : none
Expected data (body) : json
Value username pada body dapat diganti dengan userid
Contoh data (body) :
  {
        "username":"winatawelly12",
        "type":"internet",
        "provider":"indihome",
        "bill_id":"123123123"
  }
Contoh response success :
{
       "code": "success",
       "message": "Your transaction request has been made. 
        To finish this  transaction please complete the payment",
       "id": 49,
       "total": 200000
}

Contoh response failed :
{
        "code": "failed",
        "message": "You have made this request before, please check 
         your pending transaction!",
        "id": "",
        "total": ""
}


- View All Transaction

Service ini berguna untuk melihat semua transaksi user
Response dari service ini berupa ARRAY dari semua transaksi user
URL : soa/backend/service3.php/transaction/{username}/[{filter}]
Expected method : GET
Expected data (header) :
  - Username atau userid
  - Filter (optional, dapat berupa “pending” atau “completed”)
Expected data (body) : none
Contoh response success :
 [{
        "transaction_id": "50",
        "username": "winatawelly12",
        "type": "internet",
        "provider": "indihome",
        "bill_id": "123123123",
        "total": "200000",
        "month": "6",
        "date_made": "2019-06-03 01:47:37",
        "date_completed": null,    
        "status": "pending"
   }]
Contoh response failed :
 {
        "code": "failed",
        "message": "not found"
 }


- Complete Transaction

Service ini berguna untuk menyelesaikan transaksi yang pending
Service ini akan dipanggil oleh payment gateway ketika pembayaran sudah terkonfirmasi
URL : soa/backend/service3.php/transaction/complete/{transaction_id}
Expected method : PUT
Expected data (header) : transaction_id
Expected data (body) : none
Contoh respon success : 
{
        "code": "success",
        "message": "The transaction is now complete, 
         you can check it on your transaction hisotry!"
  }

Contoh respon failed : 
			{
        "code": "failed",
        "message": "This transaction is already complete or could 
         not be found, please check your transaction id!"
  }







