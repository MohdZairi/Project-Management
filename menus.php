<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar -toggle collapsed" data-toggle="collapse" data_target="#navbar" aria-expanded="false" aria-control="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://www.phpzag.com/">PHPZAG.COM</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
	  <ul class="nav navbar-nav">
		<li class="active"><a href="index.html">Dashboard</a></li>		
	  </ul>
	  <?php if(!empty($_SESSION["userid"])) { ?>
	  <ul class="nav navbar-nav navbar-right">
		<li class="active"><a href="index.html">Welcome, <?php echo $_SESSION["name"]; ?></a></li>
		<li><a href="logout.php">Logout</a></li>          
	  </ul>
	  <?php } ?>
	</div>
    </div>
</nav>