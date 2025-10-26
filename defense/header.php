<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Playverse Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font for gamer vibe -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: #1f1f1f;
            border-bottom: 2px solid #6f42c1;
        }
        /* 🔥 Playverse branding */
        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
        }
        .neon-brand {
            font-weight: bold;
            font-size: 1.7rem;
            color: #9b59b6 !important;
            text-shadow: 0 0 5px #9b59b6, 0 0 10px #6f42c1, 0 0 20px #9b59b6;
            letter-spacing: 1px;
        }
        .logo-icon {
            margin-right: 8px;
        }

        /* Navbar links */
        .nav-link {
            color: #f1f1f1 !important;
            transition: 0.3s;
            text-decoration: none !important;
        }
        .nav-link:hover {
            color: #6f42c1 !important;
            text-decoration: none !important;
        }

        /* Default links inside content */
        a {
            color: #9b59b6;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Buttons */
        .btn,
        .btn:hover,
        .btn-gaming,
        .btn-gaming:hover {
            text-decoration: none !important;
        }

        .auth-card {
            background: #1e1e1e;
            border: 2px solid #6f42c1;
            color: #fff;
            width: 100%;
            max-width: 450px;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(111, 66, 193, 0.7);
        }
        .btn-gaming {
            background: linear-gradient(90deg, #6f42c1, #9b59b6);
            border: none;
            color: #fff;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-gaming:hover {
            background: linear-gradient(90deg, #9b59b6, #6f42c1);
            box-shadow: 0 0 15px #9b59b6;
        }
        footer {
            background: #1f1f1f;
            color: #aaa;
            font-size: 0.9rem;
        }
        .shop-banner {
            background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
            text-align: center;
            padding: 5rem 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <!-- ✅ Updated Website Name -->
    <a class="navbar-brand neon-brand" href="index.php">
  <span class="logo-icon"></span> Playverse
</a>

<style>
.neon-brand {
    font-weight: bold;
    font-size: 1.7rem;
    color: #9b59b6 !important;
    text-shadow: 0 0 5px #9b59b6, 0 0 10px #6f42c1, 0 0 20px #9b59b6;
    letter-spacing: 1px;
    transition: 0.3s ease-in-out;
}

/* No underline + brighter glow on hover */
.navbar-brand,
.navbar-brand:hover {
    text-decoration: none !important;
}

.navbar-brand:hover {
    color: #b97fff !important; /* lighter purple */
    text-shadow: 0 0 10px #b97fff, 0 0 20px #9b59b6, 0 0 40px #b97fff;
}
</style>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
  <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
  <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
  <li class="nav-item"><a class="nav-link" href="cart.php">CART</a></li>

  <?php if (!empty($_SESSION['username'])): ?>
    <li class="nav-item"><a class="nav-link" href="orders.php">MY ORDERS</a></li>
    <li class="nav-item"><a class="nav-link" href="logout.php">LOG OUT</a></li>
  <?php else: ?>
    <li class="nav-item"><a class="nav-link" href="login.php">LOG IN</a></li>
    <li class="nav-item"><a class="nav-link" href="register.php">REGISTER</a></li>
  <?php endif; ?>
</ul>

    </div>
  </div>
</nav>

<div class="container py-5">
