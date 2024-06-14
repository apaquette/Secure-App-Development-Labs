<!DOCTYPE html>
<html>
<head>

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
  <h1>Penetration Testing</h1>
</div>

<div class="clearfix">
  <div class="column menu">
    <ul>
      <li><a href="bvb/lab.php">Browser Validation Bypass</a></li>
      <li><a href="XSS/">XSS</a></li>
      <li><a href="CI/lab.php">Command Injection</a></li>
	  <li><a href="FI/lab.php">File Inclusion</a></li>
      <li><a href="CSRF/lab.php">Cross Site Request Forgery</a></li>
      <li><a href="SSRF/lab.php">Server Side Request Forgery</a></li>
      <li><a href="PT/lab.php">Path Traversal</a></li>
	  <li><a href="HTTP_RS/lab.php">HTTP Response Splitting</a></li>
      <li><a href="Session/lab.php">Sessions</a></li>
      <li><a href="SQLi/lab.php">SQLi</a></li>
    </ul>
  </div>

  <div class="column content">
    <h1>Penetration Testing</h1>
    <p></p>
	<p></p>
	<p>

  </div> 
  
  <div class="column content">
	</div>
	
</div>

<div class="footer">
  <p>Break me first then try fix me....</p>
</div>

</body>
</html>


