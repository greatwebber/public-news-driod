    <?php
    require_once '../include/config.php';



    //$message = new sendMailMessage();
    //$email_send = new messageSend();

    function notify_view($msg,$colorType,$duration,$action = false){
        if($colorType === 'success'){
            $color = "#1abc9c";
        }elseif ($colorType  === 'danger'){
            $color = "#e7515a";
        }elseif ($colorType === 'warning'){
            $color = "#e2a03f";
        }elseif ($colorType === 'info'){
            $color = "#2196f3";
        }else{
            $color = "#4361ee";
        }

        if($action === false){
            $actionMsg = "DISMISS";
        }else{
            $actionMsg = $action;
        }


        $toast = '<script type="text/javascript">
            $(document).ready(function(){
            Snackbar.show({
                    text: "'.ucwords($msg).'",
                    actionTextColor: "#fff",
                    backgroundColor: "'.$color.'",
                    pos: "top-right",
                    duration: "'.$duration.'",
                    actionText: "'.$actionMsg.'"
                });
            });
        </script>';

        $_SESSION['flash'] = $toast;
    }

    if(isset($_POST['admin_login'])){

        $email = inputValidation($_POST['email']);
        $password = inputValidation($_POST['password']);

        $stmt = $conn->query("SELECT * FROM admin WHERE admin_email='$email' and admin_password='$password'");

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() <= 0){
            notify_alert('Invalid Details','danger','3000','close');
        }else {
            $_SESSION['admin'] = $email;
            redirect(WEB_URL.'admin/dashboard.php');

        }



    }

    if(isset($_POST['industrial_login'])){

        $email = inputValidation($_POST['email']);
        $password = inputValidation($_POST['password']);

        $sql = "SELECT * FROM fpe_industrial_supervisor WHERE email=:email and password=:password";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'email'=>$email,
            'password'=>$password
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() <= 0){
            notify_view('Invalid Details','danger','3000','close');
        }else{
            $_SESSION['industrial'] = $email;
            redirect(WEB_URL.'industrial/dashboard.php');

        }

    }

