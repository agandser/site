<?
include ('inc/connect.php');
include ('inc/functions.php');


if($_GET['action'] == "out") {
    out();
}

if (login()) {
  $UID = $_SESSION['id'];
} else {
    if(isset($_POST['log_in'])) {
        $error = enter();
      
        if (count($error) == 0) {
            $UID = $_SESSION['id'];
            $admin =is_admin($UID);
        }
    }
}
if($UID) {
    include ('form.php');
}

?>
