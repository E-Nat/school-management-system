
<?php include('shared/_header.php'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

:root{
    --primary:#4f46e5;
    --secondary:#7c3aed;
    --dark:#0f172a;
    --gray:#64748b;
    --light:#f8fafc;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:
    radial-gradient(circle at top left,#a5b4fc 0%,transparent 30%),
    radial-gradient(circle at bottom right,#d8b4fe 0%,transparent 30%),
    #f8fafc;
    overflow-x:hidden;
}

/* HERO */

.hero-section{
    min-height:100vh;
    display:flex;
    align-items:center;
    padding:100px 0;
}

.hero-badge{
    display:inline-block;
    padding:12px 22px;
    background:rgba(79,70,229,.1);
    color:var(--primary);
    border-radius:50px;
    font-weight:600;
    margin-bottom:25px;
    backdrop-filter:blur(10px);
}

.hero-title{
    font-size:5rem;
    font-weight:900;
    line-height:1.05;

    background:
    linear-gradient(
        135deg,
        #4338ca,
        #7c3aed
    );

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.hero-subtitle{
    font-size:1.15rem;
    line-height:1.9;
    color:var(--gray);
    margin-top:25px;
    max-width:600px;
}

.hero-buttons{
    display:flex;
    gap:15px;
    margin-top:35px;
}

.btn-primary-custom{
    background:
    linear-gradient(
        135deg,
        #4f46e5,
        #7c3aed
    );

    color:#fff;
    text-decoration:none;
    padding:16px 32px;
    border-radius:18px;
    font-weight:700;

    box-shadow:
    0 15px 35px rgba(79,70,229,.3);

    transition:.3s;
}

.btn-primary-custom:hover{
    transform:
    translateY(-3px)
    scale(1.02);

    color:#fff;
}

.btn-secondary-custom{
    background:#fff;
    border:1px solid #e5e7eb;
    color:#111827;
    text-decoration:none;
    padding:16px 32px;
    border-radius:18px;
    font-weight:700;
}

.hero-image{
    width:100%;
    max-width:620px;

    border-radius:35px;

    box-shadow:
    0 35px 80px rgba(79,70,229,.25);

    animation:float 5s ease-in-out infinite;
}

@keyframes float{

0%{
transform:translateY(0);
}

50%{
transform:translateY(-15px);
}

100%{
transform:translateY(0);
}

}

.hero-stats{
    display:flex;
    gap:20px;
    margin-top:50px;
}

.stat-card{
    background:
    rgba(255,255,255,.75);

    backdrop-filter:blur(15px);

    border:
    1px solid rgba(255,255,255,.5);

    padding:22px;
    border-radius:24px;

    min-width:140px;

    box-shadow:
    0 15px 30px rgba(0,0,0,.05);
}

.stat-card h3{
    color:var(--primary);
    font-weight:800;
}

.stat-card span{
    color:var(--gray);
}

/* FEATURES */

.features{
    padding:100px 0;
}

.section-title{
    text-align:center;
    margin-bottom:60px;
}

.section-title h2{
    font-size:3rem;
    font-weight:800;
    color:var(--dark);
}

.section-title p{
    color:var(--gray);
}

.feature-card{
    background:#fff;

    border-radius:30px;

    padding:35px;

    height:100%;

    transition:.3s;

    box-shadow:
    0 10px 30px rgba(0,0,0,.05);
}

.feature-card:hover{
    transform:translateY(-10px);
}

.feature-icon{
    font-size:3rem;
    margin-bottom:20px;
}

.feature-card h4{
    font-weight:700;
}

/* CAROUSEL */

.carousel-box{
    margin-top:80px;
    margin-bottom:80px;
}

.carousel-inner{
    border-radius:35px;
    overflow:hidden;

    box-shadow:
    0 25px 70px rgba(0,0,0,.12);
}

.carousel-item img{
    height:650px;
    object-fit:cover;
}

/* TRUSTED */

.trusted{
    padding:80px 0;
}

.company{
    font-size:1.4rem;
    font-weight:700;
    color:#94a3b8;
}

/* MOBILE */

@media(max-width:991px){

.hero-title{
font-size:3rem;
}

.hero-stats{
flex-direction:column;
}

.hero-buttons{
flex-direction:column;
}

.hero-image{
margin-top:50px;
}

.carousel-item img{
height:350px;
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
Modern School Management Platform
</span>

<h1 class="hero-title">
Smart Education Starts Here
</h1>

<p class="hero-subtitle">
Manage students, teachers, attendance, grades,
courses and communication from one intelligent platform
built for modern schools and educational institutions.
</p>

<div class="hero-buttons">

<a href="login.php" class="btn-primary-custom">
Get Started
</a>

<a href="#features" class="btn-secondary-custom">
Explore Features
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

<section class="trusted">

<div class="container text-center">

<p class="text-muted mb-4">
Trusted by Schools & Institutions
</p>

<div class="d-flex justify-content-center gap-5 flex-wrap">

<div class="company">🏫 School One</div>
<div class="company">🏫 School Two</div>
<div class="company">🏫 School Three</div>
<div class="company">🏫 School Four</div>

</div>

</div>

</section>

<section class="features" id="features">

<div class="container">

<div class="section-title">

<h2>Powerful Features</h2>

<p>
Everything you need to manage your school efficiently.
</p>

</div>

<div class="row g-4">

<div class="col-md-4">

<div class="feature-card">

<div class="feature-icon">🎓</div>

<h4>Student Management</h4>

<p>
Manage student profiles, records and performance easily.
</p>

</div>

</div>

<div class="col-md-4">

<div class="feature-card">

<div class="feature-icon">👨‍🏫</div>

<h4>Teacher Portal</h4>

<p>
Attendance, grading and academic management tools.
</p>

</div>

</div>

<div class="col-md-4">

<div class="feature-card">

<div class="feature-icon">📈</div>

<h4>Analytics & Reports</h4>

<p>
Generate detailed reports and insights instantly.
</p>

</div>

</div>

</div>

</div>

</section>

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

