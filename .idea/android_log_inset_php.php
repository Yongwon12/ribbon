<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

include('android_log_php.php');

$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android)
{
    $email = $_POST['email'];

    if(empty($email)){
        $errMSG = "이메일을 입력하세요.";
    }


    if(!isset($errMSG)) //$errMSG가 존재하지 않았을 경우
    {
        try{ //try , catch
            $stmt = $con->prepare('INSERT INTO new_table(email)
                 VALUES(:email)');
            $stmt->bindParam(':email', $email);
            if($stmt->execute())
            {

                $successMSG = "저장성공.";
            }
            else
            {
                $errMSG = "사용자 추가 에러";
            }

        } catch(PDOException $e) { //PHP와 MySQL 연동은 성공하였으나 DB 오류가 났을때



            die("Database error: " . $e->getMessage());
        }
    }

}

?>

    <html>
<body>


<?php
if (isset($errMSG)) { //만약 $errMSG의 변수의 값이 존재할 경우
    // 자바 스크립트의 alert를 이용하여 팝업창에 $errMSG를 띄운다.
    echo   "<script>      
         alert('{$errMSG}');
         </script>";
}

if (isset($successMSG)){ //만약 $$successMSG 변수의 값이 존재할 경우
    // 자바 스크립트의 alert를 이용하여 팝업창에 $successMSG 띄운다.
    echo   "<script>      
        alert('{$successMSG}');
        </script>";
}

$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
if(!$android)
{

    ?>


    <form action="<?php $_PHP_SELF ?>" method="POST">
        <h1>회원가입 창</h1>
        <!-- 일반적인 입력 형태 -->
        <p><input type="json" name="email" id="email" placeholder="E-mail"></p>
        </select>

        <input type = "submit" name = "submit" />
    </form>
    </body>
    </html>

    <?php
}
?>