<template>

    <section class="container mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>
        <div class="ms_filters text-center">
            <div v-for="tipo in types" :key="tipo.id" class="form-check form-check-inline"  style="color:white;">
            <input 
                class="form-check-input" 
                type="checkbox" 
                :name="'id-'+tipo.id" 
                :id="'id-'+tipo.id" 
                :value="tipo.id"
                v-model="checkedOptions"
            >

            <label class="form-check-label" :for="'id-'+tipo.id"> {{ tipo.name }} </label>
        </div>
        <span class="btn-filter" @click="provaFiltro()" > Applica filtri </span>
        </div>

        <div v-if="this.checkedRestaurants.length == 0" class="ms_main_view row g-2 row-col-auto">
            <!--Single restaurant if the user doesnt select anything -->
            <div v-for="restaurant in restaurants" :key="restaurant.id">
                    <div class="card m-3" style="width: 18rem;">

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

                            <h5 class="card-title"> {{restaurant.name}} </h5>
                            <p class="card-text">Indirizzo: {{restaurant.address}}</p>
                            <div v-for="item in restauranttype" :key="item.id">
                                <div v-if="restaurant.id == item.restaurant_id">
                                    <div v-for="singleType in types" :key="singleType.id">
                                        <div class="type_not_typo" v-if="item.type_id == singleType.id">
                                            {{singleType.name}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <router-link 
                                class="btn btn-sm btn-details"
                                :to="{
                                    name: 'restaurant-details',
                                    params: {slug: restaurant.slug}
                                }"> Menù
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Restaurants if the user selects a category -->
            <div v-else>

                <div class="row g-2">
                    <div v-for="restaurant in checkedRestaurants[0]" :key="restaurant.id" class="col mr-4">
                    <div class="card m-3" style="width: 18rem;">

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

                                <h5 class="card-title"> {{restaurant.name}} </h5>
                                <p class="card-text">Indirizzo: {{restaurant.address}}</p>
                                <div class="type_not_typo" v-for="item in restauranttype" :key="item.id">
                                    <div v-if="restaurant.id == item.restaurant_id">
                                        <div v-for="singleType in types" :key="singleType.id">
                                            <div v-if="item.type_id == singleType.id">
                                                {{singleType.name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <router-link 
                                class="btn btn-sm btn-primary"
                                :to="{
                                    name: 'restaurant-details',
                                    params: {slug: restaurant.slug}
                                }"> Menù
                            </router-link>
                        </div>
                    </div>
                </div>
                </div>

            </div>
    </section>

</template>

<script>
import arrayPush from 'lodash/_arrayPush';


    export default {
        name: 'Restaurants',
        data() {
            return {
                restaurants: [],
                restauranttype: [],
                types: [],
                dishes: [],
                checkedOptions: [],
                checkedRestaurants: []
            };
        },
        methods: {
            provaFiltro() {
                this.checkedRestaurants= [];
                
                if (this.checkedOptions.length == 0) {
                    this.checkedRestaurants= [];
                    return
                } else {
                    axios.get(`/api/types/${this.checkedOptions}`) 
                    .then((response) => {
                        this.checkedRestaurants.push(response.data.results[0].restaurants)
                    });    
                }
                
            }
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

<style lang="scss">

    @import '../../sass/partials/variables.scss';

    .btn-filter {
        cursor: pointer;
        color: white;
        border: 1px solid white;
        padding: 6px;
        border-radius: 4px;
    }
    .row {
        justify-content: space-evenly;
    }

    .btn-details {
        font-size: 16px;
;
        color: white;
        background-color: $secondary-color;
    }
</style>

