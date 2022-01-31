<?php

include 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;



function inputValidation($value): string
{
    return trim(htmlspecialchars(htmlentities($value)));
}
function redirect($url){
    return header("Location:$url");
    exit();
}
function user_details($value){
    global $conn;
    $sql = "SELECT u.id,u.acct_state,u.acct_image,u.acct_email,s.name FROM users u left join states s on u.acct_state = s.id WHERE u.acct_email =:acct_email";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'acct_email'=>$_SESSION['login']
    ]);
    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rs[$value];
}
function userStatus($value){
    $res = null;
    if($value === '1'){
        $res =  "Active";
    }elseif ($value === '0'){
        $res = "No";
    }elseif ($value === '2'){
        $res = "Draft";
    }
    return $res;
}

function get_time_ago( $time ){
    $time_difference = time() - $time;

    if( $time_difference < 1 ) {
        return 'less than 1 second ago';
    }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
        30 * 24 * 60 * 60       =>  'mon',
        24 * 60 * 60            =>  'day',
        60 * 60                 =>  'hr',
        60                      =>  'min',
        1                       =>  'sec'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function page_title($page_title = false){
    if ($page_title !== false){
      return $page_title." - ".WEB_TITLE;
    }else{
        return WEB_TITLE;
    }
}

function notify_alert($msg,$colorType,$duration,$action = false){
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

function flash(){
    if (isset($_SESSION['flash'])){
        echo $_SESSION['flash'];
        unset($_SESSION['flash']);
    }
}



if(isset($_POST['loginSubmit'])){
    $acct_email = $_POST['acct_email'];
    $password = $_POST['password'];

    $log = "SELECT * FROM users WHERE acct_email =:acct_email";
    $stmt = $conn->prepare($log);
    $stmt->execute([
        'acct_email'=>$acct_email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() === 0){
        notify_alert('Invalid login details','danger','2000','Close');

    }else{
        $validPassword = password_verify($password, $user['acct_password']);

        if ($validPassword === false){
            notify_alert('Invalid login details','danger','2000','Close');

        }else{
            $_SESSION['login'] = $acct_email;
            header("Location:./users/home.php");
            exit;
        }
    }

}

if(isset($_POST['register'])){
    $full_name = $_POST['full_name'];
    $acct_email = $_POST['acct_email'];
    $acct_password = $_POST['acct_password'];
    $acct_gender = $_POST['acct_gender'];
    $acct_state = $_POST['acct_state'];


    $usersVerified = "SELECT * FROM users WHERE acct_email=:acct_email";
    $stmt = $conn->prepare($usersVerified);
    $stmt->execute([
        'acct_email'=>$acct_email
    ]);

    if($stmt->rowCount() > 0){
        notify_alert('Email Already Exit','danger','3000','close');
    }else {
        $registered = "INSERT INTO users (full_name,acct_email,acct_password,acct_gender,acct_state) VALUES(:full_name,:acct_email,:acct_password,:acct_gender,:acct_state)";
        $reg = $conn->prepare($registered);
        $reg->execute([
            'full_name' => $full_name,
            'acct_email' => $acct_email,
            'acct_password' => password_hash((string)$acct_password, PASSWORD_BCRYPT),
            'acct_gender'=>$acct_gender,
            'acct_state'=>$acct_state
        ]);


        if (true) {
            notify_alert('Account Registered Successfully','success','3000','close');

            redirect('./login.php');
            exit();
        }
    }

}

if (isset($_POST['addPost'])){
    $title = $_POST['title'];
    $post = $_POST['post'];
    $categories = $_POST['categories'];
    $tags = $_POST['tags'];
    @$featured = $_POST['featured'];
    @$publish = $_POST['publish'];
    @$draft = $_POST['draft'];
    $blog_id = uniqid();
    $blog_author = $_POST['blog_author'];
    $blog_state = $_POST['blog_state'];
    @$blog_author_id = $_POST['blog_author_id'];

    if($featured === null){
        $featuredsec = '0';
    }else{
        $featuredsec = $featured;
    }

    if($publish === '1'){
        $blog_status = 1;
    }elseif ($draft === '2'){
        $blog_status = 2;
    }else{
        $blog_status = 1;
    }

    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $name = $file['name'];

        $path = pathinfo($name, PATHINFO_EXTENSION);

        $allowed = array('jpg', 'png', 'jpeg');


        $folder = "../assets/img/post/";
        $n =time(). $name;

        $destination = $folder . $n;
    }
    if (move_uploaded_file($file['tmp_name'], $destination)) {

        $stmt = $conn->prepare('INSERT INTO blogs (blog_id, title, post, categories,blog_author,blog_author_id, tags,featured,blog_state,blog_status, featured_image) VALUES (:blog_id,:title,:post,:categories,:blog_author,:blog_author_id,:tags,:featured,:blog_state,:blog_status,:featured_image)');
        $stmt->execute([
            'blog_id' => $blog_id,
            'title' => $title,
            'post' => $post,
            'categories' => $categories,
            'blog_author'=>$blog_author,
            'blog_author_id'=>$blog_author_id,
            'tags' => $tags,
            'blog_status' => $blog_status,
            'featured'=>$featuredsec,
            'blog_state'=>$blog_state,
            'featured_image' => $n

        ]);

        if(true){
            notify_alert('Post Added Successfully','success','3000','close');

            redirect('./blog.php');
            exit();
        }

        notify_alert('Sorry Something went wrong','danger','3000','close');
    }



}







class message{
    public function send_mail($email, $message, $subject){
        $web_url = WEB_URL;

        $mail = new PHPMailer();
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "testbingme.host";
        $mail->SMTPAuth = true;
        $mail->Username = "bankpro@testbingme.host";
        $mail->Password = '2YH3aF9hq,b!';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('bankpro@testbingme.host','Royal Gateway');
        $mail->addAddress("$email");
        $mail->AddReplyTo("bankpro@testbingme.host", "Royal Gateway");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();

    }
}

class emailMessage{
    public function contactMail($full_name, $email3, $subject3, $message3,$APP_NAME,$web_url){
        return "<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <style type='text/css'>
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*='margin: 16px 0;'] {
            margin: 0 !important;
        }
    </style>
</head>

<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
    <!-- HIDDEN PREHEADER TEXT -->
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <!-- LOGO -->
        <tr>
            <td bgcolor='#FFA73B' align='center'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#FFA73B' align='center' style='padding: 0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                            <img src='$web_url/assets/profile/logo.png' width='125' height='120' style='display: block; border: 0px;' />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding: 0px 15px 0px 15px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                            <p style='margin: 0;'>Daer Admin Someone just drog a message for You</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='' style='padding: 0px 15px 0px 15px;'>
                            <table width='100%' border='2' cellspacing='5' cellpadding='5' >
                                <tr>
                                    <td bgcolor='#ffffff' align='' >NAME</td>
                                    <td bgcolor='#ffffff' align='' >$full_name</td>
                                </tr>
                                <tr>
                                    <td bgcolor='#ffffff' align='' >EMAIL</td>
                                    <td bgcolor='#ffffff' align='' >$email3</td>
                                </tr>
                                <tr>
                                    <td bgcolor='#ffffff' align='' >SUBJECT</td>
                                    <td bgcolor='#ffffff' align='' >$subject3</td>
                                </tr>

                                <tr>
                                    <td bgcolor='#ffffff' align='' >MESSAGE</td>
                                    <td bgcolor='#ffffff' align='' >$message3</td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
    </table>
</body>

</html>";

    }
    public function contactMail2($full_name, $email2, $phone, $visa,$APP_NAME,$web_url){
        return "<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <style type='text/css'>
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*='margin: 16px 0;'] {
            margin: 0 !important;
        }
    </style>
</head>

<body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
    <!-- HIDDEN PREHEADER TEXT -->
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <!-- LOGO -->
        <tr>
            <td bgcolor='#FFA73B' align='center'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#FFA73B' align='center' style='padding: 0px 10px 0px 10px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                            <img src='$web_url/assets/profile/logo.png' width='125' height='120' style='display: block; border: 0px;' />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding: 0px 15px 0px 15px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                    <tr>
                        <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                            <p style='margin: 0;'>Daer Admin Someone just drog a message for You</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor='#ffffff' align='' style='padding: 0px 15px 0px 15px;'>
                            <table width='100%' border='2' cellspacing='5' cellpadding='5' >
                                <tr>
                                    <td bgcolor='#ffffff' align='' >NAME</td>
                                    <td bgcolor='#ffffff' align='' >$full_name</td>
                                </tr>
                                <tr>
                                    <td bgcolor='#ffffff' align='' >EMAIL</td>
                                    <td bgcolor='#ffffff' align='' >$email2</td>
                                </tr>
                                <tr>
                                    <td bgcolor='#ffffff' align='' >PHONE NUMBER</td>
                                    <td bgcolor='#ffffff' align='' >$phone</td>
                                </tr>

                                <tr>
                                    <td bgcolor='#ffffff' align='' >VISA</td>
                                    <td bgcolor='#ffffff' align='' >$visa</td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
    </table>
</body>

</html>";

    }

}


