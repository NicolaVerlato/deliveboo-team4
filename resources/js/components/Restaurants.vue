<template>

    <section class="mt-4">
        <h2 class="text-center text-uppercase" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>

        <div class="row row-cols-4 d-flex justify-content-center">
            <!--Single restaurant-->
            <div v-for="restaurant in restaurants" :key="restaurant.id" class="col mr-4">
                <div class="card mb-4" style=" width: 18rem; border-radius: 50px 15px;">
                        <div v-if="restaurant.cover">
                            <img 
                            class="card-img-top"  
                            :src="'storage/' + restaurant.cover" 
                            :alt="restaurant.title">
                        </div>
                        <div v-else>
                            <img 
                            class="card-img-top"  
                            :src="'images/default-image.jpeg'"
                            :alt="restaurant.title">
                        </div>
                    <div class="card-body">
                        <h5 class="card-title">{{restaurant.name}}</h5>
                        <div v-for="item in restauranttype" :key="item.id">
                          <div v-if="restaurant.id == item.restaurant_id">
                            <div v-for="singleType in types" :key="singleType.id">
                               <div v-if="item.type_id == singleType.id">
                                {{singleType.name}}
                               </div>
                            </div>
                          </div>
                        </div>
                        <p class="card-text">Indirizzo: {{restaurant.address}}</p>

                        <router-link 
                            class="btn btn_green"
                            :to="{
                                name: 'restaurant-details',
                                params: {slug: restaurant.slug}
                            }"><strong>Menu</strong>
                        </router-link>
                    </div>
                </div>
            </div>
        </div> 
    </section>

</template>

<script>

    export default {
        name: 'Restaurants',
        data() {
            return {
                restaurants: [],
                restauranttype: [],
                types: [],
                dishes: []
            };
        },
        mounted() {
            axios.get('/api/restaurants')
            .then((response) => {
                this.restaurants = response.data.results;
            });
            axios.get('/api/restauranttype')
            .then((response) => {
                this.restauranttype = response.data.results;
            });
            axios.get('/api/types')
            .then((response) => {
                this.types = response.data.results;
            });
        }
    }
</script>

<style lang="scss" scoped>

.btn_green {
    background-color: #01a78e;
    color: white;
}
</style>


