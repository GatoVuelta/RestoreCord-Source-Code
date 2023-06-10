<?php
require_once 'includes/connection.php';

$result = mysqli_query($link, "SELECT max(id) FROM servers");
$row = mysqli_fetch_array($result);


$servers = number_format($row[0]);

$result = mysqli_query($link, "SELECT max(id) FROM users");
$row = mysqli_fetch_array($result);

$users = number_format($row[0]);

$result = mysqli_query($link, "SELECT max(id) FROM members");
$row = mysqli_fetch_array($result);

$members = number_format($row[0]);

mysqli_close($link);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="300x250" href="https://media.discordapp.net/attachments/1115806906565529620/1115829275736686612/Gremlins_Logo_by_alenoffline5317.png?width=200&height=200">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
  <title>Gremlins Verify</title>
  <meta name="theme-color" content="#52ef52" />
  <meta name="description" content="Gremlins Verify" />
  <meta name="og:image" content="https://i.imgur.com/zhLwuR4.png" />

  <link rel="stylesheet" href="styles/theTrendingStyle.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/css/all.css" />
</head>

<body class="bg-shinyGray overflow-x-hidden">
  <nav id="navigationBar" class="flex flex-row items-center justify-between p-6 bg-sweetBlack">
    <div class="left flex flex-row items-center ml-10 md:ml-20 text-white">
      <a href="#">Gremlins Verify</a>
    </div>
    <div class="right mr-10 md:mr-20">
      <a href="./login/" class="px-8 py-3 whitespace-no-wrap bg-blurple text-white rounded-lg text-xl font-semibold hover:bg-beautyPurple">Login</a>
    </div>
  </nav>


  <div id="container" class="flex flex-col items-center justify-center">
    <div class="flex flex-col items-center justify-center pt-40 text-center">
      <span class="text-2xl md:text-5xl font-semibold text-white"> Gremlins Verification System</span>
      <span class="text-gray-400 text-lg md:text-xl max-w-xl font-light">👽</span>
    </div>
    </head>
    <body>
      <pre>
 <div id="container" class="flex flex-col items-center justify-center">
    <div class="flex flex-row items-center justify-center mt-20 mb-10">
      <span class="text-lg text-gray-400 font-semibold">Copyright &copy; <script>document.write(new Date().getFullYear())</script> Gremlins Verify</span>
    </div>
  </div>
</body>
</html>