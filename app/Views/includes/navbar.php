
<nav class="navbar navbar-expand-lg pb-5 pt-5">
    <header>
        <a href="<?= base_url().'/welcome_page' ?>" class='logo'>Shares</a>
        <nav class="navbar2">
            <div class="btn">
                <i class="fa fa-times close-btn"></i>
            </div>
            <a href="<?= base_url().'/welcome_page' ?>" class="active">Home</a>
            <a href="">About Us</a>
            <a href="<?= base_url().'/dashboard' ?>">Dashboard</a>
            <?php if (session()->has('currentLoggedInUser')) : ?>
                <a href="<?= base_url('/') ?>">Logout</a>
            <?php else: ?>
                <a href="<?= base_url().'/register' ?>">Register</a>
                <a href="<?= base_url('/') ?>">Login</a>
            <?php endif; ?>
        </nav>
        <div class="btn">
            <i class="fas fa-bars menu-btn"></i>
        </div>
    </header>
 </nav>