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
  <h1>XSS Challenge 07 (Perform DOM based XSS on this page.  Note: The XSS payload is not sent to the server.) Wow I didn't know you could do that....</h1>
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
    <h1>DOM XSS Over HTTP GET Request</h1>
    <p>All XSS on this page is on the client browser only </p>
	<p>Note the XSS payload is not sent to the server. View this via the ZAP proxy.</p>
	<p>http://localhost/lab/Lab07.php?x=1#123</p>

	


  </div> 
  
  <div class="column content">
  
	<!-- But But But.... I don't see any php. Well that's just amazing.  -->
	
	<script>
    //https://stackoverflow.com/questions/2794137/sanitizing-user-input-before-adding-it-to-the-dom-in-javascript
    function sanitize(string) {
      const map = {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#x27;',
          "/": '&#x2F;',
          "(": '&#x00028;',
          ')': '&#x00029;',
          '{': '&lcub;',
          '}': '&rcub;'
      };
      const reg = /[&<>"'/]/ig;
      return string.replace(reg, (match)=>(map[match]));
  }

	var hashvalue = sanitize(location.hash.substring(1));

	document.write(hashvalue);
	document.write("<br>");
	document.write(decodeURI(hashvalue));
	</script>
	
	</div>
	
</div>

<div class="footer">
  <p>Break me first then try fix me....</p>
</div>

</body>
</html>


