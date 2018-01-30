<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Growth Gen</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <!--<a class="navbar-brand" href="#">Logo</a>-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav hidden">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
        <?php if(isset($_SESSION['login']) && $_SESSION['login']==1){ ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
        <?php } ?>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
<!--      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>-->
    </div>
    <div class="col-sm-8 text-left"> 
        <h1><?php echo $message; ?></h1>
     
  <h2>Create Ads</h2>
  <form action="home.php" method="post">
    <div class="form-group">
      <label for="email">Select Campaign:</label>
      <select class="form-control" id="campaign" name="campaign" required="">
        <option value="">Select Campaign</option>
        <?php
        foreach ($data->get_campaigns($accountid) as $val)
        {
            ?>
        <option value="<?php echo $val->getId(); ?>"><?php echo $val->getName(); ?></option>
        <?php
        }
        ?>
        
        </select>
    </div>
    <div class="form-group">
      <label for="pwd">Adgroup Name:</label>
      <input type="text" class="form-control" id="pwd" placeholder="AdGroup Name" required name="adgroup_name">
    </div>
    
    <div class="form-group">
      <label for="pwd">Headline 1:</label>
      <input type="text" class="form-control" id="pwd" placeholder="" name="head1" required>
    </div>
    <div class="form-group">
      <label for="pwd">Headline 2:</label>
      <input type="text" class="form-control" id="pwd" placeholder="" name="head2" required>
    </div>
    <div class="form-group">
      <label for="pwd">Description:</label>
      <input type="text" class="form-control" id="pwd" placeholder="" name="desc" required>
    </div>
    <div class="form-group">
      <label for="pwd">Final URL:</label>
      <input type="text" class="form-control" id="pwd" placeholder="http://www.example.com" name="finurl" required>
    </div>
    <div class="form-group">
      <label for="pwd">Path 1:</label>
      <input type="text" class="form-control" id="pwd" placeholder="" name="path1" required>
    </div>
    <div class="form-group">
      <label for="pwd">Path 2:</label>
      <input type="text" class="form-control" id="pwd" placeholder="" name="path2" required>
    </div>
    
    
    <button type="submit" class="btn btn-default" name="submit">Create Ads</button>
  </form>

    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <!--<p>ADS</p>-->
      </div>
      <div class="well">
        <!--<p>ADS</p>-->
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center ">
  <!--<p>Footer Text</p>-->
</footer>

</body>
</html>
