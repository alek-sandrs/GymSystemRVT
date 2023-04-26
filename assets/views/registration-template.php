<div class="wrapper">
    <div class="send-center">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
            <?php
            if (isset($_SESSION['error'])) {
                echo '
                    <div class = "err-cover">
                        <p class="err"> ' . $_SESSION['error'] .'</p>
                    </div>';
            }
            unset($_SESSION['error']);
            ?>

        <form action="/registration" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username">
                <span class="invalid-feedback"></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="/login">Login here</a>.</p>
        </form>
    </div>
</div>    