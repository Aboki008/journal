
<nav class="navbar navbar-expand px-3 py-3">
          <form action="#" class="d-none d-sm-inline-block">
            <div class="input-group input-group-navbar">
              <input type="text" class="form-control border-0 rounded-0" placeholder="search...">
              <button class="btn border-0 rounded-0" type="button">
                search
                <span><i class='bx bx-search' ></i></span></button>
            </div>
            </form><div class="navbar-collapse collapse">
              
            <div class="navbar-collapse collapse">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                  <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                    <img src="./account.png" class="avatar img-fluid" alt="">
                  </a>
                  <div class="dropdown-menu rounded">
                    <a href="../users.php" class="dropdown-item">
                      <i class='bx bxs-user'></i>
                      <span>Users</span>
                    </a>
                    <a href="#" class="dropdown-item">
                      <i class='bx bxs-user'></i>
                      <span>Help</span>
                    </a>
                    <form action="./../auth/logout.php" method="post">
                      <div class="dropdown-divider"></div>
                      <button type="submit" name="logout_btn" class="dropdown-item">
                        <i class='bx bxs-user'></i>
                        <span>Logout</span>
                      </button>
                    </form>

                </li>
              </ul>
            </div>

          </div>

        </nav>