<?php
$games = array(
    array(
        "title" => "Cyberpunk 2077",
        "price" => 2499,
        "discount" => 1799.99,
        "img" => "https://cdn.cloudflare.steamstatic.com/steam/apps/1091500/header.jpg",
        "tag" => "BESTSELLER",
        "desc" => "An open-world RPG set in a dystopian future where you play as V, a mercenary seeking immortality."
    ),
    array(
        "title" => "Elden Ring",
        "price" => 2799,
        "discount" => 2099.99,
        "img" => "https://cdn.cloudflare.steamstatic.com/steam/apps/1245620/header.jpg",
        "tag" => "NEW",
        "desc" => "Explore a vast fantasy world created by Hidetaka Miyazaki and George R. R. Martin."
    ),
    array(
        "title" => "God of War",
        "price" => 1999,
        "discount" => 1499.99,
        "img" => "https://cdn.cloudflare.steamstatic.com/steam/apps/1593500/header.jpg",
        "tag" => "",
        "desc" => "Join Kratos and Atreus in a journey across Norse mythology filled with gods, monsters, and epic battles."
    ),
    array(
        "title" => "Red Dead Redemption 2",
        "price" => 2899,
        "discount" => 1999.99,
        "img" => "https://cdn.cloudflare.steamstatic.com/steam/apps/1174180/header.jpg",
        "tag" => "TOP DEAL",
        "desc" => "An epic tale of life in America’s unforgiving heartland. Outlaw Arthur Morgan must survive in a changing world."
    ),
    array(
        "title" => "Resident Evil 4 Remake",
        "price" => 2599,
        "discount" => 1899.99,
        "img" => "https://cdn.cloudflare.steamstatic.com/steam/apps/2050650/header.jpg",
        "tag" => "",
        "desc" => "Re-imagined survival horror classic where Leon Kennedy battles through a terrifying village to rescue the president's daughter."
    ),
    array(
        "title" => "Call of Duty: Modern Warfare II",
        "price" => 3099,
        "discount" => 2499.99,
        "img" => "https://cdn.cloudflare.steamstatic.com/steam/apps/1938090/header.jpg",
        "tag" => "",
        "desc" => "A high-octane FPS campaign and multiplayer with Task Force 141, featuring tactical combat and cinematic missions."
    )
);

include 'header.php';
?>

<style>
/* 🌌 Background */
body {
    background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center fixed;
    background-size: cover;
}

/* 🎮 Game Cards */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
}
.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 0 25px rgba(0, 255, 136, 0.6);
}
.card img {
    transition: transform 0.4s ease;
    border-radius: 12px 12px 0 0;
}
.card:hover img {
    transform: scale(1.08);
    cursor: pointer;
}

/* 💸 Pricing */
.old-price {
    color: #ff6f61;
    text-decoration: line-through;
    font-size: 0.9rem;
}
.new-price {
    color: #00ff88;
    font-size: 1.2rem;
    font-weight: bold;
}
.discount-badge {
    background: linear-gradient(90deg, #ff4e50, #ff6f61);
    box-shadow: 0 0 10px rgba(255, 111, 97, 0.8);
    font-weight: bold;
}

/* ✨ Neon Add to Cart button */
.btn-gaming {
    background-color: #0d6efd;
    border: none;
    color: #fff;
    font-weight: bold;
    transition: all 0.3s ease;
    border-radius: 8px;
}
.btn-gaming:hover {
    background-color: #00ff88;
    color: #000;
    box-shadow: 0 0 15px #00ff88, 0 0 30px #00ff88;
    animation: pulse 1.5s infinite;
}
@keyframes pulse {
    0% { box-shadow: 0 0 10px #00ff88, 0 0 20px #00ff88; }
    50% { box-shadow: 0 0 20px #00ff88, 0 0 40px #00ff88; }
    100% { box-shadow: 0 0 10px #00ff88, 0 0 20px #00ff88; }
}

/* 🔥 Animated Title */
h2.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    text-align: center;
    background: linear-gradient(90deg, #ff4e50, #ff6f61, #00ff88, #6f42c1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-size: 300% 300%;
    animation: gradient-flow 6s infinite linear;
}
@keyframes gradient-flow {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}
</style>

<div class="row g-4">
<?php
foreach ($games as $index => $game) {
    $discountPercent = round((($game['price'] - $game['discount']) / $game['price']) * 100);
?>
    <div class="col-md-4">
        <div class="card bg-dark text-white border-0 shadow-lg h-100 position-relative">
            <!-- SALE badge -->
            <span class="badge discount-badge position-absolute top-0 start-0 m-2 p-2 rounded-pill">
                -<?php echo $discountPercent; ?>%
            </span>
            <?php if (!empty($game['tag'])): ?>
                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 p-2 rounded-pill">
                    <?php echo $game['tag']; ?>
                </span>
            <?php endif; ?>
            <!-- Image triggers modal -->
            <img src="<?php echo $game['img']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($game['title']); ?>"
                 data-bs-toggle="modal" data-bs-target="#gameModal<?php echo $index; ?>">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo htmlspecialchars($game['title']); ?></h5>
                <p class="card-text">
                    <span class="old-price">₱<?php echo number_format($game['price'], 2); ?></span><br>
                    <span class="new-price">₱<?php echo number_format($game['discount'], 2); ?></span>
                </p>
                <form method="post" action="cart.php" class="mt-auto">
                    <input type="hidden" name="title" value="<?php echo htmlspecialchars($game['title']); ?>">
                    <input type="hidden" name="price" value="<?php echo $game['discount']; ?>">
                    <button type="submit" class="btn btn-gaming w-100">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</div>

<!-- Game Description Modals -->
<?php foreach ($games as $index => $game): ?>
<div class="modal fade" id="gameModal<?php echo $index; ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark text-white text-center">
      <div class="modal-header border-0 justify-content-center">
        <h5 class="modal-title"><?php echo htmlspecialchars($game['title']); ?></h5>
      </div>
      <div class="modal-body d-flex flex-column align-items-center">
        <img src="<?php echo $game['img']; ?>" class="img-fluid rounded mb-3" style="max-height:400px;">
        <p class="mb-3"><?php echo htmlspecialchars($game['desc']); ?></p>
        <p>
          <span class="old-price">₱<?php echo number_format($game['price'], 2); ?></span><br>
          <span class="new-price">₱<?php echo number_format($game['discount'], 2); ?></span>
        </p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <form method="post" action="cart.php" class="me-2">
          <input type="hidden" name="title" value="<?php echo htmlspecialchars($game['title']); ?>">
          <input type="hidden" name="price" value="<?php echo $game['discount']; ?>">
          <button type="submit" class="btn btn-gaming">Add to Cart</button>
        </form>
        <!-- Close button -->
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>



<?php include 'footer.php'; ?>
