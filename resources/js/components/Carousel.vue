<template>
    <section class="container d-flex justify-content-center mt-3 pt-3 pb-3">
        <!--CAROUSEL-->
       <div class="carousel">
            <button @click="previousSlides" class="carousel-button prev"><i class="fa-solid fa-chevron-left"></i></button>
            <button @click="nextSlides" class="carousel-button next"><i class="fa-solid fa-chevron-right"></i></button>
            <div 
            v-for="(slide, index) in slides" 
            :key="index"
            :index="index"
            v-if="currentActiveElement === index"
            >
                <div class="slide">
                    <img :src="slide">
                </div>
            </div>
       </div>
    </section>
</template>

<script>

export default {
    name: 'Carousel',

    props: ['visibleImage', 'index'],
    data() {
        return {
            slides: [
                'images/bigburger.png',
                'images/flycouch.png',
                'images/restaurant.png'
            ],
            currentActiveElement : 0,
        }  
    },
    methods: {
        nextSlides(){ 
            if(this.currentActiveElement > 0) {                 
                // Decremento di 1 currentActiveElement                 
                this.currentActiveElement--;             
                }else {                 
                    this.currentActiveElement = this.slides.length - 1;             
                }         
        }, 
        previousSlides(){  
            if(this.currentActiveElement < this.slides.length - 1) {                 
                // Incrementa di 1 currentActiveElement                 
                this.currentActiveElement++;             
                } else {                 
                    this.currentActiveElement = 0;             
                }           
        }
    }
}
</script>


<style lang="scss" scoped>
@import "./resources/sass/partials/_variables.scss";

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
 }

 *, *::after, *::before {
    box-sizing: border-box;
 }

.carousel {
    width: 400px;
    height: 300px;
    position: relative;
    .slide {
        position: absolute;
        opacity: 1;
        transition: 200ms opacity ease-in-out;
        transition-delay: 200ms;
        img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }
    }
}

.slide[data-active] {
    opacity: 2;
    z-index: 1;
    transition-delay: 0ms;
}

.carousel-button {
    position: absolute;
    z-index: 2;
    background: none;
    border: none;
    font-size: 2rem;
    top: 50%;
    transform: translateY(-20%);
    color: rgba(255, 255, 255, .5);
    cursor: pointer;
    border-radius: .25rem;
    padding: 0 .5rem;
    background-color: rgba(0, 0, 0, .1);
}

.carousel-button:hover,
.carousel-button:active {
    color: white;
    background-color: rgba(0, 0, 0, .2);
}

.carousel-button.prev {
    left: 0;
}

.carousel-button.next {
    right: 0;
}

</style>
