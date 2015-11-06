<?php
session_start();
if(isset($_POST["email"]) && isset($_POST["pw"])) {
  $email = $_POST["email"];
  $pw = $_POST["pw"];
  if (checklogin($email, $pw))
    $_SESSION["user"] = $email;
}

function checklogin($login,$password)
{
  // // db error checking omitted...
  // $stmt = $db->prepare("SELECT * FROM account WHERE login=?");
  // $stmt->bind_param(’s’, $login);
  // $stmt->execute();
  // $result = $stmt->get_result();
  // if (!$result || $result->num_rows==0) return false;
  // $row = $result->fetch_assoc();
  // $salt=$row["salt"];
  // $hash=$row["hash"];
  // if (hash(’ripemd128’,$password+$salt)===$hash)
  //   return true
  // else
  //   return false;
  return true;
}
