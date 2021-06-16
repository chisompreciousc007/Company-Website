<?php
require_once 'includes/db.php';
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//  GEt USERS
$sql = "SELECT * FROM snackbar ";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
$snackbarArr = $stmt->fetchAll();
$showStatus = !empty($snackbarArr) ? "show" : "";
function run($arr)
{
    foreach ($arr as $row) {
        if ($row->deposit) {
            echo '<br>
        ' . substr($row->username, 0, 3) . '***** deposited $' . $row->amount . '<br>
       ' . $row->time . '<br>';
        } else {
            echo '<br>
        ' . substr($row->username, 0, 3) . '***** withdrew $' . $row->amount . '<br>
       ' . $row->time . '<br>';
        }

    }
}

?>

<div id="snackbar" class="<?php echo $showStatus ?>">
<button style="background: transparent;float: right;" onclick="myFunction()">Close</button>
<marquee  direction="up" height="100%" scrollamount="4">
<?php run($snackbarArr)?>
</marquee>
</div>
<script>
function myFunction() {
    document.getElementById("snackbar").className = "";
}
</script>
<style>
#snackbar {
    visibility: hidden;
    height: 200px;
    min-width: 350px;
    width:350px;
    margin-left: -125px;
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 150px;
    bottom: 30px;
    border-bottom: 3px solid #F1D142;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.7s, fadeout 0.7s 7.5s;
    animation: fadein 0.7s, fadeout 0.7s 7.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}
</style>
