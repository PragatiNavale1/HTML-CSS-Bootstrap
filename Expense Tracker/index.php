<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Simple E-Commerce</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/login.css" class="css">
  
</head>
<body>
  <!-- Navbar -->
  <nav>
    <div class="logo"><h4></h4>Expenses Tracker</h4></div>
    <ul class="nav-links">
      <button id="theme-toggle">🌙 Dark Mode</button>
      <li><a href="#home">Home</a></li>
      <li><a href="#features">Features</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <header class="hero" id="home">
    <section>
        <h1>Expenses Made Easy </h1>
        <p>Welcome to Your Personalized Expences tracker</p>
        <div class="btn-container">
      <button class="btn" onclick="openPopup('loginPopup')">Login</button>
      <button class="btn" onclick="openPopup('registerPopup')">Register</button>
    </div>
    </section>
    <section>
        <img src="images/home.jpeg" alt="Product 1" />
    </section>
    
  </header>

  <!-- Featured Products Section -->
  <section class="featured-products" id="features">
    <h2>Featured Products</h2>
    <div class="product-container">
      <div class="product">
        <img src="images/Feature1.jpeg" alt="Product 1" />
        <h3>Excellent Support</h3>
        <p></p>
        
      </div>
      <div class="product">
        <img src="images/Feature2.jpeg" alt="Product 2" />
        <h3>Best Services</h3>
        <p></p>
      </div>
      <div class="product">
        <img src="images/Feature3.jpeg" alt="Product 3" />
        <h3>Identify Spending Patterns</h3>
        <p></p>
      </div>
    </div>
  </section>

 

<!-- Contact Us -->
<section class="contact" id="contact">
    <h2>Contact Us</h2>
    <form>
        <input type="text" placeholder="Your Name" required />
        <input type="email" placeholder="Your Email" required />
        <textarea placeholder="Your Message" rows="4" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</section>
<!-- Login Popup -->
    <div class="popup" id="loginPopup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('loginPopup')">×</span>
        <h2>Login</h2>
        <form action="dashboard.php" method="">
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
        <form action="register.php" method="post">
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
          <input type="submit" value="Register" name="register" class="submit-btn">
        </form>
      </div>
    </div>


  <!-- Footer -->
  <footer>
    <p>&copy; 2025 E-Shop. All rights reserved.</p>
  </footer>


  <script>
       const toggleButton = document.getElementById("theme-toggle");
const body = document.body;

// Check for saved theme preference
if (localStorage.getItem("theme") === "dark") {
    body.classList.add("dark-mode");
    toggleButton.textContent = "☀️ Light Mode";
}

toggleButton.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    // Save preference
    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("theme", "dark");
        toggleButton.textContent = "☀️ Light Mode";
    } else {
        localStorage.setItem("theme", "light");
        toggleButton.textContent = "🌙 Dark Mode";
    }
});
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
