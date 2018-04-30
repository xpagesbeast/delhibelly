<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap theme -->
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Fonts / icons -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

    <!-- Reservation Calendar CSS -->
    <link href='css/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link rel='stylesheet prefetch' href='css/calendar/fullcalendar.min.css'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

    <title><?php echo $page_title; ?></title>	
    
        <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body role="document">
    
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Delhibelly</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li id="nav-home" class="nav-item ">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i><span class="space-3">Home</span> <span class="sr-only">(current)</span></a>
                </li>
                <li id="nav-reservation" class="nav-item">
                    <a class="nav-link" href="reservations.php"><i class="fas fa-calendar-alt"></i><span class="space-3">Make a Reservation</span></a>
                </li>
                <li id="nav-order" class="nav-item">

                    <a class="nav-link" href="menu.php"><i class="fas fa-utensils"></i><span class="space-3">Menu</span></a>
                </li>
                <li id="nav-history" class="nav-item">
                    <a class="nav-link" href="myorders.php"><i class="fas fa-list-alt"></i><span class="space-3">Order History</span></a>
                </li>
                <li id="nav-about" class="nav-item">
                    <a class="nav-link" href="about.php"><i class="fas fa-people-carry"></i><span class="space-3">About Us</span></a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav">
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo '<li class="nav-link" ><a  class="btn btn-outline-success my-2 my-sm-0" href="register.php">Register</a></li> ';
                    echo '<li class="nav-link " ><a class="btn btn-outline-success my-2 my-sm-0" href="login.php">Sign In</a></li>';
                }
                else
                {
                    if ($is_admin) {
                        echo '<li><a class="nav-link" href="view_users.php">View Users</a></li>';
                    }

                    echo '<li><a class="nav-link" href="password.php">Change Password</a></li>';
                    echo '<li><a class="nav-link" href="logout.php">Log Out</a></li>';
                    echo '<li class="nav-link">'.$user_name.'</a>';
                }
                ?>
                </ul>
            </form>
        </div>
    </nav>
    
    
    <div id="content" class="container-fluid theme-showcase" role="main">
          <!-- Start of the page-specific content. -->
<!-- Script 8.1 - header.html -->
