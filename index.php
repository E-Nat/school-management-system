
<?php include('shared/_header.php'); ?>

<style>
body{
    background:#f8fafc;
    font-family:Arial, sans-serif;
}

.hero-section{
    min-height:90vh;
    display:flex;
    align-items:center;
    padding:80px 0;
}

.hero-badge{
    display:inline-block;
    padding:10px 20px;
    background:#eef2ff;
    color:#4f46e5;
    border-radius:50px;
    font-weight:600;
    margin-bottom:25px;
}

.hero-title{
    font-size:4rem;
    font-weight:800;
    line-height:1.1;
    color:#4f46e5;
}

.hero-subtitle{
    margin-top:20px;
    color:#64748b;
    font-size:1.1rem;
    line-height:1.8;
}

.hero-buttons{
    display:flex;
    gap:15px;
    margin-top:35px;
}

.btn-primary-custom{
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:white;
    padding:15px 30px;
    border-radius:15px;
    text-decoration:none;
    font-weight:600;
}

.btn-primary-custom:hover{
    color:white;
    opacity:.9;
}

.btn-secondary-custom{
    background:white;
    border:1px solid #ddd;
    color:#111;
    padding:15px 30px;
    border-radius:15px;
    text-decoration:none;
    font-weight:600;
}

.hero-image{
    width:100%;
    max-width:550px;
    border-radius:25px;
    box-shadow:0 25px 50px rgba(0,0,0,.15);
    margin-top:40px;
}

.hero-stats{
    display:flex;
    gap:20px;
    margin-top:40px;
}

.stat-card{
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 10px 20px rgba(0,0,0,.08);
    min-width:120px;
}

.stat-card h3{
    margin:0;
    color:#4f46e5;
}

.stat-card span{
    color:#64748b;
}

.carousel-box{
    margin-top:80px;
}

.carousel-inner{
    border-radius:25px;
    overflow:hidden;
}

.carousel-item img{
    height:550px;
    object-fit:cover;
}

@media(max-width:768px){

    .hero-title{
        font-size:2.5rem;
    }

    .hero-stats{
        flex-direction:column;
    }

    .hero-image{
        margin-top:30px;
    }
}
</style>

<main>

<div class="big-wrapper">

<?php include('shared/_navbar.php'); ?>

<section class="hero-section">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<span class="hero-badge">
Modern School Management System
</span>

<h1 class="hero-title">
Smart Education Starts Here
</h1>

<p class="hero-subtitle">
Manage students, teachers, attendance, grades,
courses and communication from one modern platform.
Built for schools that want efficiency and growth.
</p>

<div class="hero-buttons">

<a href="login.php" class="btn-primary-custom">
Get Started
</a>

<a href="#features" class="btn-secondary-custom">
Learn More
</a>

</div>

<div class="hero-stats">

<div class="stat-card">
<h3>5000+</h3>
<span>Students</span>
</div>

<div class="stat-card">
<h3>500+</h3>
<span>Teachers</span>
</div>

<div class="stat-card">
<h3>99%</h3>
<span>Efficiency</span>
</div>

</div>

</div>

<div class="col-lg-6 text-center">

<img src="./images/loginimage.jpg"
     alt="Student"
     class="hero-image">

</div>

</div>

</div>

</section>

<div id="features">
<?php include('shared/feature-cards.php'); ?>
</div>

<div class="container mt-5">
<hr>
</div>

<div class="container carousel-box">

<div id="carouselExample"
     class="carousel slide"
     data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">
<img src="images/carousel1.jpg"
     class="d-block w-100"
     alt="">
</div>

<div class="carousel-item">
<img src="images/carousel2.jpg"
     class="d-block w-100"
     alt="">
</div>

<div class="carousel-item">
<img src="images/carousel3.jpg"
     class="d-block w-100"
     alt="">
</div>

</div>

<button class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

</div>

</div>

</div>

</main>

<?php include('shared/_footer.php'); ?>