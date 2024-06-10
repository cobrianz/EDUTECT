<?php
require 'config/database.php';


//get data from database

if(isset($_POST['submit'])){

$name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);     
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);   
$createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
$confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
$avatar = $_FILES['avatar'];

//validate inputs

if(!$name){
    $_SESSION['signup'] = "Please enter your name";
} elseif(!$email){
        $_SESSION['signup'] = "Please enter your email";
        } elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
            $_SESSION['signup'] = "Password should be 8+ characters";
            } elseif(!$avatar['name']){
                $_SESSION['signup'] = "Please add an avatar"; 
                } else{ 
                    //check password equality

                    if($createpassword != $confirmpassword){
                        $_SESSION['signup'] = 'password do not match';
                    } else {
                        $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

                        //check if the eamil arealdy exists

                        $user_check_query = "SELECT * FROM users WHERE email = '$email'";
                        $user_check_result = mysqli_query($connection, $user_check_query);

                        if (mysqli_num_rows($user_check_result) > 0) {
                            $_SESSION['signup'] = "Your email already registered. Please login";
                        } else {
                            //AVATAR
                            //remane avatar

                           $time = time(); //unique time stamp for each image

                           $avatar_name = $time . $avatar['name'];
                           $avatar_tmp_name = $avatar['tmp_name'];
                           $avatar_destination_path = 'profiles/' . $avatar_name;
                           //make sure the avatar is an image

                           $allowed_files = ['png', 'jpg', 'jpeg'];
                           $extention = explode('.', $avatar_name);
                           $extention = end($extention);

                           if(in_array($extention, $allowed_files)){
                            //make sure the avatar is not too large

                            if($avatar['size'] < 4000000){

                                //upload image

                                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);

                               }else{
                                    $_SESSION['signup'] = 'File is too large. Should be less than 2mb';
                                 }
                            } else {
                                $_SESSION['signup'] = 'File should be png, jpg,or jpeg.';
                            }
                           }
                    }
                }

               //if there is an error redirects back to login

               if(isset($_SESSION['signup'])){
                //pass data to signup page
                $_SESSION['signup-data'] = $_POST;
                header('location: ' . ROOT_URL .'signup.php');
                die();
               } else {
                $statement = "SELECT * FROM users";
                $result = mysqli_query($connection, $statement);
                $row = mysqli_num_rows($result);
        
                $id = $row++;
                //insert  data into database
                 $insert_user_query = "INSERT INTO users (id, name, email, password, avatar) VALUES ('$id','$name','$email','$hashed_password','$avatar_name')";

                $insert_user_result = mysqli_query($connection, $insert_user_query);

                 if(!mysqli_errno($connection)){
                    //redirect to login page with success message

                    $_SESSION['signup-success'] = "Registration Successfully. Please login";
                    header('location: ' . ROOT_URL .'login.php');
                    die();
                 }
               }
               
             } else{

//if button was not clicked then back to signup

header('Location: '. ROOT_URL . 'signup.php');
die();

}