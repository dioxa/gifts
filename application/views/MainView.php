<?php
if(!isset($_SESSION["username"])) {
    ?>
    <div class="col-md-4">
    <form method="POST" action="/login">
        <div class="form-group">
            <label for="inputEmail3" class="control-label">Email</label>
                <input type="email" name="login" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="control-label">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-7">
                <button type="submit" class="btn btn-default">Sign in</button>
                <a href="/Registration"> Регистрация </a>
            </div>
        </div>
    </form>
        <?php
        if (isset($data)) {
            echo "<br><h3>$data</h3>";
        }
        ?>
    </div>
<?php
} else {
    header("Location:/profile/$_SESSION[username]");
}
?>
