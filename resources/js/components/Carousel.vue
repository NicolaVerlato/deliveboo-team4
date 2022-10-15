<template>
    <section class="carousel-fade">
        <!--CAROUSEL-->
        <div class="grid">
            <div class="col">
                <h3 class="big-title">Ordina i tuoi piatti preferiti,<br> comodamente dal tuo divano!</h3>
            </div>
            <div class="col">
                <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "autoPlay": 1500, "pauseAutoPlayOnHover": true }'>
                    
                    <img class="carousel-cell" src="https://images.unsplash.com/photo-1588315029754-2dd089d39a1a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=871&q=80">
                    <img class="carousel-cell" src="https://www.ildomani.it/wp-content/uploads/2017/10/Sushi-678x381.jpg">
                    <img class="carousel-cell" src="https://wips.plug.it/cips/buonissimo.org/cms/2019/03/hamburger-gourmet.jpg?w=713&a=c&h=407">
                    <img class="carousel-cell" src="https://images.unsplash.com/photo-1627207644206-a2040d60ecad?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80">
                    <img class="carousel-cell" src="https://images.unsplash.com/photo-1574484284002-952d92456975?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80">
                    <img class="carousel-cell" src="https://www.ricettasprint.it/wp-content/uploads/2020/12/Ricette-dolci-con-3-ingredienti-facili-veloci-e-deliziose-ricettasprint.jpg">

                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Carousel',
}
</script>


<style lang="scss" scoped>
@import "./resources/sass/partials/_variables.scss";

//Columns
.carousel-fade {
    animation: fade-in 2.5s;
}
@keyframes fade-in {
    0% { opacity: 0; }
    50% { opacity: 0; }
    100% { opacity: 1; }
}
.grid {
    display: flex;
    flex-direction: column;
    max-width: 1350px;
    padding: 0 30px;
    margin: 0 auto;
}

.grid.col {
    width: 100%;
} 

//Text
.big-title {
    font-size: 40px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
}

//Carousel
.main-carousel {
    padding: 20px;
}

.carousel-cell {
    width: 250px;
    height: 250px;
    background-color: $brand_color;
    border-radius: 50%;
    line-height: 150px;
    text-align: center;
    color: white;
    font-weight: bold;
    font-size: 30px;
    margin-right: 40px;
    object-fit: cover;
}

</style>
