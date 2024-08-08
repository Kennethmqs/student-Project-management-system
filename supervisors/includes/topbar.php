<!DOCTYPE html>
<div class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <h1>Student Project Management System</h1>
    </div>

    <div class="topbar-right">
        <div class="profile">
            <img src="profile.jpg" alt="Profile" class="profile-img">
            <span class="profile-name"><?php echo $_SESSION['student_name']; ?></span>
        </div>
    </div>
</div>