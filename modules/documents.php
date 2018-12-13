<?php
require_once 'mhead.php';
$adminRole = false;
if (($_SESSION['user']['role'] == "sonadmin") || ($_SESSION['user']['role'] == "hospadmin") || ($_SESSION['user']['role'] == "superadmin")) {
    $adminRole = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SCPT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/users.css" type="text/css"/>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
    <link rel="apple-touch-icon" sizes="144x144" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/img/site.webmanifest">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#5bbad5">
    <style class="cp-pen-styles">@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700&subset=latin-ext");
    </style>
</head>
<body class="sidebar-is-reduced">
<main class="l-main">
        <?php include "include/nav.php"; ?>
<?php
//$conn=new PDO('mysql:host=localhost; dbname=scpt', 'sfrancis', 'Fairfield123') or die(mysql_error());
if((isset($_FILES['photo']))&&($adminRole)) {
  $name=$_FILES['photo']['name'];
  $size=$_FILES['photo']['size'];
  $type=$_FILES['photo']['type'];
  $temp=$_FILES['photo']['tmp_name'];
  //$caption1=$_POST['caption'];
  $link=$_POST['link'];
  echo __DIR__."upload/".$name;
  if(!move_uploaded_file($temp, __DIR__."/upload/".$name)){
    die("Upload failed - check the write-permissions for the upload-folder!");
  }
$query=$conn->query("INSERT INTO upload(name) VALUES('$name')");
if($query){
header("location:documents.php");
}
else{
die(mysql_error());
}
}
?>
<html>
<head>
<title>Upload and Download Files</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
</head>
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/bootstrap.js" type="text/javascript"></script>

  <script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

<style>
</style>
<body>
      <div class="row-fluid">
          <div class="span12">
              <div class="container">
    <br />
    <?php if($adminRole){ ?>
    <h1>Upload  And  Download Files</h1>
    <br />
    <br />
      <form enctype="multipart/form-data" action="" name="form" method="post">
        Select File
          <input type="file" name="photo" id="photo" /></td>
          <input type="submit" name="submit" id="submit" value="Submit" />
      </form>
    <br />
    <br />
  <?php } else { ?>
    <h1>Download Files</h1>
    <br />
    <br />
  <?php } ?>
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
      <thead>
        <tr>
          <th width="90%" align="center">Files</th>
          <th align="center">Action</th>
        </tr>
      </thead>
      <?php
      $query=$conn->query("select * from upload order by id desc");
      while($row=$query->fetch()){
        $name=$row['name'];
      ?>
      <tr>

        <td>
          &nbsp;<?php echo $name ;?>
        </td>
        <td>
          <a href="upload/<?php echo $name;?>" class="btn btn-success" download>Download</a>
        </td>
      </tr>
      <?php }?>
    </table>
  </div>
  </div>
  </div>
</body>
</html>


</main>
<footer class="py-5 bg-black">
    <div class="container">
        <p class="m-0 text-center text-white small">Copyright &copy; SCPT 2018</p>
    </div>
    <!-- /.container -->
</footer>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script src='https://use.fontawesome.com/2188c74ac9.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src="../assets/js/users.js"></script>
</body>
</html>
