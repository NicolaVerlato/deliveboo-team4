<template>

    <section class="mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>
        <div v-for="tipo in types" :key="tipo.id" class="form-check form-check-inline"  style="color:white;">
            <input class="form-check-input" @click="checkFilter(tipo.id)" type="checkbox" :name="'id-'+tipo.id" :id="'id-'+tipo.id" :value="tipo.id">
            <label class="form-check-label" :for="'id-'+tipo.id">{{ tipo.name }}</label>
        </div>
        <div class="row row-cols-4">
            <!--Single restaurant-->
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
                checkedOptions: []
            };
        },
        methods: {
            checkFilter(value) {
                if (this.checkedOptions.includes(value)) {
                    this.checkedOptions.filter(function(e) { return e !== value })
                    // console.log('presente')
                } else {
                    // console.log('non ce')
                    this.checkedOptions.push(value)
                }

                console.log(this.checkedOptions)
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

