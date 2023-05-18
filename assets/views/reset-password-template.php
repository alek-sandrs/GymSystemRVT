<div class="wrapper"> 
    <div class="welcome-container">
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
        <h1 class="welcome-heading">Reset password</h1>
        <p class="welcome-buttons">
            <div class="edit-form">
                <form action="/profile/reset-password" method="POST">
                    <input type="password" name="password" placeholder="New Password">
                    <input type="password" name="confirm-password" placeholder="Confirm New Password">
                    <input type="submit" value="Submit">
                </form>
            </div>
        </p>
    </div>
</div>