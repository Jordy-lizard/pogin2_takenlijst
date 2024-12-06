<?php require_once __DIR__.'/../../../config/config.php'; ?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/public_html/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/resources/views/taken/index.php">Taken</a>
        </nav>

        <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?php echo $base_url; ?>/resources/views/login/logout.php">Uitloggen</a>
            <?php else: ?>
                <a href="<?php echo $base_url; ?>/resources/views/login/login.php">Inloggen</a> |
                <a href="<?php echo $base_url; ?>/resources/views/registreren/register.php">Registreren</a>
            <?php endif; ?>
            
        </nav>
    </div>
</header>
