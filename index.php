<?php
session_start();

// Agar user login hai → name le lo
$user_name = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>File Upload System</title>

    <!-- Font Awesome 6.5.1 (ONLY) -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!-- Animate.css -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />

    <style>
      body {
        background-color: #e8f5e9;
        font-family: "Poppins", sans-serif;
      }

      .navbar {
        background-color: #1b5e20;
      }

      .navbar-brand,
      .nav-link,
      .footer-text {
        color: white !important;
      }

      .hero {
        background: linear-gradient(135deg, #1b5e20, #43a047);
        color: white;
        padding: 60px 20px;
        text-align: center;
      }

      .upload-container {
        max-width: 500px;
        margin: 50px auto;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        display: none;
      }

      .upload-header {
        background-color: #1b5e20;
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
        text-align: center;
        font-weight: bold;
      }

      .footer {
        background-color: #1b5e20;
        color: white;
        text-align: center;
        padding: 15px;
        margin-top: 80px;
      }

      #file-name,
      #statusMsg {
        margin-top: 10px;
        font-weight: 500;
      }

      .btn-attractive {
        background: linear-gradient(135deg, #2e7d32, #66bb6a);
        color: white;
        font-weight: 600;
        border: none;
        padding: 12px 28px;
        font-size: 16px;
        border-radius: 30px;
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
        z-index: 1;
      }

      .btn-attractive:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      }

      .dark:hover {
        background: black;
      }

      .btn-attractive::before {
        content: "";
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        z-index: 0;
        transition: left 0.4s ease;
      }

      .btn-attractive:hover::before {
        left: 0;
      }
      .login {
        background: linear-gradient(135deg, #2e7d32, #66bb6a);
        color: white;
        font-weight: 600;
        border: none;
        padding: 12px 28px;
        font-size: 16px;
        border-radius: 30px;
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
        z-index: 1;
        margin-right: 10px;
      }
      .login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      }

      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
      }
    </style>
  </head>
  <body>
    <div class="container-fluid bg-success py-0">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <h4 class="text-white f-16 top-text mb-0 fs-6">
            <i class="fas fa-map-marker-alt"></i> Jaipur,Rajasthan
          </h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 text-end">
          <div
            class="d-inline-flex align-items-center justify-content-end w-100 flex-wrap"
          >
            <span class="me-3">
              <a href="#"><i class="fab fa-facebook text-warning me-2"></i></a>
              <a href="#"><i class="fab fa-linkedin text-warning me-2"></i></a>
              <a href="#"><i class="fab fa-instagram text-warning me-2"></i></a>
            </span>
            <span class="text-white me-3">
              <a href="#" style="color: yellow">
                </a>
            </span>



            <?php if ($user_name): ?>
  <span class="text-white me-2">👋 Hello, <?php echo htmlspecialchars($user_name); ?></span>
  <a href="logout.php"><button class="login"id="themeToggle" class="btn-attractive btn-sm dark">Logout</button></a>
<?php else: ?>
  <a href="login.html"><button class="login">Login/Register</button></a>
<?php endif; ?>





            <button id="themeToggle" class="btn-attractive btn-sm dark">
              🌙 Dark Mode
            </button>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.html">📁 <strong>Uplonix</strong></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarMenu"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link nav-hover" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-hover" href="about.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-hover" href="contact.html">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="hero">
    <?php if(isset($user_name)) { ?>
        <h3>Hello, <?php echo htmlspecialchars($user_name); ?> 👋</h3>
    <?php } ?>
    <h1>Welcome to File Upload System</h1>
    <p></p>
    
    
    <p>Click below to upload your files </p>
    <button id="showUpload" class="btn-attractive mt-3">Upload File</button>
