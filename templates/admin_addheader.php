<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AvailableCars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
 

    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ionicons@5.0.0/dist/ionicons/ionicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>





    <nav class="navbar navbar-expand-sm navbar-light fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand brand-style">
                AvailableCars
            </a>

            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav2" aria-controls="NavbarNav2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav2">
                <ul class="navbar-nav ms-auto">
                    <nav class="navbar">
                        <ul class="navbar-nav">
                            <!-- Search bar -->
                            <li class="nav-item">
                           
    <div class="search-bar">
        <input type="text" name="query" id="search" placeholder="Search user by Name" class="search-input">
      
        <button id="searchBtn" type="submit" class="search-button"><i class="fas fa-search"></i></button>
    </div>
 
    

<div id="suggestion-box"></div>


                            </li>

                            <li class="nav-item">
                               
                                    <a href="admindashboard.php" type="submit" name="logout" class="nav-link brand-style">
                                        Home
                                    </a>
                                
                            </li>
                            <li class="nav-item">
                            
                                    <button   class="nav-link brand-style">
                                        Logout
                                    </button>
                                
                            </li>

                        </ul>
                    </nav>


                </ul>
            </div>
        </div>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="search.js"></script>
    <script src="navigate.js"></script>

