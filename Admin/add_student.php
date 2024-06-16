<?php
require 'config/database.php';


//get data from database

if(isset($_POST['submit'])){

$name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);     
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);   
$createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
$confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   

//validate inputs

if(!$name){
    $_SESSION['register'] = "Please enter your name";
} elseif(!$email){
        $_SESSION['register'] = "Please enter your email";
        } elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
            $_SESSION['register'] = "Password should be 8+ characters";
            } else{ 
                    //check password equality

                    if($createpassword != $confirmpassword){
                        $_SESSION['register'] = 'password do not match';
                    } else {
                        $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

                        //check if the eamil arealdy exists

                        $user_check_query = "SELECT * FROM users WHERE email = '$email'";
                        $user_check_result = mysqli_query($connection, $user_check_query);

                        if (mysqli_num_rows($user_check_result) > 0) {
                            $_SESSION['register'] = "Student already registered.";
                        } 
                    }
                }

               //if there is an error redirects back to login

               if(isset($_SESSION['register'])){
                //pass data to register page
                $_SESSION['register-data'] = $_POST;
                header('location: ' . ROOT_URL);
                die();
               } else {
                $statement = "SELECT * FROM users";
                $result = mysqli_query($connection, $statement);
                $row = mysqli_num_rows($result);
        
                $id = $row++;
                //insert  data into database
                $date = date('Y-m-d H:i:s');
                 $insert_user_query = "INSERT INTO users (id, name, email, password, date, avatar) VALUES ('$id','$name','$email','$hashed_password', '$date', 'avatar.webp')";

                $insert_user_result = mysqli_query($connection, $insert_user_query);

                 if(!mysqli_errno($connection)){
                    //redirect to login page with success message

                    $_SESSION['register-success'] = "$name registered Successfully.";
                    header('location: ' . ROOT_URL );
                    die();
                 }
               }
               
             } else{

//if button was not clicked then back to signup

header('Location: '. ROOT_URL);
die();

}