<template>

    <div class="container wrapper">
        <div class="row row-col-auto">
            <div class="card mb-3">

                <div class="card-header d-flex align-items-center justify-content-center">
                    <h2 class="card-title text-center" style="margin: 0 !important;"> {{restaurant.name}} </h2>
                </div>


                <div v-if="this.counter > 0">
                    <h4 class="text-center mt-4">Il nostro menù</h4>

                    <!-- Dishes section -->
                    <div v-for="dish in dishes" :key="dish.id" class="mb-3">
                        <div v-if="dish.is_visible == 1">
                            <div v-if="restaurant.user_id == dish.restaurant_id">
                                <div class="card-body d-flex justify-content-between">

                                    <div>
                                        <div v-if="dish.cover">
                                            <img 
                                            class="card-img-left"  
                                            :src="'storage/' + dish.cover" 
                                            :alt="dish.title">
                                        </div>
                                        <h5 class="card-title text-center"> {{dish.name}} </h5>

                                        <p class="card-text text-center"> Prezzo: {{dish.price}} &euro;</p>
                                    </div>
                                    
                                    <!-- <div>
                                        <a @click="sendInfo(dish.id, dish.restaurant_id, dish.price)" class="btn btn-light"> Aggiungi </a>
                                    </div> -->
                                    <div class="ms_quantities">
                                        <i @click="decrement(dish.id)" class="fa-solid fa-minus"></i>
                                        <span :id="dish.id" class="counter">0</span>
                                        <i @click="increment(dish.id, restaurant.slug, dish.price)" :id="dish.id" class="fa-solid fa-plus"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- If there are no dishes -->
                <div v-else> 
                <p class="btn" style="padding: 20px">
                        Al momento non ci sono piatti disponibili. 
                        Torna alla 
                        <a style="color:white; padding: 20px 0;" href="/"> 
                            Home 
                        </a>
                </p>
                </div>
            </div>


            <div v-if="this.basket.length > 0" class="cart-preview">
                
                <div class="toast">

                    <div class="toast-header justify-content-center">
                        <h5> Il tuo carrello </h5>
                    </div>

                    <div class="toast-body">
                        <!-- For each item of the basket -->
                        <div v-for="item in basket" :key="item.id" class="mb-3">
                            <!-- <div v-if="restaurant.user_id == item.restaurant_id"> -->

                                <div class="card-body d-flex">

                                    <div v-for="dish in dishes" :key="dish.id">
                                        <div v-if="dish.id == item.id">                                            
                                            <h5 class="card-title text-left"> {{dish.name}} </h5>
                                            <div v-for="restaurant in restaurants" :key="restaurant.id">
                                                <h6 v-if="restaurant.id == dish.restaurant_id">{{restaurant.name}}</h6>
                                            </div>
                                            <!-- <h6> Ristorante: {{restaurant.name}} </h6> -->
                                            <div @click="getAllDishesIds()"> Quantità: {{item.item}}</div>
                                        </div>
                                    </div>
                                    
                                </div>
                            <!-- </div> -->
                        </div>

                        <div class="btn btn-lg btn-cart">
                            <!-- <a href="/carrello"> Vai al carrello </a> -->
                            <a style="color: white; font-size: 30px;" @click="calcolaPrice(), emptyCart()" :href="'http://127.0.0.1:8000/orders/create/' + this.calcolo + '/' + this.basket[0].id + '/' + this.allDishesIds + '/' + this.allQuantity"> 
                                Completa pagamento 
                            </a>
                        </div>
                    </div>
                </div> 
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
                calcolo: 0,
                allDishesIds: '',
                allQuantity: '',
                counter: 0,
                restaurants: [],
                calcoloShow: 0
            }
        },
        methods: {
            async countDishesForMenu() {
                await this.dishes.forEach(element => {
                    if (element.restaurant_id == this.restaurant.id) {
                        if (element.is_visible == 1) {
                            this.counter += 1
                        }
                    }
                });

            },
            getAllDishesIds() {
                this.basket.forEach(element => {
                    let id = element.id
                    let amount = element.item
                    this.allDishesIds +=  id + '-'
                    this.allQuantity += amount + '-'
                });
            },
            emptyCart() {
                localStorage.clear();
            },
            calcolaPrice() {
                    for (let i = 0; i < this.basket.length; i++) {
                        let prezzo = parseInt( this.basket[i].price)
                        let quantita = parseInt( this.basket[i].item )
                        this.calcolo += prezzo * quantita
                    }
                    this.calcolo = this.calcolo * 2353699835353;
                    this.calcolo = this.calcolo / 100;
                    this.calcolo = this.calcolo * 23425232;
                    this.getAllDishesIds();
            },
            calcolaPrezzoCarrello() {
                this.calcoloShow = 0;
                for (let i = 0; i < this.basket.length; i++) {
                        let prezzo = parseInt(this.basket[i].price)
                        let quantita = parseInt(this.basket[i].item)
                        this.calcoloShow += prezzo * quantita
                    }
                    return this.calcoloShow;
            },
            checkAmount(a) {
                let search = this.basket.find((x)=>x.id === a) || [];
            },
            increment(a, slug, price) {
                let counter = this.$el.querySelector(".counter").innerHTML
                let search = this.basket.find((x)=>x.id === a)
                // se il carrello non è vuoto
                if(this.basket.length > 0) {
                    // se lo slug del ristorante attuale non corrisponde a quello nel carrello
                    if(slug !== this.basket[0].slug) {
                        // se conferma svuoto carrello e metto solo questo piatto
                        if(confirm('Si possono ordinare piatti solo da un ristorante. Se prosegui il carrello verrà svuotato e sostituito solo con questo piatto.')) {
                            window.localStorage.clear(); 
                            this.basket = [];
                            this.basket.push({
                                id: a,
                                item: 1,
                                slug: slug,
                                price: price
                        })
                        localStorage.setItem("data", JSON.stringify(this.basket))
                        this.updateCart(a)
                        return
                        } else return
                }}
                if(search === undefined) {
                    this.basket.push({
                        id: a,
                        item: 1,
                        slug: slug,
                        price: price
                    })
                } else {
                    if(search.item < 9) {
                        search.item += 1
                    } else {
                        alert('Il quantitativo massimo di ordini per ciascun piatto è 9!')
                    }
                }

                this.updateCart(a)
                localStorage.setItem("data", JSON.stringify(this.basket));
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
                document.getElementById(id).innerHTML = search.item;
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
                if (localStorage.length > 1) {
                    if (localStorage.getItem('slug') == this.restaurant.slug) {
                        localStorage.setItem(value, restaurantId);
                    } else {
                        if (confirm("Sei sicuro di voler aggiungere un piatto di un altro ristorante? I piatti presenti nel tuo carrello verranno sovrascritti") == true) {
                            localStorage.clear();
                            localStorage.setItem('slug', this.restaurant.slug);
                            localStorage.setItem(value, restaurantId);
                        } else {
                            
                        }
                    }
                };
            }
        },
        mounted() {
            this.getRestaurant();
            this.getDishes();
            setTimeout(() => this.countDishesForMenu(), 1000);
            axios.get('/api/restaurants')
            .then((response) => {
                this.restaurants = response.data.results;
            });  
            this.calcolaPrezzoCarrello();
        },
        updated() {
            this.loadingCart()
        },
    }
</script>

<style lang="scss" scoped>

@import '../../sass/partials/variables.scss';

    .card {
        width: 450px;
        max-width: 600px;
        margin: 0 auto;
    }
    .ms_quantities {
        line-height: 8;
        font-size: 1.5rem;
    }
    .cart-preview {
        // position: absolute;
        // top: 100px;
        // right: 30px;
        .toast {
            opacity: 1;
            animation: fadeAbout 1s;
            @keyframes fadeAbout {
                0% { opacity: 0; }
                100% { opacity: 1; }
            }
        }
        .btn {
                display: block !important;
            }
        .btn-cart {
            background-color: $brand-color;
            margin: auto;
         
            a {
                color: white;
            }
        }
    }
</style>