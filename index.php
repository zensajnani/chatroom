<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Zen Chat</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center">
        <br>
        <h1>Zen's Chatroom</h1>
        <br><br>
        <?php
            session_start();
            $loggedIn = false;
            $userName = "";
            if(isset($_SESSION['name'])) {
                $loggedIn = true;
            }
            

            function loginForm(){
                echo'
                <div class="container border p-2 p-md-4" id="loginform">
                <form action="index.php" method="post" class="">
                    <p>Enter a nickname to start sending messages:</p>
                    <label for="name">Name:  </label>
                    <input type="text" name="name" id="name" class="form-control"/>
                    <br>
                    <input type="submit" name="enter" id="enter" value="Enter" class="btn btn-primary btn-block"/>
                </form>
                </div>
                <br><br>
                ';
            }

            

            function getMessages() {
                if(file_exists("chat.html") && filesize("chat.html") > 0){
                    $handle = fopen("chat.html", "r");
                    $contents = fread($handle, filesize("chat.html"));
                    fclose($handle);
                    return $contents;  
                }
            }
            
            if(isset($_POST['enter'])){
                if($_POST['name'] != ""){
                    $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
                    $userName = $_SESSION['name'];
                    $loggedIn = true;
                }
                else{
                    echo '<span class="error">Please type in a name</span>';
                }
            }

            // If user is not logged in then show login form
            if(!$loggedIn) {
                loginForm();
            }
            $messages = getMessages();        

            if(isset($_POST['logout'])){
                session_destroy();
                $loggedIn = false;
                header("Location: index.php");
            }

            ?>
            
            <!-- ChatBox -->

            <div class="border p-2 p-md-4" id="chatbox-external">
                <div id="chatbox-menu">
                    <h3 class="welcome">Welcome <?php echo $_SESSION['name'] ?></h3>
                </div>
                    
                    <div class="border" id="chatbox"><?php echo $messages ?></div>
                    <br> 
                    <?php
                    if($loggedIn){
                        echo '
                        <form action="" name="message">
                            <input name="userMessage" id="userMessage" type="text" size="100" class="form-control" placeholder="Enter your Message">
                            <br>
                            <input name="sendMessage" id="sendMessage" type="submit" value="Send your message" class="btn btn-primary btn-block">
                        </form>
                        ';
                    }
                    else {
                        echo '<form action="" name="message" >
                            <input type="text" size="100" class="form-control" placeholder="Enter your Message" disabled>
                            <small class="form-text text-muted">Please log in to send your message.</small>
                            <br>
                            <input type="submit" value="Send your message" class="btn btn-primary btn-block" disabled>
                        </form>';
                    }
                    
                    ?>
                </div>
                <br>

                <!-- Logout Button -->
                <form method="post"> 
                    <input type="submit" value="Logout" name="logout" class="btn btn-danger align-center">
                </form> 
            <br><br><br><br>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>
</html>