<template>

    <section class="container mt-4">
        <h2 class="text-center text-uppercase fs-1" style="color:white; font-size: 40px; margin-bottom: 40px;">
            <b>Lista dei ristoranti</b>
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

            <label 
            class="form-check-label text-uppercase"
            style="font-size: 23px;" 
            :for="'id-'+tipo.id"> 
            <b>{{ tipo.name }}</b> 
            </label>

        </div>
        <span class="btn-filter" @click="provaFiltro()"> <strong>Applica filtri</strong> </span>
        </div>

        <div v-if="this.checkedRestaurants.length == 0" class="ms_main_view row g-2 row-col-auto">
            <!--Single restaurant if the user doesnt select anything -->
            <div v-for="restaurant in restaurants" :key="restaurant.id">
                    <div class="card m-3" style="width: 18rem; border-radius: 50px 15px;">

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

                            <h5 class="card-title text_size20"> {{restaurant.name}} </h5>
                            <p class="card-text text_size20">{{restaurant.address}}</p>
                            <div v-for="item in restauranttype" :key="item.id">
                                <div v-if="restaurant.id == item.restaurant_id">
                                    <div v-for="singleType in types" :key="singleType.id">
                                        <div class="type_not_typo text_size20" v-if="item.type_id == singleType.id">
                                            {{singleType.name}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <router-link 
                                class="btn btn_green"
                                :to="{
                                    name: 'restaurant-details',
                                    params: {slug: restaurant.slug}
                                }"> <strong>Menù</strong>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Restaurants if the user selects a category -->
            <div v-else>
                <div class="ms_main_view row d-flex justify-content-around g-2">
                    <div v-for="restaurant in checkedRestaurants[0]" :key="restaurant.id" class="col">
                        <div class="card m-3" style="width: 18rem; border-radius: 50px 15px;">

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

                                <h5 class="card-title text_size20"> {{restaurant.name}} </h5>
                                <p class="card-text text_size20">Indirizzo: {{restaurant.address}}</p>
                                <div class="type_not_typo text_size20" v-for="item in restauranttype" :key="item.id">
                                    <div v-if="restaurant.id == item.restaurant_id">
                                        <div v-for="singleType in types" :key="singleType.id">
                                            <div v-if="item.type_id == singleType.id">
                                                {{singleType.name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <router-link 
                                    class="btn btn_green"
                                    :to="{
                                        name: 'restaurant-details',
                                        params: {slug: restaurant.slug}
                                    }"> <strong>Menù</strong>
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
        background-color: white;
        color: $brand_color;
        border: 1px solid white;
        padding: 10px;
        border-radius: 10px;
        font-size: 25px;
    }
    .row {
        justify-content: space-evenly;
    }

    .btn-details {
        font-size: 16px;
    }
    .ms_main_view .col {
        flex-grow: 0;
    }
    .ms_main_view img {
        object-fit: cover;
        object-position: center;
    }
    .btn_green {
    background-color: $green_details;
    color: white;
    padding: 8px;
    font-size: 20px;
    border-radius: 10px;
    }
    .text_size20 {
        font-size: 20px;
        padding-bottom: 5px;
    }
</style>

