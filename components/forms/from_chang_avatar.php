<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["change_profile_value"])) {
    $navbar->setProfileImage($_POST["change_profile_value"]);
}


?>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div>form change avatar</div>
<input type="text" name="change_profile_value" />
<button type="submit" class="bg-gray-600 px-4 rounded-md text-white">submit</button>
</form>