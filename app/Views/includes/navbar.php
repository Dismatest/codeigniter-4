
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand mt-2 mt-lg-0" href="<?= '/' ?>">
        <img
          src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
          height="15"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url().'/dashboard' ?>">Dashboard</a>
        </li>
      </ul>
    </div>

    <div class="d-flex align-items-center">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if(isset($userData->profile)): ?>
              <img
                      src="<?= base_url().'/uploads/'.$userData->profile ?>"
                      class="rounded-circle"
                      height="25"
                      alt="Black and White Portrait of a Man"
                      loading="lazy"
              />
              <?php else: ?>
              <img
                      src="https://images.unsplash.com/photo-1634034379073-f689b460a3fc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=580&q=80"
                      class="rounded-circle"
                      height="25"
                      alt="Black and White Portrait of a Man"
                      loading="lazy"
              />
              <?php endif ?>

          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php if(session()->has('currentLoggedInUser')) : ;?>
            <li><a class="dropdown-item d-flex justify-content-center" href="#">
                    <?= $this->renderSection('user_names'); ?>
                </a></li>
            <li><hr class="dropdown-divider"></li>
                  <div class="d-flex align-items-center p-2">
                      <i class="fa-solid fa-right-from-bracket"></i>
                      <li><a class="dropdown-item" href="<?= base_url().'/update-profile'?>">Profile</a></li>
                  </div>
                  <div class="d-flex align-items-center p-2">

                      <i class="fa-solid fa-right-from-bracket"></i>
                      <li><a class="dropdown-item" href="<?= base_url('/logout')?>">Logout</a></li>
                  </div>
              <?php else: ; ?>
                  <div class="d-flex align-items-center p-2">
                      <i class="fa-solid fa-users"></i>
                      <li><a class="dropdown-item" href="<?= base_url('/register')?>">Register</a></li>
                  </div>
              <?php endif; ?>
          </ul>
        </li>
        </ul>
      <a class="text-reset me-3" href="#">
        <i class="fas fa-bell"></i>
      </a>

    </div>
  </div>
</nav>