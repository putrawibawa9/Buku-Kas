 <?php
include_once "header.php";

require_once "../admins/classBurger.php";

$burger = new Burger;

$binatang = $burger->readBurger();




?>
        <div class="w-100 vh-100" id="home">
        <div id="carouselExample" class="carousel slide carousel-fade h-100">
            <div class="carousel-inner h-100">
                <div class="carousel-item h-100 active">
                    <img src="../img/junk1.jpg" class="d-block w-100 h-70 object-fit-cover" alt="Gambar 1">
                </div>
                <div class="carousel-item h-100">
                    <img src="../img/junk2.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Gambar 2">
                </div>
                <div class="carousel-item h-100">
                    <img src="../img/junk3.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Gambar 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>


            <div class="col-12 p-5">
                    <h1 class="display-4"> CRISPY BASE</h1>
                    <p align="justify">Welcome to Crispy Base, where culinary excellence meets the art of crafting the perfect burger experience. Our web platform is a digital gateway to a world of delectable creations, showcasing a symphony of flavors that will tantalize your taste buds. From classic favorites to innovative gourmet combinations, our menu is a celebration of premium ingredients and expert craftsmanship. Explore our diverse range of mouthwatering burgers, each made with care and precision to ensure a gastronomic adventure with every bite. Our user-friendly website provides a seamless ordering experience, allowing you to customize your burger to perfection and have it delivered straight to your door. Dive into a culinary journey where quality meets convenience, and savor the extraordinary at Crispy Base.</p>
                </div>
              
<?php
include_once "footer.php"
?>

<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-home').addClass('active');
</script>
