<?php
function isAdminLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    ;

    if ($_SESSION['Username'] === "admin") {

        return true;

    }

    return false;

}
function isUserLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    ;

    if (isset($_SESSION['Username'])) {

        return true;

    }

    return false;

}
function sendLog($messaggio)
{

    $token = $_ENV['LOG_BOT_TOKEN'];
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=@" . $_ENV['LOG_CHANNEL_HANDLE'];
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function sendImage()
{
    $chat_id = "@testelevateme";
    $bot_url = "https://api.telegram.org/bot1503751150:AAHd291edwngr48hu4D4WXC2eCy05KArkmY/";
    $url = $bot_url . "sendPhoto?chat_id=" . $chat_id;

    $post_fields = array('chat_id' => $chat_id,
        //IMAGE PATH FROM WHERE YOU CALL THE FUNCTION, NOT PATH FROM HERE
        'photo' => new CURLFile(realpath("path/to/image")),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data",
    ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $output = curl_exec($ch);

}
function register_users_online()
{
    global $pdo;
    if (!isset($_SESSION)) {
        session_start();
    }

    include "db.php";
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $sql = "SELECT * FROM users_online WHERE session = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$session]);
    if ($stmt->rowCount() > 0) {
        $sql = "UPDATE users_online SET time= ?   WHERE session=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$time, $session]);
    } else {
        $sql = "INSERT INTO users_online(session, time) VALUES(?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$session, $time]);
    }
    $sql = "SELECT * FROM users_online WHERE time > ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$time_out]);
    $count_user = $stmt->rowCount();
    $_SESSION["users_online"] = $count_user;

};

function get_users_online()
{
    global $pdo;
    if (!isset($_SESSION)) {
        session_start();
    }

    include "db.php";
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $time = time();
    $time_out_in_seconds = 180;
    $time_out = $time - $time_out_in_seconds;
    $sql = "SELECT * FROM users_online WHERE time > ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$time_out]);
    $count_user = $stmt->rowCount();
    $_SESSION["users_online"] = $count_user;

};
function phone_exists($phone)
{
    global $pdo;
    global $stmt;
    $sql = "SELECT * FROM users WHERE  users.phone =? ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$phone]);

    if ($stmt->rowCount() > 0) {

        return true;

    } else {

        return false;

    }
}
function login_exists($username)
{
    global $pdo;
    global $stmt;
    $sql = "SELECT * FROM users WHERE  users.username =? OR users.email=? LIMIT 1 ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$username, $username]);

    if ($stmt->rowCount() > 0) {

        return true;

    } else {

        return false;

    }
}

function showErrorSuccess()
{

    if (isset($_GET["error"])) {echo "<p style='color:#f57f7f'>" . $_GET["error"] . "</p>";}
    if (isset($_GET["success"])) {echo "<p style='color:#92dc7f'>" . $_GET["success"] . "</p>";}
    ;

}

function pher_exists($username)
{
    global $pdo;
    global $stmt;
    $sql = "SELECT * FROM phers WHERE  phers.username =? ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {

        return true;

    } else {

        return false;

    }
}

function pre_gher_exists($username)
{
    global $pdo;
    global $stmt;
    $sql = "SELECT * FROM pre_ghers WHERE  pre_ghers.username =? ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {

        return true;

    } else {

        return false;

    }
}

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}

function sendMessage($messaggio)
{
    try {
        $token = array("1503751150:AAHd291edwngr48hu4D4WXC2eCy05KArkmY", "1607755162:AAEXssf9crQFbUl0H1Friqj1TPZjpnuIuh0", "1446936359:AAGVMZIcSPEVOzfgLw_AqgnMpJ81kvTTQ9I",
            "1637388954:AAHt-QaS8wa4F3Nil447Ygi4IVatb3tFuV8", "1636119032:AAE_qNNBG79N2WZoI7_6gxI1P4TuWmJ6Mg0",
        );
        $max_number = count($token) - 1;
        $selected_token_number = rand(0, $max_number);
        $selected_token = $token[$selected_token_number];
        $url = "https://api.telegram.org/bot" . $selected_token . "/sendMessage?chat_id=@testelevateme";
        // $url = "https://api.telegram.org/bot" . $selected_token . "/sendMessage?chat_id=@elevatemenow";
        $url = $url . "&text=" . urlencode($messaggio);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        throw new Exception("Error Processing Request", 1);

        return $result;

    } catch (Exception $e) {

    }

}

function redirect($location)
{

    header("Location:" . $location);
    exit();

}

function ifItIsMethod($method = null)
{

    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

        return true;

    }

    return false;

}

function isLoggedIn()
{

    if (isset($_SESSION['user_role'])) {

        return true;

    }

    return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null)
{

    if (isLoggedIn()) {

        redirect($redirectLocation);

    }

}

function escape($string)
{

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));

}

function set_message($msg)
{

    if (!$msg) {

        $_SESSION['message'] = $msg;

    } else {

        $msg = "";

    }

}

function display_message()
{

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

}

function users_online()
{

    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {

            session_start();

            include "../includes/db.php";

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == null) {

                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");

            } else {

                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);

        }

    } // get request isset()

}

// users_online();

function confirmQuery($result)
{

    global $connection;

    if (!$result) {

        die("QUERY FAILED ." . mysqli_error($connection));

    }

}

function insert_categories()
{

    global $connection;

    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {

            echo "This Field should not be empty";

        } else {

            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");

            mysqli_stmt_bind_param($stmt, 's', $cat_title);

            mysqli_stmt_execute($stmt);

            if (!$stmt) {
                die('QUERY FAILED' . mysqli_error($connection));

            }

        }

        mysqli_stmt_close($stmt);

    }

}

function findAllCategories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";

        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }

}

function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");

    }

}

function UnApprove()
{
    global $connection;
    if (isset($_GET['unapprove'])) {

        $the_comment_id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
        $unapprove_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");

    }

}

function is_admin($username)
{

    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);

    if ($row['user_role'] == 'admin') {

        return true;

    } else {

        return false;
    }

}

function checkEmail($email)
{
    $find1 = strpos($email, '@');
    $find2 = strpos($email, '.');
    return ($find1 !== false && $find2 !== false && $find2 > $find1);
}

function email_exists($email)
{
    global $pdo;
    global $stmt;
    $sql = "SELECT * FROM users WHERE  users.email =? ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {

        return true;

    } else {

        return false;

    }
}
function username_exists($username)
{
    global $pdo;
    global $stmt;
    $sql = "SELECT * FROM users WHERE  users.username =? ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {

        return true;

    } else {

        return false;

    }
}

function register_user($username, $email, $password)
{

    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}','{$email}', '{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection, $query);

    confirmQuery($register_user_query);

}

function login_user($username, $password)
{

    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));

    }

    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        if (password_verify($password, $db_user_password)) {

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            redirect("/cms/admin");

        } else {

            return false;

        }

    }

    return true;

}