</div>


    <div class="upload-container" id="uploadBox">
      <div class="upload-header">File Upload Panel</div>
      <form id="uploadForm" class="mt-4" enctype="multipart/form-data" method="POST" action="upload.php">

        <div class="mb-3">
          <label for="fileInput" class="form-label"
            >Select a file to upload:</label
          >
          <input
            class="form-control"
            name="fileInput"
            type="file"
            id="fileInput"
            accept=".pdf,.doc,.jpg,.png,.txt"
          />
          <div id="file-name" class="text-success"></div>
        </div>
        <button type="submit" class="btn-attractive w-100">Upload File</button>
        <div id="statusMsg" class="text-center mt-2"></div>
      </form>
    </div>

    <div
      class="progress mt-3"
      style="height: 20px; display: none"
      id="uploadProgressBox"
    >
      <div
        id="uploadProgress"
        class="progress-bar progress-bar-striped progress-bar-animated bg-success"
        style="width: 0%"
      ></div>
    </div>

    

    <div class="text-center mt-3">
    <a href="view.php" class="btn btn-success" style="background-color: #90ee90; color: black; width: 200px;"><b>View Uploaded Files</b></a>
</div>


    <div class="progress mt-3 d-none" id="uploadProgress">
      <div
        class="progress-bar progress-bar-striped bg-success"
        role="progressbar"
        style="width: 0%"
        id="progressBarText"
      ></div>
    </div>

    <section class="container my-4">
      <h3 class="text-center text-success mb-4">Why Choose Us?</h3>
      <div class="row text-center">
        <div class="col-md-4">
          <i class="fas fa-shield-alt fa-3x text-success mb-2"></i>
          <h5>Secure Uploads</h5>
          <p>End-to-end encrypted file handling</p>
        </div>
        <div class="col-md-4">
          <i class="fas fa-clock fa-3x text-success mb-2"></i>
          <h5>Fast Processing</h5>
          <p>Quick and reliable file management</p>
        </div>
        <div class="col-md-4">
          <i class="fas fa-thumbs-up fa-3x text-success mb-2"></i>
          <h5>User Friendly</h5>
          <p>Simple interface with responsive layout</p>
        </div>
      </div>
    </section>

    <section class="bg-light text-center py-3">
      <h3 class="text-success mb-4">What Our Users Say</h3>
      <div class="container">
        <div class="row py-3">
          <div class="col-md-4">
            <blockquote class="blockquote bg-white p-3">
              <img src="download m.png" alt="User 1" />
              <p>"Easy and fast. Great for sharing large files!"</p>
              <footer class="blockquote-footer">Rahul Sharma</footer>
            </blockquote>
          </div>
          <div class="col-md-4">
            <blockquote class="blockquote bg-white p-3">
              <img src="downloadf.jpg" alt="User 2" />
              <p>"Simple UI and secure uploads. Love it!"</p>
              <footer class="blockquote-footer">Priya Singh</footer>
            </blockquote>
          </div>
          <div class="col-md-4">
            <blockquote class="blockquote bg-white p-3">
              <img src="download m.png" alt="User 3" />
              <p>"Best file uploader I've used so far."</p>
              <footer class="blockquote-footer">Amit Kumar</footer>
            </blockquote>
          </div>
        </div>
      </div>
    </section>

    <footer class="text-light pt-5 pb-4" style="background-color: #003300">
      <div class="container text-md-left">
        <div class="row text-md-left">
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
              Uplonix
            </h5>
            <p>
              Uplonix is a secure and easy-to-use file upload system for
              storing, sharing, and managing documents efficiently.
            </p>
          </div>
          <div class="col-md-3">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
              Quick Links
            </h5>
            <p><a href="#" class="text-light text-decoration-none">Home</a></p>
            <p>
              <a href="#" class="text-light text-decoration-none">Upload</a>
            </p>
            <p>
              <a href="contact.html" class="text-light text-decoration-none">Contact</a>
            </p>
            <p>
              <a href="#" class="text-light text-decoration-none"
                >Privacy Policy</a
              >
            </p>
          </div>
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4 font-weight-bold text-warning">
              Contact
            </h5>
            <p>
              <a href="#" style="color: white"
                ><i class="fas fa-envelope me-2"></i>uplonix@gmail.com</a
              >
            </p>
            <p><i class="fas fa-phone me-2"></i> +91 9876543210</p>
            <p>
              <i class="fas fa-map-marker-alt me-2"></i>Jaipur,Rajasthan,India
            </p>
          </div>
        </div>
        <hr />
        <div class="row align-items-center">
          <div class="col-md-8">
            <p>
              © 2025 UploadSys. All Rights Reserved. | Designed by
              <strong
                ><span style="color: yellow"> Nityanand Raj </span>
                <span style="color: white">Piyush</span>
                <span style="color: yellow">Neel</span> Mukul</strong
              >
            </p>
          </div>
          <div class="col-md-4 text-end">
            <a href="#" class="text-warning me-3"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a href="#" class="text-warning me-3"
              ><i class="fab fa-twitter"></i
            ></a>
            <a href="#" class="text-warning"
              ><i class="fab fa-linkedin-in"></i
            ></a>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Upload Logic -->
    <script>
  // PHP → JS me login status bhejna
  var isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;

  const fileInput = document.getElementById("fileInput");
  const fileName = document.getElementById("file-name");
  const statusMsg = document.getElementById("statusMsg");
  const form = document.getElementById("uploadForm");
  const uploadBox = document.getElementById("uploadBox");
  const showUploadBtn = document.getElementById("showUpload");

  // 👇 Upload button click event
  showUploadBtn.addEventListener("click", () => {
    if (!isLoggedIn) {
      // Agar login nahi → login.php bhejo
      window.location.href = "login.html?redirect=upload";
    } else {
      // Agar login hai → upload box dikhao
      uploadBox.style.display = "block";
      uploadBox.classList.add("animate__animated", "animate__fadeInUp");
      window.scrollTo({ top: uploadBox.offsetTop - 40, behavior: "smooth" });
    }
  });

  // File select hone pe naam show karna
  fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
      fileName.textContent = `📄 Selected: ${fileInput.files[0].name}`;
      statusMsg.textContent = "";
    } else {
      fileName.textContent = "";
    }
  });

  // AJAX upload submit
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    const file = fileInput.files[0];
    if (!file) {
      statusMsg.textContent = "⚠️ Please select a file first!";
      statusMsg.style.color = "red";
      return;
    }

    const formData = new FormData();
    formData.append("fileInput", file);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "upload.php", true);

    const progressBox = document.getElementById("uploadProgressBox");
    const progressBar = document.getElementById("uploadProgress");
    progressBox.style.display = "block";

    xhr.upload.onprogress = function (e) {
      const percent = Math.round((e.loaded / e.total) * 100);
      progressBar.style.width = percent + "%";
      progressBar.innerText = percent + "%";
    };

    xhr.onload = function () {
      if (xhr.status === 200) {
        statusMsg.textContent = xhr.responseText;
        statusMsg.style.color = "green";
      } else {
        statusMsg.textContent = "❌ Upload failed!";
        statusMsg.style.color = "red";
      }
    };

    xhr.send(formData);
  });

  // Theme toggle
  const themeToggle = document.getElementById("themeToggle");
  themeToggle.addEventListener("click", () => {
    document.body.classList.toggle("bg-dark");
    document.body.classList.toggle("text-white");
  });

  // Drag & drop upload
  const dropzone = document.getElementById("dropzone");
  const input = document.getElementById("fileUpload");
  dropzone.addEventListener("click", () => input.click());
  dropzone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropzone.classList.add("bg-light");
  });
  dropzone.addEventListener("dragleave", () => {
    dropzone.classList.remove("bg-light");
  });
  dropzone.addEventListener("drop", (e) => {
    e.preventDefault();
    input.files = e.dataTransfer.files;
    dropzone.classList.remove("bg-light");
  });
</script>










  </body>
</html>