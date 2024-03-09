<?php
$name=$_post['name'];
$age=$_post['age'];
$email=$_post['email'];
$phone=$_post['phone'];
$gender=$_post['gender'];
$location=$_post['location'];
$hobbies=$_post['hobbies'];
$bio=$_post['bio'];

// if(!empty($name) || !empty($age) || !empty($email) || !empty($phone) || !empty($gender) || !empty($location) || !empty($hobbies) || !empty($bio)){
   $host="localhost";
   $dbUsername="root";
   $dbPassword="";
   $dbname="features";

   $conn=new mysqli("$host","$dbUsername","$dbPassword","$dbname");

   if(mysqli_connect_error()){
            die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
   
      $SELECT ="SELECT email FROM features_table Where email = ? Limit 1";
      $INSERT ="INSERT into features_table (name,age,email,phone,gender,location,hobbies,bio) values(?,?,?,?,?,?,?,?)";


      $stmt=$conn->prepare($SELECT);
      $stmt->bind_param("s",$email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum=$stmt->num_rows;

      if($rnum==0){
          $stmt->close();

          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("sisissss", $name, $age, $email, $phone, $gender, $location, $hobbies ,$bio);
          $stmt->execute();
          echo "New record inserted successfully";
      }else{
         echo "Someone already register using this email";
      }
      $stmt->close();
      $conn->close();
   }else{
     echo "All field are required";
     die();
}
?>