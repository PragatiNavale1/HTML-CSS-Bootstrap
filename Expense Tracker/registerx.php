
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Popup Forms</title>
    <link rel="stylesheet" href="css/login.css" class="css">
    <style>
     
    </style>
  </head>
  <body>
    <div class="btn-container">
      <button class="btn" onclick="openPopup('loginPopup')">Login</button>
      <button class="btn" onclick="openPopup('registerPopup')">Register</button>
    </div>

    <!-- Login Popup -->
    <div class="popup" id="loginPopup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('loginPopup')">×</span>
        <h2>Login</h2>
        <form>
          <div class="form-group">
            <label for="login-email">Email:</label>
            <input type="email" id="login-email" name="email" required />
          </div>
          <div class="form-group">
            <label for="login-password">Password:</label>
            <input
              type="password"
              id="login-password"
              name="password"
              required
            />
          </div>
          <div class="form-group forgot-password">
            <a href="#">Forgot Password?</a>
          </div>
          <button type="submit" class="submit-btn">Login</button>
        </form>
      </div>
    </div>

    <!-- Registration Popup -->
    <div class="popup" id="registerPopup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('registerPopup')">×</span>
        <h2>Registration</h2>
        <form action="registration_handler.php" method="post">
          <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required />
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
          </div>
          <div class="form-group">
            <label for="mob">Mobile Number</label>
            <input type="text" id="mob" name="mob" />
          </div>
          <div class="form-group">
            <label for="occu">Occupation</label>
            <input type="text" id="occu" name="occu" />
          </div>
          <div class="form-group">
            <label>Gender:</label>
            <input type="radio" name="gender" value="male" /> Male
            <input type="radio" name="gender" value="female" /> Female
          </div>
          <div class="form-group">
            <label for="sal">Salary</label>
            <input type="text" id="sal" name="sal" />
          </div>
          <button type="submit" class="submit-btn">Register</button>
        </form>
      </div>
    </div>

    <script>
      function openPopup(id) {
        document.getElementById(id).style.display = "flex";
      }

      function closePopup(id) {
        document.getElementById(id).style.display = "none";
      }

      window.onclick = function (event) {
        let popups = document.querySelectorAll(".popup");
        popups.forEach((popup) => {
          if (event.target === popup) {
            popup.style.display = "none";
          }
        });
      };
    </script>
  </body>
</html>
