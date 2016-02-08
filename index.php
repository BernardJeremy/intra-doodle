<html>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Doodle Activity Link Generator</title>
</head>
<body>
  <div style="text-align: center; font-weight: bold;">
    <p>Doodle Link Generator</p>
    <div style="text-align: center; margin-top: 2%">
      <form method="post">
        Activity Link :<br>
        <input type="text" name="link">
        <input type="submit" value="Submit">
      </form>
    </div>
    <br>
    <br>
    <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require 'get_doodle_link.php';
      }

      if (isset($error)) {
        $display = '<p style="color: red;">' . $error  . '</p>';
      } else if (isset($link)) {
        $display = '<a href="' . $link  . '" target="_blank">Create doodle !</a>';
      } else {
        $display = '<p style="color: green;">Waiting for activity link</p>';
      }
      echo $display;
    ?>
  </div>
</body>
</html>
