<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'header.php';
?>

<style>
/* Hero Banner */
.hero {
    background: url('https://wallpapercave.com/wp/wp9119885.jpg') no-repeat center center;
    background-size: cover;
    text-align: center;
    padding: 2rem 1rem;
    color: #fff;
    border-radius: 1rem;
    margin-bottom: 3rem;
}
.hero h1 {
    font-size: 3rem;
    font-weight: 900;
    color: #00ff88;
    text-shadow: 0 0 20px #00ff88;
    margin-bottom: 1rem;
}
.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}
.hero .btn-gaming {
    padding: 1rem 2rem;
    font-size: 1.2rem;
}

/* Section Titles */
.section-title {
    font-size: 2.2rem;
    font-weight: 700;
    text-align: center;
    color: #00ff88;
    margin-bottom: 2rem;
    text-shadow: 0 0 10px rgba(0,255,136,0.7);
}

/* Carousel Cards */
.carousel-item .card {
    background: #1e1e1e;
    border: 2px solid #6f42c1;
    border-radius: 12px;
    color: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
}
.carousel-item .card:hover {
    transform: translateY(-0px);
    box-shadow: 0 0 20px #00ff88;
}
.carousel-item .card img {
    border-radius: 12px 12px 0 0;
}

/* Featured Section Cards */
.featured-card {
    background: #1e1e1e;
    border: 2px solid #6f42c1;
    border-radius: 1rem;
    color: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
}
.featured-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 0 20px #00ff88;
}
.featured-card img {
    border-radius: 1rem 1rem 0 0;
}

/* About Section */
.about {
    background: #1f1f1f;
    color: #fff;
    padding: 3rem 2rem;
    border-radius: 1rem;
    text-align: center;
    margin-bottom: 3rem;
}
.about h2 {
    font-size: 2rem;
    color: #00ff88;
    margin-bottom: 1rem;
}

/* Categories */
.category-card {
    background: #1e1e1e;
    border-radius: 1rem;
    padding: 2rem;
    text-align: center;
    transition: 0.3s;
}
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 15px #00ff88;
}
.category-card h4 {
    color: #00ff88;
}
.category-card i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}
</style>

<!-- Hero Banner -->
<div class="hero">
    <h1>WELCOME TO PLAYVERSE STORE</h1>
    <p>Your ultimate destination for discounted games and exclusive deals!</p>
    <a href="shop.php" class="btn btn-gaming">SHOP NOW</a>
</div>

<!-- TOP DEALS -->
<h2 class="section-title">TOP DEALS</h2>
<div id="gameCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $topGames = array(
        array("title"=>"Elden Ring","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1245620/header.jpg","discount"=>2099.99),
        array("title"=>"Cyberpunk 2077","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1091500/header.jpg","discount"=>1799.99),
        array("title"=>"Red Dead Redemption 2","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1174180/header.jpg","discount"=>1999.99),
        array("title"=>"God of War","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1593500/header.jpg","discount"=>1499.99)
    );
    foreach($topGames as $index=>$game):
    ?>
    <div class="carousel-item <?php echo $index===0?'active':''; ?>">
      <div class="d-flex justify-content-center">
        <div class="card bg-dark text-white shadow-lg" style="width: 18rem;">
          <img src="<?php echo $game['img']; ?>" class="card-img-top" alt="<?php echo $game['title']; ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?php echo $game['title']; ?></h5>
            <p class="text-success fw-bold">₱<?php echo number_format($game['discount'],2); ?></p>
            <a href="shop.php" class="btn btn-gaming w-100">SHOP NOW</a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#gameCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#gameCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  </button>
</div>

<!-- Featured Games -->
<h2 class="section-title">FEATURED GAMES</h2>
<div class="row g-4 mb-5">
    <?php
    $featuredGames = array(
        array("title"=>"Elden Ring","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1245620/header.jpg","desc"=>"Explore the vast fantasy world created by Hidetaka Miyazaki and George R. R. Martin."),
        array("title"=>"Cyberpunk 2077","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1091500/header.jpg","desc"=>"An open-world RPG set in a dystopian future where you play as V, a mercenary seeking immortality."),
        array("title"=>"Red Dead Redemption 2","img"=>"https://cdn.cloudflare.steamstatic.com/steam/apps/1174180/header.jpg","desc"=>"Outlaw Arthur Morgan navigates a changing America in this epic tale of crime and survival.")
    );
    foreach($featuredGames as $game):
    ?>
    <div class="col-md-4">
        <div class="featured-card">
            <img src="<?php echo $game['img']; ?>" class="img-fluid" alt="<?php echo $game['title']; ?>">
            <div class="p-3">
                <h5><?php echo $game['title']; ?></h5>
                <p><?php echo $game['desc']; ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- About Section -->
<div class="about">
    <h2>ABOUT PLAYVERSE</h2>
    <p>Playverse Store brings you the best gaming deals online. From AAA titles to indie gems, we make sure your gaming experience is epic and affordable. Join our community and never miss out on exclusive offers!</p>
    <a href="shop.php" class="btn btn-gaming mt-3">Browse Games</a>
</div>

<?php include 'footer.php'; ?>
