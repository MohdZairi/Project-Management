<h3>
    <?php
        if($_SESSION["userid"])
        {
            echo $_SESSION["name"];
        }
    ?>

    <a href="logout.php">Logout</a><br>
</h3>
<p> Welcome <?php echo $_SESSION["role"]; ?></p>

<ul class="nav nav-tabs">

<?php if($_SESSION["role"] == 'manager')
    {
?>
        <li id="clients" class="active"><a href="clients.php">Clients</a></li>
        <li id= "projects"><a href="project.php">Project</a></li>

<?php } ?>

<?php if($_SESSION["role"] == 'employee')
    {
?>
        <li class="active"><a href="tasks.php">Tasks</a></li>

<?php } ?>

</ul>
