
<aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="./index.php">SBS Journal</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="./index.php" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="./users.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Manuscripts</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="./create_edition.php" class="sidebar-link">Create Edition</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="./submitted_manuscript.php" class="sidebar-link">Submitted Journal</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="./published_manuscript.php" class="sidebar-link">Published Journal</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <form action="../auth/logout.php" method="POST">
                <button href="#" type="submit" name="logout_btn" class="text-dark bg-0 border-o sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
</button>
                </form>
            </div>
        </aside>