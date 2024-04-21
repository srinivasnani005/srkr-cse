<?php

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ../");
    exit();

}
?>


<section id="content">
<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="search.php" method="get">
				<div class="form-group">
					<input type="text" placeholder="Search..." name="search">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>
			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a>
			<span class="divider"></span>
			<div class="profile">
                <?php
                // $username = $_SESSION['username'];
                $imageURL = "logo.png";
                echo "<img src='{$imageURL}' alt='Admin Image'>";
                ?>
                <ul class="profile-link">
                    <li><a href="_profile.php" id="profile-link" class="body-link" data-section="profile"><i class='bx bxs-user-circle icon'></i> Student Profile</a></li>
                    <li><a href="#" class="body-link" data-section="settings"><i class='bx bxs-cog'></i> Settings</a></li>
                    <li><a href="?logout=1"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
                </ul>
            </div>


		</nav>
