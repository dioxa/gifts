<?php
class ModelRegistration extends Model {

    public function setData($info) {

        require_once("application/core/Connect.php");

        $password = $info["password"];
        if(!empty($password)) {
            if (strlen($password) <= '8') {
                return false;
            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                return false;
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                return false;
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                return false;
            }
        } else {
            return false;
        }


        $email = $info["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            return false;
        }

        $salt = bin2hex(mcrypt_create_iv(9, MCRYPT_RAND));
        $info["password"] = hash('sha256', "$info[password]".$salt);

        if($info["month"] < 10) {
            $info["month"] = "0" . $info["month"];
        }
        if($info["day"] < 10) {
            $info["day"] = "0" . $info["day"];
        }

        $date = $info["year"].$info["month"].$info["day"];
        $role = 1;
        $createdAt = date("YmdHis");

        $instance = Connect::getInstance();
        $connection = $instance->getConnection();

        $query = $connection->prepare("INSERT INTO user (firstname, lastname, password, username, email, birthday, created_at, updated_at, role_id, salt, sex) VALUES ('$info[firstname]', '$info[lastname]', '$info[password]', '$info[login]', '$info[email]', $date, $createdAt, $createdAt, $role, '$salt', '$info[sex]')");

        $query->execute();
        //error_log( "Adding at Users".print_R($query->errorInfo(),TRUE) );
    }
}
?>