<?php
session_start();



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ncu";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$studentLoginError = $teacherLoginError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["student_login"])) {
        if(isset($_POST["studentUsername"]) && isset($_POST["studentPassword"])) {
            $studentUsername = sanitize_input($_POST["studentUsername"]);
            $studentPassword = sanitize_input($_POST["studentPassword"]);
            
            $student_sql = "SELECT * FROM student_tb WHERE Register_Number='$studentUsername' AND Password='$studentPassword'";
            $student_result = $conn->query($student_sql);

            if ($student_result && $student_result->num_rows == 1) {
                $_SESSION["username"] = $studentUsername;
                $_SESSION["user_type"] = 'student';
                
                header("Location: Student/student_dashboard.php");
                exit();
            } else {
                $studentLoginError = "Invalid username or password";
                
            }
        }
    }



    if (isset($_POST["teacher_login"])) {
        if(isset($_POST["teacherUsername"]) && isset($_POST["teacherPassword"])) {
            $teacherUsername = sanitize_input($_POST["teacherUsername"]);
            $teacherPassword = sanitize_input($_POST["teacherPassword"]);
            
            $teacher_sql = "SELECT * FROM teacher WHERE Teacher_ID='$teacherUsername' AND Date_of_Birth='$teacherPassword'";
            $teacher_result = $conn->query($teacher_sql);

            if ($teacher_result && $teacher_result->num_rows == 1) {
                $_SESSION["username"] = $teacherUsername;
                $_SESSION["user_type"] = 'teacher';
                
        header("Location: teacher/teacher_dashboard.php");
                exit();
            } else {
                $teacherLoginError = "Invalid username or password";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Blender Website</title>
  <link rel="stylesheet" href="css/login.css">
  <style>
    
  </style>
    
</head>
<body>

<header class="header">
  <div class="header-inner">
    <div class="header-left">
        <div class="logo">
            <img src="srkrlogo.png" alt="Blender Logo">
          </div>
    </div>
    <div class="header-right">
        <!-- <nav class="nav">
            <ul class="nav-list">
              <li><a href="#">Student</a></li>
              <li><a href="#">Teacher</a></li>
              <li><a href="#">Support</a></li>
              <li><a href="#">Naac Grade</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#"></a></li>
            </ul>
      
          </nav> -->
          <div class="cta">
            <!-- <button class="btn signup">Sign Up</button> -->
            <button class="btn signin">Sign In</button>
          </div>
    </div>
  </div>
</header>



<main>
  <div class="background-image">
    <div class="background-content">
        <h1 class="background-title">SRKR Engineering College</h1>
        <p class="background-text">To emerge as a world-class technical institution that strives for the socio-ecological well-being of the society.</p>
        <a href="#" class="download-btn">NAAC Grade</a>
        <a href="#" class="whats-new-btn">What's New</a>
    </div>



    <div class="form-container" style="display:none;">
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

  <div class="body-content">


  </div>
</main>

<footer class="footer">
  <div class="footer-inner">
    <div class="footer-column">
      <h3>Academic Data Management System (ADMS)</h3>
      <p>Empowering educational institutions with efficient student data management.</p>
      <p>Contact us: srkr@srkrec.ac.in</p>
    </div>



    <div class="footer-column">
  <h3>Knowledge Base</h3>
  <ul class="footer-links">
    <li><a href="#">FAQ</a></li>
    <li><a href="#">User Guides</a></li>
    <li><a href="#">Documentation</a></li>
  </ul>
</div>

<div class="footer-column">
  <h3>Connect with ADMS</h3>
  <p>Stay updated and engage with us:</p>
  <ul class="footer-links">
    <li><a href="#">Follow us on Twitter</a></li>
    <li><a href="#">Like us on Facebook</a></li>
    <li><a href="#">LinkedIn Page</a></li>
  </ul>
</div>

<div class="footer-column">
  <h3>Partnerships</h3>
  <p>Collaborate with us to enhance student data management:</p>
  <ul class="footer-links">
    <li><a href="#">NAAC</a></li>
    <li><a href="#">NBA</a></li>
    <li><a href="#">Other Educational Institutions</a></li>
  </ul>
</div>
</div>
</footer>



<script>
    document.querySelector('.signin').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        document.querySelector('.form-container').style.display = 'block';
        document.querySelector('.background-content').style.display = 'none';
    });

    var dragItem = document.querySelector("#item");
    var container = document.querySelector("#container");
    var studentForm = document.getElementById("studentLogin");
    var teacherForm = document.getElementById("teacherLogin");

    var isDragging = false;
    var initialX = 0;
    var xOffset = 0;
    var minOffset = 0;
    var maxOffset = 150;

    container.addEventListener("mousedown", dragStart, false);
    container.addEventListener("mousemove", drag, false);
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("mouseleave", dragEnd, false);
    container.addEventListener("click", toggleFormsOnClick, false);

    container.addEventListener("touchstart", dragStart, false);
    container.addEventListener("touchmove", drag, false);
    container.addEventListener("touchend", dragEnd, false);

    function dragStart(e) {
        e.preventDefault();
        if (e.type === "touchstart") {
            initialX = e.touches[0].clientX - xOffset;
        } else {
            initialX = e.clientX - xOffset;
        }
        isDragging = true;
    }

    function drag(e) {
        if (isDragging) {
            var x;
            if (e.type === "touchmove") {
                x = e.touches[0].clientX - initialX;
            } else {
                x = e.clientX - initialX;
            }
            xOffset = Math.min(Math.max(x, minOffset), maxOffset);
            setTranslate(xOffset);
        }
    }

    function dragEnd(e) {
        isDragging = false;
        if (xOffset > (maxOffset - minOffset) / 2) {
            xOffset = maxOffset;
            toggleForms("teacher");
        } else {
            xOffset = minOffset;
            toggleForms("student");
        }
        setTranslate(xOffset);
    }

    function setTranslate(x) {
        dragItem.style.transform = "translate3d(" + x + "px, 0, 0)";
    }

    function toggleForms(type) {
        if (type === "teacher") {
            studentForm.style.display = "none";
            teacherForm.style.display = "block";
        } else {
            studentForm.style.display = "block";
            teacherForm.style.display = "none";
        }
    }

    function toggleFormsOnClick(e) {
        if (e.clientX - container.getBoundingClientRect().left > maxOffset / 2) {
            xOffset = maxOffset;
            toggleForms("teacher");
        } else {
            xOffset = minOffset;
            toggleForms("student");
        }
        setTranslate(xOffset);
    }



    // if the teacher form is dispplayed then the student span text color should be in blue 
    // and teacher span text color should be in black

    studentForm.style.display = "block";

</script>

</body>
</html>
