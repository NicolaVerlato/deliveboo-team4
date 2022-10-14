<template>

    <div>
        <!-- Jumbo -->
        <div class="position-relative">
            <div class="bg-image rounded-7 shadow-5">
                <svg
                    data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                    style="
                        opacity: 1;
                        width: 100%;
                        height: 100px;
                        fill: #fea543;
                        background-color: white;
                        transform: rotateY(0deg);">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
            </div>
        </div>

        <div style="padding-bottom: 50px; background-color: white;">
            <Carousel/>            
        </div>

        <div class="container" style="padding-bottom: 50px;">
            <Restaurants/>            
        </div>

    </div>

</template>

<script>

    import Restaurants from '../components/Restaurants.vue';
    import Dishes from '../components/Dishes.vue';
    import Carousel from '../components/Carousel.vue';

    export default {
        name: "HomePage",
        components: {
            Restaurants,
            Dishes,
            Carousel
        },
    }
</script>
