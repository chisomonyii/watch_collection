<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Zeith</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Background Video & Overlay -->
  <video autoplay muted loop id="forgot-bg-video">
    <source src="./video/property-details-background-video.mp4" type="video/mp4">
  </video>
  <div class="video-overlay"></div>

  <!-- Main Container -->
  <div class="forgot-container">
    <div class="forgot-card">
      <h2 class="forgot-title">Forgot Password</h2>
      <p class="forgot-subtitle">Enter your email address to receive a password reset link</p>

      <form action="" method="POST" class="forgot-form">
        <div class="forgot-field">
          <label class="forgot-label">Email Address</label>
          <input 
            type="email" 
            name="email" 
            class="forgot-input" 
            placeholder="name@company.com" 
            required
          >
        </div>

        <button type="submit" class="forgot-button">Send Reset Link</button>
      </form>

      <p class="forgot-back">
        Remembered your password? <a href="login.php" class="forgot-link">Back to Login</a>
      </p>
    </div>
  </div>

</body>
</html>