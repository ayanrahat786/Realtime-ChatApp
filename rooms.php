<?php

$roomname = $_GET['roomname'];

include 'db_connect.php';

$sql= "SELECT * FROM `rooms` WHERE roomname = '$roomname'";
$result = mysqli_query($conn, $sql);

if($result)
{
    if(mysqli_num_rows($result)==0)
    {
        $message = "This room does not exist. Try creating a new one";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
}
else    
{
    echo "Error: ".mysqli_error($conn);
}
//echo "hello";

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/product/">



    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        margin: 0 auto;
        max-width: 800px;
        padding: 0 20px;
    }

    .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .container::after {
        content: "";
        clear: both;
        display: table;
    }

    .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .container img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }

    .anyClass {
        height: 350px;
        overflow-y: scroll;
    }
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">MyAnonymousChat.com</h5>
        <nav class="my-2 my-md-0 mr-md-3"><a class="p-2 text-dark" href="#">Home</a><a class="p-2 text-dark"
                href="#">About</a><a class="p-2 text-dark" href="#">Contact</a></nav>
    </div>
    <h2>Chat Messages - <?php echo $roomname ?></h2>
    <div class="container">
        <div class="anyClass"><img src=" /w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
            <p>Hello. How are you today?</p><span class="time-right">11:00</span>
        </div>
    </div>
    <input type="text" class="form-control" name="usermsg" id="usermsg" placeholde="Add message"><br>
    <button class="btn btn-dark" name="submitmsg" id="submitmsg">Send</button>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script type="text/javascript">
    setInterval(runFunction, 1000);

    function runFunction() {
        $.post("htcont.php", {
            room: '<?php echo $roomname ?>'

        }, function(data, status) {
            document.getElementsByClassName('anyClass')[0].innerHTML = data;
        })
    }

    // Get the input field
    var input = document.getElementById("usermsg");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("submitmsg").click();
        }
    });
    $("#submitmsg").click(function() {
        var clientmsg = $("#usermsg").val();
        $.post("postmsg.php", {
                text: clientmsg,
                room: '<?php echo $roomname ?>',
                ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'

            },

            function(data, status) {
                document.getElementsByClassName('anyClass')[0].innerHTML = data;

            });
        $('#usermsg').val("");
        return false;

    });
    </script>

</body>

</html>