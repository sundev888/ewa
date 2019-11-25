
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if(isset($_POST['test'])){
      if(isset($_POST['status'])){
        echo "status geändert " .$_POST['status'];
      }
    }
    ?>


  </body>
</html>
