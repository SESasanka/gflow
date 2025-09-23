<?php

include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code` = '".$code."' WHERE `email` = '".$email."' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sasankaakash22@gmail.com';
        $mail->Password = 'mvvvggcfknzaqxhb';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sasankaakash22@gmail.com', 'Reset Password');
        $mail->addReplyTo('sasankaakash22@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Gflow Computers Forgot password Verification Code';
        $bodyContent = ' <table style="width: 100%; font-family: sans-serif;">
    <tbody>
        <tr>
            <td align="center">
                <table style="max-width: 600px;">
                    <tr>
                        <td align="center">
                            <a href="#" style="font-size: 35px; color: black; text-decoration: none; ">Gflow Computers</a>
                            
                        </td>
                    </tr>

                    <tr>
                        <td align="center">
                            <h1 style="font-size: 25ps; font-weight: bold; line-height: 45px;">Gflow Verification Code</h1>
                            <p style="margin-bottom: 24px;">You can Copy this Code </p>
                            <div>
                                <button  style="display: inline-block; background-color: #ffcc00; color: white; border-radius: 8px;
                                padding: 15px; text-decoration: none;">
                                    <span> '.$code.' </span>
                                </button>
                            </div>
                            <p style="margin-top: 24px;">If you didin\'t reqested to verification code, please ignore this email</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td align="center">
                            <p>&copy 2024 Gflow Computers.lk</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table> ';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo 'Verification Code sending failed';
        }else{
            echo 'Success';
        }

    }else{
        echo("Invalid Email Address");
    }

}else{
    echo("Please enter your Email Address in Email Field");
}


?>