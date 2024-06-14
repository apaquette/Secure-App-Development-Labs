<!DOCTYPE html>
<html>
<head>

<?php require_once 'FilterHeader.php'; ?>

</head>
<style>
* {
  box-sizing: border-box;
}

.header, .footer {
  background-color: grey;
  color: white;
  padding: 15px;
}

.column {
  float: left;
  padding: 15px;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

.menu {
  width: 25%;
}

.content {
  width: 75%;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 8px;
  background-color: #33b5e5;
  color: #ffffff;
}

.menu li:hover {
  background-color: #0099cc;
}
</style>
</head>
<body>

<div class="header">
  <h1>XSS Challenge 08 (Get a script tag to run on this page)</h1>
</div>

<div class="clearfix">
  <div class="column menu">
    <ul>
	  <li><a href="../index.php">Main Menu</a></li>
      <li><a href="lab01.php">Challenge 1</a></li>
      <li><a href="lab02.php">Challenge 2</a></li>
      <li><a href="lab03.php">Challenge 3</a></li>
      <li><a href="lab04.php">Challenge 4</a></li>
	  <li><a href="lab05.php">Challenge 5</a></li>
      <li><a href="lab06.php">Challenge 6</a></li>
      <li><a href="lab07.php">Challenge 7</a></li>
      <li><a href="lab08.php">Challenge 8</a></li>
	  <li><a href="lab09.php">Challenge 9</a></li>
      <li><a href="lab10.php">Challenge 10</a></li>
      <li><a href="lab11.php">Challenge 11</a></li>
      <li><a href="Displaying XSS Characters.html">XSS Characters Browser Display</a></li>
    </ul>
  </div>

  <div class="column content">
    <h1>Reflective XSS Over HTTP POST Request</h1>
    <p>Reflective XSS arises when a web application receives data in a HTTP request. </p>
	<p>The web application then and includes that data within the response of the page returned by the web server in an unsafe manner resulting in unintentional code being included and execuited by the browser.</p>
	<p>Note: You will have to break out of the input field of the input box to perform XSS here.

	


  </div> 
  
  <div class="column content">
  
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  Your name:<input type="text" name="TX_name" />
  <input type="submit" name="submit"/>
  
  <!-- Hummm.... So your back looking at the code AGAIN...  -->
  
  <?php
		if (isset($_POST["TX_name"])) {
		echo "<br>";
		echo  Sanitize($_POST["TX_name"]);
		}
	?>
	</div>
	
</div>

<div class="footer">
  <p>Break me first then try fix me....</p>
</div>

</body>
</html>


