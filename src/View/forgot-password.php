<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Zeith</title>
  <link rel="stylesheet" href="<?php assets("css/login.css"); ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Background Video & Overlay -->
  <video autoplay muted loop playsinline id="bg-video">
        <source src="<?php assets("video/property-details-background-video.mp4"); ?>" type="video/mp4">
  </video>
  <div class="video-overlay"></div>

  <!-- Main Container -->
  <div class="forgot-container">
    <div class="forgot-card">
      <h2 class="forgot-title">Forgot Password</h2>
      <p class="forgot-subtitle">Enter your email address to receive a password reset link</p>

      <!-- Alerts placed nicely inside the card -->
      <?php if (isset($_GET['error']) && $_GET['error'] === 'not_found'): ?>
        <div class="alert alert-danger" style="background: #ef4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;">
            Email does not exist in our database.
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['success']) && $_GET['success'] === 'sent'): ?>
        <div class="alert alert-success" style="background: #22c55e; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;">
            Check your email inbox for the password reset link!
        </div>
      <?php endif; ?>

      <form action="/Watch_Collection/auth/forgot-password" method="POST" class="forgot-form">
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
        Remembered your password? <a href="/Watch_Collection/auth/login" class="forgot-link">Back to Login</a>
      </p>
    </div>
  </div>

</body>
</html>