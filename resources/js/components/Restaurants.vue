<template>
    <section class="mt-4">
        <h2 class="text-center" style="color:white; font-size: 30px; margin-bottom: 40px;">
            Lista dei ristoranti
        </h2>

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
                        <h5 class="card-title">{{restaurant.name}}</h5>
                        <!--<p>{{restaurant.type_id}}</p>-->
                        <p class="card-text">Indirizzo: {{restaurant.address}}</p>
                        <a href="#" class="btn btn-primary">Dettagli</a>
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
            restaurants: []
        };
    },
    mounted() {
        axios.get('/api/restaurants')
        .then((response) => {
               this.restaurants = response.data.results;
        });
    }
}
</script>

