<template>
    <section class="mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>

        <div v-if="Object.keys(this.filter).length == 0">
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
            <div v-if="filteredRestaurants" class="row row-cols-4">
                <div v-for="restaurant in filteredRestaurants" :key="restaurant.id">
                    <div v-for="singleRestaurant, index in restaurant" :key="index">
                        <div class="card" style="width: 18rem;">
                        <!-- singolo ristorante -->
                            <!-- cover -->
                            <div v-if="restaurant.cover">
                                <img 
                                class="card-img-top"  
                                :src="'storage/' + restaurant.cover" 
                                :alt="restaurant.name">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{singleRestaurant.name}}</h5>
                            <p class="card-text">Indirizzo: {{singleRestaurant.address}}</p>
                            <a href="#" class="btn btn-primary">Dettagli</a>
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
    methods: {
        explodeTest() {
            if (this.userChoice.length === 1) {
                this.userChoice = this.userChoice
                return this.userChoice
            }
            if (this.userChoice.length > 1) {
                for (let i = 0; i < this.userChoice.length; i++) {
                    this.userChoice.sort()
                    this.sorted = this.userChoice.join('-')
                }
            }
        },
        async updatePost() {
            this.explodeTest()
            if (this.sorted !== '') {
                if(Object.keys(this.filter).length !== 0) {
                await axios.get('/api/restaurants/' + this.sorted)
                .then((response) => {
                this.explodeTest()
               this.filteredRestaurants = response.data.results;
               console.log(response);
            })
            } 
            } else {
                console.log(axios.get('/api/restaurants/' + this.userChoice))
                if(Object.keys(this.filter).length !== 0) {
                await axios.get('/api/restaurants/' + this.userChoice)
                .then((response) => {
               this.filteredRestaurants = response.data.results;
               console.log('response', response.data.result)
               this.userChoice = [];
            }).catch(function(error) {
        console.log(error);
      })
            }
            }
            if (Object.keys(this.filter).length == 0) {
                this.filteredRestaurants = []
            }
        }
    },
    data() {
        return {
            restaurants: [],
            restauranttype: [],
            types: [],
            userFilter: {},
            userChoice: [],
            filteredRestaurants: [],
            sorted: ''
        }
    },
    watch: {
        immediate: true,
        deep: true,
        filter(newValue) {
            this.userFilter = newValue;
            this.userChoice = [];
            for (let i = 0; i < Object.keys(this.userFilter).length; i++) {
                if (newValue['value'].length > 0) {
                    for (let j = 0; j < newValue['value'].length; j++) {
                        if (!this.userChoice.includes(newValue['value'][j])) {
                            this.userChoice.push(newValue['value'][j]);
                        }
                    }
                } 
            }
            
            axios.get('/api/restaurants')
            .then((response) => {
                this.restaurants = response.data.results;
            })
            this.updatePost();
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

