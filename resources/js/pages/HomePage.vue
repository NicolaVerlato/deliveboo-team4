<template>

    <div>
        <div class="position-relative">
            <div class="bg-image rounded-7 shadow-5" 
            style="background-image: url(https://images.squarespace-cdn.com/content/v1/545a3cf1e4b0ca6b8bdbc10d/1554056503984-4B3GJELSQ8CJZY161BZ9/Food_Photographer_Dubai03.jpg?format=2500w); height: 400px; background-size: cover; background-position: center;">
                <svg
                    data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                    style="
                        opacity: 1;
                        width: 100%;
                        height: 150px;
                        fill: #fea543;
                        transform: rotateY(0deg);">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
            </div>
        </div>

        <div style="background-color: white;">
            <p style="padding: 100px 0; text-align: center; font-size: 40px;">
                Qui sezione bianca bla bla assaggia piatti della tua zona
            </p>
            <svg
                    data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                    style="
                       opacity: 1;
                        width: 100%;
                        height: 80px;
                        fill: rgb(254, 165, 67);
                        transform: rotateX(179deg);">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
        </div>

        <div style="color: white; padding-top: 50px;">
            <Types @filterType="setFilter"/>
        </div>

        <div class="container" style="padding-bottom: 50px;">
            <Restaurants :filter="test"/>            
        </div>
    </div>

</template>

<script>

    import Types from '../components/Types.vue'; 
    import Restaurants from '../components/Restaurants.vue';
    import Dishes from '../components/Dishes.vue';

    export default {
        name: "HomePage",
        components: {
            Restaurants,
            Types,
            Dishes
        },
        data() {
            return {
                test: {}
            }
        },
        methods: {
            setFilter(value) {
                console.log(value)
                if (value.length > 0) {
                    this.test = this.$set(this.test, value, {value: value});
                } else {
                    this.test = {}
                }
            }
        }
    }

</script>