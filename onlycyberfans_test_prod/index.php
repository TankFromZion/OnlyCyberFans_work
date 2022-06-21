<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>You are Free</title>
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<body class="align">

  <div class="grid">

    <form action="index.php" method="POST" class="form login">

      <div class="header">
        <?php  if (isset($_SESSION['username'])) : ?>
        
        > Welcome to the free world <strong><span style="text-transform:uppercase;"><?php echo $_SESSION['username']; ?></strong></span>
        <?php endif ?>
      </div>

      <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <?php 
              echo $_SESSION['success']; 
              unset($_SESSION['success']);
            ?>
        </div>
        <?php endif ?>

        </div>


      <div class="form__field">
        <label for="login__search"><svg class="icon">
            <use xlink:href="#icon-search"></use>
          </svg><span class="hidden">Search User</span></label>
        <input autocomplete="off" id="login__username" type="text" name="username" class="form__input" placeholder="Username" required> 
      </div>

	

      <div class="form__field">
        <input type="submit" value="Search user" name="search_user">
      </div>
      <?php if (isset($_POST['search_user'])) {
	<!--TEST DATABASE. DELETE COMMENT WHEN DEPLOYED AND CHANGE TO PROD CREDENTIALS -->
      $db = mysqli_connect('localhost', 'testEnv', 'testEnvP@$$W0rdI$Unbelievably$trong', 'testEnv');
      //$username = mysqli_real_escape_string($db, $_POST['username']);
      $username = $_POST['username'];
      $query = "SELECT * FROM users WHERE username='$username'";
      $results = mysqli_query($db, $query);
      while ($row = $results->fetch_assoc()) {
        echo $row['username']."           ";
        echo $row['email']."<br>";
    }
    }?>
    </form>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    <p class="text--center">Go back to The Matrix? <a href="index.php?logout='1'" style="color: red;">Logout</a> 
    <svg class="icon">
      <use xlink:href="#icon-arrow-right"></use>
    </svg></p>
    <?php endif ?>
    

  </div>

  <svg xmlns="http://www.w3.org/2000/svg" class="icons">
    <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
      <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
    </symbol>
  </svg>
  <canvas id="c"><canvas>
  <script src="js/matrix.js"></script>
</body>
<!-- partial -->

</body>
</html>
