<div class="wrapper"> 
    <div class="welcome-container">
        <h1 class="welcome-heading">Hi, <?= $user['username']?><b></b>. Welcome to our site.</h1>
        
        <?php if ($workout) {?>
            <h3>Your current workout pack is <?= $workout['WorkoutName'] ?></h3>
        <?php } else { ?>
            <h3>You don't have an active workout pack</h3>
        <?php } ?>
        <br>
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
        <p class="welcome-buttons">
            <a href="/profile/reset-password" class="welcome-button reset-password">Reset Your Password</a>
            <a href="/logout" class="welcome-button logout">Sign Out of Your Account</a>
        </p>
    </div>
</div>