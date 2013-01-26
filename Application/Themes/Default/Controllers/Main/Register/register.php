Hi <?php echo $this->UserName; ?>, Please register.
<br />
Choose a username for the site.
<br />We will never show your real name on this site, you will be known only by your username.

<form action="" method="post">
    <label>Username:
        <input type="text" name="username" value="" />
    </label>
    <input type="submit" value="Register!" />
</form>