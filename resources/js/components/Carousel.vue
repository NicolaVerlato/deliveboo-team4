<template>
    <section>
        <!--CAROUSEL-->
        <div class="grid pt-5">
            <div class="col">
                <h3 class="big-title">Ordina i tuoi piatti preferiti, comodamente dal tuo divano!</h3>
            </div>
            <div class="col">
                <div class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true }'>
                    <div class="carousel-cell">Italiano</div>
                    <div class="carousel-cell">Giapponese</div>
                    <div class="carousel-cell">Indiano</div>
                    <div class="carousel-cell">Pizza</div>
                    <div class="carousel-cell">Fast Food</div>
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
    font-size: 60px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
}

//Carousel
.main-carousel {
    padding: 20px;
}

.carousel-cell {
    width: 300px;
    height: 300px;
    background-color: salmon;
    border-radius: 100%;
    line-height: 150px;
    text-align: center;
    color: white;
    font-weight: bold;
    font-size: 30px;
    margin-right: 40px;
}

</style>
