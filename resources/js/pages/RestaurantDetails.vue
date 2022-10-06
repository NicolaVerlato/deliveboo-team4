<template>

    <div>
        <div class="card mb-3">

            <div class="card-header d-flex align-items-center justify-content-center">
                <h2 class="card-title text-center" style="margin: 0 !important;"> {{restaurant.name}} </h2>
            </div>


            <div v-if="restaurant.user_id">
                <h4 class="text-center mt-4">Il nostro menù</h4>


                <div v-for="dish in dishes" :key="dish.id" class="mb-3">
                    <div v-if="dish.is_visible == 1">
                        <div v-if="restaurant.user_id == dish.restaurant_id">

                            <div class="card-body d-flex justify-content-around">

                                <div>
                                    <h5 class="card-title text-center"> Piatto: {{dish.name}} </h5>

                                    <p class="card-text text-center"> Prezzo: {{dish.price}} &euro;</p>
                                </div>
                                
                                <!-- <div>
                                    <a @click="sendInfo(dish.id, dish.restaurant_id, dish.price)" class="btn btn-light"> Aggiungi </a>
                                </div> -->
                                <div>
                                    <i @click="decrement(dish.id)" class="fa-solid fa-minus"></i>
                                    <span :id="dish.id" class="counter">0</span>
                                    <i @click="increment(dish.id, restaurant.slug, dish.price)" :id="dish.id" class="fa-solid fa-plus"></i>
                                </div>
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
                dishes: [],
                dishesidArray: [],
                basket: JSON.parse(localStorage.getItem("data")) || [],
            }
        },
        methods: {
            checkAmount(a) {
                let search = this.basket.find((x)=>x.id === a) || [];
                console.log(search)
            },
            increment(a, slug, price) {
                let counter = this.$el.querySelector(".counter").innerHTML
                let search = this.basket.find((x)=>x.id === a)
                if(search === undefined) {
                    this.basket.push({
                        id: a,
                        item: 1,
                        slug: slug,
                        price: price
                    })
                } else {
                    search.item += 1
                }

                localStorage.setItem("data", JSON.stringify(this.basket))
                this.updateCart(a)
            },
            decrement(a) {
                let counter = this.$el.querySelector(".counter").innerHTML
                let search = this.basket.find((x)=>x.id === a)
                if(search === undefined) {
                    return
                } else if (search.item === 0) {
                    return
                } else {
                    search.item -= 1
                }
                this.updateCart(a)

                this.basket = this.basket.filter((x)=>x.item !== 0)

                localStorage.setItem("data", JSON.stringify(this.basket))
            },
            updateCart(id) {
                let search = this.basket.find((x)=>x.id === id)
                document.getElementById(id).innerHTML = search.item
            },
            loadingCart() {
                this.basket.forEach(element => {
                    document.getElementById(element.id).innerHTML = element.item
                });
            },
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
            sendInfo(value, restaurantId, price) {
                if (localStorage.length == 0) {
                    localStorage.setItem('slug', this.restaurant.slug);
                    // localStorage.setItem('price', this.restaurant.slug);
                    localStorage.setItem(value, restaurantId);
                };
                console.log(price)
                if (localStorage.length > 1) {
                    if (localStorage.getItem('slug') == this.restaurant.slug) {
                        localStorage.setItem(value, restaurantId);
                    } else {
                        if (confirm("Sei sicuro di voler aggiungere un piatto di un altro ristorante? I piatti presenti nel tuo carrello verranno sovrascritti") == true) {
                            localStorage.clear();
                            localStorage.setItem('slug', this.restaurant.slug);
                            localStorage.setItem(value, restaurantId);
                        } else {
                            console.log('mantieni i dati');
                        }
                    }
                };
            }
        },
        mounted() {
            this.getRestaurant();
            this.getDishes();
        },
        updated() {
            this.loadingCart()
        },
    }

</script>

<style lang="scss" scoped>

    @import '../../sass/partials/variables.scss';

    .card {
        width: 800px;
        margin: 0 auto;
    }
</style>