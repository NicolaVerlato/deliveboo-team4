<template>

    <div>
        <div class="card mb-3">

            <div class="card-header d-flex align-items-center justify-content-center">
                <h2 class="card-title text-center" style="margin: 0 !important;"> {{restaurant.name}} </h2>
            </div>


            <div v-if="restaurant.user_id">
                <h4 class="text-center mt-4">Il nostro menù</h4>


                <div v-for="dish in dishes" :key="dish.id"  v-if="dish.is_visible == 1" class="mb-3">
                    <div v-if="restaurant.user_id == dish.restaurant_id">

                        <div class="card-body d-flex justify-content-around">

                            <div>
                                <h5 class="card-title text-center"> Piatto: {{dish.name}} </h5>

                                <p class="card-text text-center"> Prezzo: {{dish.price}} &euro;</p>
                            </div>
                            
                            <div>
                                <a class="btn btn-light"> Aggiungi </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div v-else> 
               <p style="padding: 20px">
                    Al momento non ci sono piatti disponibili. 
                    Torna alla 
                    <a style="color:white; padding: 20px 0;" href="/"> 
                        Home 
                    </a>
               </p>
            </div>
            
        </div>
   </div>

</template>

<script>
    
    export default {
        name: "RestaurantDetails",
        data() {
            return {
                restaurant: null,
                dishes: []            }
        },
        methods: {
            async getRestaurant() {
                await axios.get(`/api/restaurants/?slug=${this.$route.params.slug}`)
                .then((response) => {
                    response.data.results.forEach(element => {
                        // If the slug on the url is the same as one of the elements
                        // Save the data on the empty restaurant
                        if (this.$route.params.slug === element.slug) {
                            this.restaurant = element;
                        }
                    });
                })
            },
            async getDishes() {
                await axios.get(`/api/restaurants`)
                .then((response) => {
                    response.data.dishes.forEach(element => {
                        this.dishes.push(element);
                    });
                })
            },
        },
        mounted() {
            this.getRestaurant();
            this.getDishes();
        },
    }

</script>

<style lang="scss" scoped>

    @import '../../sass/partials/variables.scss';

    .card {
        background-color: $brand-color;
        width: 800px;
        margin: 0 auto;
    }
</style>