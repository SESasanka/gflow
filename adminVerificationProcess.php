<?php

include "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){

    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num > 0){

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `vcode`='".$code."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sasankaakash22@gmail.com';
        $mail->Password = 'wdamnqgzoegdghhg';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('sasankaakash22@gmail.com', 'Admin Verification');
        $mail->addReplyTo('sasankaakash22@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Gflow Admin Login Verification Code';
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
                            <h1 style="font-size: 25ps; font-weight: bold; line-height: 45px;">Gflow Admin Verification Code</h1>
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
        echo("You are not a valid user.");
    }

}else{
    echo ("Email field should not be empty.");
}



?>