<?php
include_once("functions.php");
if (isset($_POST['submit'])) {
   if ($_POST['submit'] == "add_brand") {
      brand($_POST["task"], $_POST["id"], $_POST["brand"], $_POST["tagline"], $_POST["value"], $_POST["type"], $_POST["code"], $_POST["url"], $_POST["rating"], $_POST["description"], $_POST["terms"], $_FILES["img"]["tmp_name"]);
   }
   else if ($_POST['submit'] == "add_admin") {
      user($_POST["task"], $_POST["id"], $_POST["fname"], $_POST["lname"], $_POST["username"], $_POST["password"]);
   }
   else if ($_POST['submit'] == "signin") {
      sign_in($_POST["user"], $_POST["pass"]);
   }
}
if (isset($_GET["delete"])) {
   delete($_GET["table"],$_GET["delete"]);
}
?>
