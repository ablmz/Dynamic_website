<!---->
<?php  session_start();
if(isset($_GET['page'])){
   echo '<header id="header" class="fixed-top d-flex align-items-center ">';


}
else{
    echo '<header id="header" class="fixed-top d-flex align-items-center header-transparent">';
}
?>
<!-- ======= Header ======= -->

    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
            <h1 class="text-light"><a href="index.html"><span>Horizont</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="index.php">Startseite</a></li>
                <!-- <li><a href="#about">Über uns</a></li> -->
                <li><a href="#menu">Menü</a></li>
                <li><a href="#specials">Spezialitäten</a></li>
<!--                <li><a href="#chefs">Koch/in</a></li>-->
<!--                <li><a href="#gallery">Gallerie</a></li>-->
                <li><a href="#contact">Kontakt</a></li>
                <li><a href="admin/index.php"> Admin</a></li>


                <li class="book-a-table text-center"><a href="?page=menu">Bestellen Sie hier</a></li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->

<?php if(isset($_GET['page'])){
    echo'
<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2> </h2>
            
        </div>

    </div>
</section><!-- End Breadcrumbs Section -->';
    }