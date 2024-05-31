
<?php

if($_SERVER['REQUEST_METHOD'] = $_POST){
    $USER_NAME = $_POST['username'];
    $EMAIL = $_POST['email'];
    $PASSWORD = $_POST['password'];
    

    $EMAIL_REGEX = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    if(!isset($USERNAME) || !isset($EMAIL) || !isset($PASSWORD)  ){
        echo "Form Validation error";
    }
    

    if (!preg_match($EMAIL_REGEX, $EMAIL)) {
        echo "Enter valid Email Address";
    }


    else{

        $HASHED_PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);

        $HOSTNAME = "localhost";
        $USERNAME = 'root';
        $PASSWORD = '';
        $DATABASE = 'user_details';

        $conn = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

        if ($conn) {
            
            $query = $conn->prepare("INSERT INTO `users_management_table` (`username`, `email_id`, `password`) VALUES (?, ?, ?)");

            $query->bind_param("sss",$USER_NAME, $EMAIL, $HASHED_PASSWORD);

            if (!$query->execute()) {
                die($query->error);
            } else {
                header('location: ./success.html');
            }
        }
        else{
            echo ("Error in connection");
        }

        $conn->close();
    }
        
}


?>
