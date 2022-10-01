<template>
    <section class="mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>

        <div v-if="Object.keys(filter).length == 0">
            <div class="row row-cols-4">
                <!--Single restaurant-->
                <div v-for="restaurant in restaurants" :key="restaurant.id" class="col mr-4">
                    <div class="card" style="width: 18rem;">
                        <div v-if="restaurant.cover">
                            <img 
                                class="card-img-top"  
                                :src="'storage/' + restaurant.cover" 
                                :alt="restaurant.title">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                {{restaurant.name}}
                            </h5>
                            <!-- ciclo per prendere le FK della tabella ponte restaurant_type -->
                            <div v-for="item in restauranttype" :key="item.id">

                                <!-- se l'id del ristorante è presente nella tabella ponte -->
                            <div v-if="restaurant.id == item.restaurant_id">

                                <!-- ciclo per prendere i nomi dei tipi di ristoranti relativi all'id -->
                                <div v-for="singleType in types" :key="singleType.id">

                                    <!-- se l'id del type_id nella tabella ponte è associato al nome del tipo -->
                                <div v-if="item.type_id == singleType.id">

                                    <!-- stampo il nome del tipo del ristorante -->
                                    {{singleType.name}}
                                </div>
                                </div>
                            </div>
                            </div>
                            <p class="card-text">Indirizzo: {{restaurant.address}}</p>
                            <a href="#" class="btn btn-primary">Dettagli</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="row row-cols-4">
                <!--Single restaurant-->
                <div v-for="restaurant in restaurants" :key="restaurant.id" class="col mr-4">
                    <div v-for="restaurantType in restauranttype" :key="restaurantType.id">
                        <div v-if="restaurant.id == restaurantType.restaurant_id">
                            <div  v-for="filter in userFilter" :key="filter.id">
                                <div v-for="singleFilter in filter" :key="singleFilter.id">
                                    <div v-if="singleFilter == restaurantType.type_id">
                                        <div v-for="singleType in types" :key="singleType.id">
                                            <div v-if="singleType.id == restaurantType.type_id">
                                                <div class="card" style="width: 18rem;">
                                                    <h5 class="card-title">
                                                        {{restaurant.name}}
                                                    </h5>
                                                    <h1>ciaoi</h1>
                                                    <div v-if="restaurant.cover">
                                                        <img 
                                                            class="card-img-top"  
                                                            :src="'storage/' + restaurant.cover" 
                                                            :alt="restaurant.title">
                                                    </div>
                                                        
                                                        <h5>
                                                            {{singleType.name}}
                                                        </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </section>
</template>

<script>
export default {
    name: 'Restaurants',
    props: {
        filter: Object
    },
    data() {
        return {
            restaurants: [],
            restauranttype: [],
            types: [],
            userFilter: {}
        };
    },
    watch: {
        immediate: true,
        deep: true,
        filter(newValue) {
            this.userFilter = newValue
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

