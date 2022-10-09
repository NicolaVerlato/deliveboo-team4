<template>

    <section class="mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>
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

        <div v-if="this.checkedRestaurants.length == 0" class="row row-cols-4">
            <!--Single restaurant if the user doesnt select anything -->
            <div v-for="restaurant in restaurants" :key="restaurant.id" class="mr-5">
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
                                class="btn btn-sm btn-primary"
                                :to="{
                                    name: 'restaurant-details',
                                    params: {slug: restaurant.slug}
                                }">View
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single restaurant if the user selects a category -->
            <div v-else>

                <div class="row">
                    <div v-for="restaurant in checkedRestaurants" :key="restaurant.id" class="col mr-4">
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
                                class="btn btn-sm btn-primary"
                                :to="{
                                    name: 'restaurant-details',
                                    params: {slug: restaurant.slug}
                                }">View
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

                axios.get(`/api/restaurants?categories=${this.checkedOptions}`) 
                .then((response) => {
                    // Pivot table
                    let pivot = response.data.data;

                    // Filter engine
                    for (const item of pivot) {
                        if (this.checkedOptions.includes(item.type_id)) {
                            if (!this.checkedRestaurants.includes(item)) {
                                if (!this.checkedRestaurants.includes(item.restaurant_id)) {
                                    this.checkedRestaurants.push(item);
                                    // Return just one element with that restaurant id
                                    return Array.from(new Set(this.checkedRestaurants));
                                }
                            }
                        }
                    }
                });
            },
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
    .btn-filter {
        color: white;
        border: 1px solid white;
        padding: 4px;
        border-radius: 4px;
    }
</style>

