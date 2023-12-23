<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>AvailableCars</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@5.0.0/dist/ionicons/ionicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
  
<nav class="navbar navbar-expand-sm navbar-light" style="padding-right: 5%;">
 <div class="container">
    <a href="index.php" class="navbar-brand brand-style">
	    AvailableCars
    </a>
    <button type="button" 
        class="navbar-toggler" 
        data-bs-toggle="collapse" 
        data-bs-target="#navbarNav"
        aria-controls="NavbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="#" class="nav-link fas fa-envelope"></a>
          </li>
          
          
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle fas fa-user" id="navbarDropdown"
              data-bs-toggle="dropdown" aria-expanded="false">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a href="switchtodriver.php" class="dropdown-item brand-style">Switch to Driver</a></li>
              <li><a href="#" class="dropdown-item brand-style">Help</a></li>
              
              
    <button type=""  class="dropdown-item brand-style">
        Logout
    </button>
</form>

              
              
            </ul>   
          </li>
        </ul>
 </div>
</nav>
  
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>