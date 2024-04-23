<main>
  <div class="background-image">
    <div class="background-content">
      <h1 class="background-title">SRKR Engineering College</h1>
      <p class="background-text">To emerge as a world-class technical institution that strives for the socio-ecological well-being of the society.</p>
      <a href="#" class="download-btn">NAAC Grade</a>
      <a href="#" class="whats-new-btn">What's New</a>
    </div>

    <div class="form-container">
      <div id="outerContainer">
        <div class="select-left" id="container">
          <div id="item"></div>
          <div class="left">
            <span>Student</span>
          </div>
          <div class="right">
            <span>Teacher</span>
          </div>
        </div>
      </div>

      <div id="studentLogin" class="login-form" style="display:none;">
        <br>
        <h2>Student Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label for="studentUsername">Username:</label>
          <input type="text" id="studentUsername" name="studentUsername">
          <label for="studentPassword">Password:</label>
          <input type="password" id="studentPassword" name="studentPassword">
          <!-- add forgot password here  -->
          <a href="forgot_password1.php">Forgot Password?</a>
          <br>
          <br>
          <input type="submit" name="student_login" value="Login">
          <?php
          if (!empty($studentLoginError)) {
              echo "<p class='error'>$studentLoginError</p>";
          }
          ?>
        </form>
      </div>

      <div id="teacherLogin" class="login-form" style="display: none;">
        <br>
        <h2>Teacher Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label for="teacherUsername">Username:</label>
          <input type="text" id="teacherUsername" name="teacherUsername">
          <label for="teacherPassword">Password:</label>
          <input type="password" id="teacherPassword" name="teacherPassword">
          <a href="forgot_password1.php">Forgot Password?</a>
          <br>
          <br>
          <input type="submit" name="teacher_login" value="Login">
          <?php
          if (!empty($teacherLoginError)) {
              echo "<p class='error'>$teacherLoginError</p>";
          }
          ?>
        </form>
      </div>
    </div>
  </div>

  <div class="body-content"></div>
</main>
