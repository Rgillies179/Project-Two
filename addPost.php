<?php
require_once "config.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // $targetDir = "uploads/";
    // $fileName = basename($_FILES["file"]["name"]);
    // $targetFilePath = $targetDir . $fileName;
    // $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    if(isset($_POST["submit"])){
    // get all of the form data 
    
                    $title = $_POST['title']; 
            $textboxContent = $_POST['textboxContent']; 
    
//---------------------------------------------CHANGE THIS--------------- should not be 11-------------------------------------------------------------
$email1 =  htmlspecialchars($_SESSION["email"]);
$query = "SELECT user_id FROM users WHERE email = '".$email1."'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$temp = $row['user_id'];


$sql = "SELECT * FROM users WHERE user_id = '".$temp."'";
    $result = mysqli_query($link, $sql);
    
    while ($row = $result->fetch_assoc()) {
        $user_id =  $row['user_id']."<br>";
    }
//---------------------------------------------CHANGE THIS--------------- should not be 11-------------------------------------------------------------

// if ($title != "" && $textboxContent != "" ){
//     // Allow certain file formats
//     $allowTypes = array('jpg','png','jpeg','gif','pdf');
//     if(in_array($fileType, $allowTypes)){
//     // Upload file to server
//     if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
//         $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
//     }
// }
// }


                    // create and format some variables for the database

                    $post_id = '';
                    $param_title = $title;
                    $param_textboxContent = $textboxContent;
                    // $param_image = $fileName;
                    $image = "";
                     
                    // insert the user into the database
                    mysqli_query($link, "INSERT INTO posts VALUES ('{$post_id}', '{$user_id}', '{$param_title}', '{$image}', '{$param_textboxContent}' )");

                    // verify the user's account was created
                    $query = mysqli_query($link, "SELECT * FROM posts WHERE post_id='{$post_id}'");
                    if (mysqli_num_rows($query) == 1){
                        $success = true;
                        
                    } else {
                        $error_msg = 'An error occurred and your post was not created.';
                        }
                
    
                    }
        $error_msg ="somthing is wrong";
// Closing the connection.
mysqli_close($link);


    }
    $title = ""; 
    $textboxContent = ""; 

?>


<!DOCTYPE html>

    <head>
        <meta charset="UTF-8">
        <title> Add a Post </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <style>
            h1 {text-align: center;}
        </style>
    </head>
    <body>
    <div class="wrapper">

    <h1 class="my-2">Add a Post</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($title)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
            </div> 

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="textboxContent" class="form-control <?php echo (!empty($textboxContent)) ? 'is-invalid' : ''; ?>" value="<?php echo $textboxContent; ?>">
            </div> 
 

                <label>Select Image:</label>
                <br>
                <input type="file" name="file" class="btn">

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit Post">
                <a href="welcome.php" class="btn btn-danger ml-3">Back</a>
            </div> 
            
    </form>

</div>
    </body>
</html>
