<div class="wrapper">
    <div class="send-center">
        <h2>Login</h2>
        <p>Please fill this form to create an account.</p>
            <?php
            if (isset($_SESSION['message'])) {
                echo '
                    <div class = "msg-cover">
                        <p class="msg"> ' . $_SESSION['message'] .'</p>
                    </div>';
            }
            unset($_SESSION['message']);
            ?>
            <?php
            if (isset($_SESSION['error'])) {
                echo '
                    <div class = "err-cover">
                        <p class="err"> ' . $_SESSION['error'] .'</p>
                    </div>';
            }
            unset($_SESSION['error']);
            ?>
        <form action="/login" method="POST">
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
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Don't have an account? <a href="/registration">Register here</a>.</p>
        </form>
    </div>
</div>    