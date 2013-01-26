Hi, Please log in.
<br />

<form action="" method="post">
    <label>Username:
        <input type="text" name="username" value="" />
    </label>
    <label>Password:
        <input type="password" name="password" value="" />
    </label>
    <input type="submit" value="Log In!" />
</form>

<h2>
<a href="<?php
echo $GLOBALS["registry"]->utils->makeLink("Register", "register");
?>">Register</a>
</h2>