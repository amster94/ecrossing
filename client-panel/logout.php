<?php
  require_once dirname(__DIR__).'/includes/service/appvars.php';
  // If the user is logged in, delete the session vars to log them out
  session_start();
  
  // function delete_all_contents_in_folder($dirPath) {
  //   if (! is_dir($dirPath)) {
  //       return 0;
  //     }
  //     if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
  //         $dirPath .= '/';
  //     }
  //     $files = glob($dirPath . '*', GLOB_MARK);
  //     foreach ($files as $file) {
  //         if (is_dir($file)) {
  //             delete_all_contents_in_folder($file);
  //         } else {
  //             unlink($file);
  //         }
  //     }
  //     rmdir($dirPath);
  //     return 1;
  // }

  // if (isset($_SESSION['greetstore_user_email']) || isset($_SESSION['greetstore_user_name'])) {
  //   // Delete the session vars by clearing the $_SESSION array
  //   //$_SESSION = array();

  //   // Delete the session cookie by setting its expiration to an hour ago (3600)
  //   if (isset($_COOKIE[session_name()])) {
  //     setcookie(session_name(), '', time() - 3600);
  //   }

  //   // CHECK IF ORDER FOLDER SESSION EXIST AND DELETE THE FOLDER
  //   if(isset($_SESSION['order_folder']) && $_SESSION['order_folder'] !== "Email") {
  //     // GET THE USER FOLDER
  //     $user_folder = "../uploads/".$_SESSION['order_folder'];
  //     $status = delete_all_contents_in_folder($user_folder);
  //     if($status == 1) {
  //       // Success
  //     } else {
  //       // Fail Store in unDeleted Folder File
  //       // echo "Inside Wrong Path";
  //       $filepath = "../logs/undeletedFolder.txt";
  //       $file = fopen($filepath, "a") or die("Unable to open file!");
  //       $numberNewline = "\n".$user_folder ." ".$_SESSION['greetstore_user_email'];
  //       fwrite($file, $numberNewline);
  //       fclose($file);
  //       file_put_contents($filepath, implode(PHP_EOL, file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
  //     }
  //   }
  //   // Destroy the session
  //       session_destroy();
  // }

  session_destroy();
  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
  setcookie('ecrossing_client_name', '', time() - 3600);
  setcookie('ecrossing_client_email', '', time() - 3600);

  // Redirect to the home page
  $home_url = SITE_BASE_URL."login";
  header('Location: ' . $home_url);
?>