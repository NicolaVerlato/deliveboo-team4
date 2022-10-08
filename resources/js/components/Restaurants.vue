<template>

    <section class="mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>
        <div v-for="tipo in types" :key="tipo.id" class="form-check form-check-inline"  style="color:white;">
            <input 
                class="form-check-input" 
                @click="checkFilter(tipo.id)" 
                type="checkbox" 
                :name="'id-'+tipo.id" 
                :id="'id-'+tipo.id" 
                :value="tipo.id"
                v-model="checkedOptions"
            >

            <label class="form-check-label" :for="'id-'+tipo.id"> {{ tipo.name }} </label>
        </div>

        <div class="row row-cols-4">
            <!--Single restaurant if the user doesnt select anything -->
            <div v-if="this.checkedOptions.length == 0">
                
                <div v-for="restaurant in restaurants" :key="restaurant.id" class="col mr-4">
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
            checkFilter(value) {
                // If the value of the selected input is not present in checked options - push it
                if (!this.checkedOptions.includes(value)) {
                    this.checkedOptions.push(value);

                    if (this.checkedOptions.length == 0) {
                        return this.restaurants;  
                    } else {
                        // For each element of the restaurants array
                        this.restaurants.forEach(element => {
                            // For each item of the checked options array
                            this.checkedOptions.forEach(item => {
                                // If the checked value is the same as the user_id of the restaurant
                                if (item == element.id) {
                                    this.checkedRestaurants.push(element)
                                } else {
                                    // Return nothing
                                    console.log('fanculo');
                                }
                            });
                    }); }
            } else {
                const index = this.checkedOptions.indexOf(value);
                if (index > -1) { 
                this.checkedOptions.splice(index, 1);
                }
            }}  
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

