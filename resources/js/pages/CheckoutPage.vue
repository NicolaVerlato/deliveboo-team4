<template>


    <div class="container" style="height: 330px">
        <div id="label">

        </div>
        <div  id="shopping-cart">

        </div>
        <div v-if="allSearch" class="row">
            <div v-for="dish in allSearch" :key="dish.id"> 
                <div v-for="singleDish, index in dish" :key="singleDish.id">
                    <div v-if="index == 'piatto'">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                        <h5 class="card-title">{{singleDish.name}}</h5>
                        <p class="card-text">{{singleDish.price * dish.quantita}}&euro;</p>
                        <div>
                        
                                    <i @click="decrement(singleDish.id)" class="fa-solid fa-minus"></i>
                                    <span :id="singleDish.id" class="counter">0</span>
                                    <i @click="increment(singleDish.id)" :id="singleDish.id" class="fa-solid fa-plus"></i>
                                </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div v-else>
            vuoto
        </div>
        <div @click="calcolaPrice()">aa</div>

        <a style="color: white; font-size: 30px;" @click="calcolaPrice(), emptyCart()" :href="'http://127.0.0.1:8000/orders/create/' + this.calcolo + '/' + this.basket[0].id + '/' + this.allDishesIds + '/' + this.allQuantity"> 
            Completa pagamento 
            </a>
    </div>

</template>

<script>
    
    export default {
        name: "CheckoutPage",
        data() {
            return {
                dish_id: [],
                restaurant_id: [],
                dishesArray: [],
                dishes: [],
                calcPrice: 0,
                total: 0,
                userInput: 0,
                basket: JSON.parse(localStorage.getItem("data")) || [],
                allSearch: [],
                cartDishes: [],
                testing: 0,
                partialTotal: 0,
                realTotal: 0,
                prices: [],
                counter: 1,
                calcolo: 0,
                allDishesIds: '',
                allQuantity: ''
            }
        },
        methods: {
            
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
                this.allSearch.forEach(element => {
                    let prezzo = parseInt( element.piatto.price)
                    let quantita = parseInt( element.quantita )
                    this.calcolo += prezzo * quantita

                    });
                    this.calcolo = this.calcolo * 2353699835353;
                    this.calcolo = this.calcolo / 100;
                    this.calcolo = this.calcolo * 23425232;
            },
            async getDishes() {
                await axios.get(`/api/restaurants/${this.basket[0].slug}`)
                .then((response) => {
                    let ciao = response.data.results
                    for (let i = 0; i < Object.keys(ciao).length; i++) {
                        this.dishes.push(Object.values(ciao)[i]);
                    }
                })
            },
            generateCartItems() {
                let ShoppingCart = document.getElementById('shopping-cart')
                let label = document.getElementById('label')
                if(this.basket.length !== 0) {
                   return ShoppingCart.innerHTML = this.basket.map((x)=>{
                    let {id, item} = x;
                    let search = this.dishesArray.find((y)=>y.id === id ) || []
                    let qntDish = {'quantita': x.item, 'piatto': search}
                    this.allSearch.push(qntDish);

                    this.getValue(id, item)
                   }).join('')
                } else {
                    ShoppingCart.innerHTML = ``
                    label.innerHTML = `
                    <h2>Carrello vuoto</h2>
                    `
                }
                this.calcolaPrice()
            },
            async getValue(dishId, quantity) {
                await axios.get(`/api/dishes/${dishId}`)
                    .then((response) => {
                    let price = response.data.results[0].price
                    if(this.counter > 1) {
                        this.partialTotal = parseInt(price) + parseInt(price)
                        this.counter ++
                    } else {
                        this.partialTotal = price * quantity  
                    }
                    this.prices.push(this.partialTotal)
                })
            },
            updateCart(id) {
                let search = this.basket.find((x)=>x.id === id)
                document.getElementById(id).innerHTML = search.item
                this.getValue(id, search.item)
                this.allSearch = []
                this.generateCartItems()
                
            },
            getInfo() {
                for (const [key, value] of Object.entries(localStorage)) {
                    this.dish_id.push(key);
                    this.restaurant_id.push(value);
                }
                this.printDishes();
            },
            printDishes() {
                this.basket.forEach((element, index) => {
                    axios.get(`/api/dishes/${element.id}`)
                    .then((response) => {
                    this.dishesArray.push(response.data.results[0]);
                })

                });
            },
            increment(a) {
                let counter = this.$el.querySelector(".counter").innerHTML
                let search = this.basket.find((x)=>x.id === a)
                if(search === undefined) {
                    this.basket.push({
                        id: a,
                        item: 1
                    })
                } else {
                    search.item += 1
                }

                this.updateCart(a)
                localStorage.setItem("data", JSON.stringify(this.basket))
            },
            decrement(a) {
                let counter = this.$el.querySelector(".counter").innerHTML
                let search = this.basket.find((x)=>x.id === a)
                if(search.item === undefined) {
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
            loadingCart() {
                this.basket.forEach(element => {
                    document.getElementById(element.id).innerHTML = element.item
                });
            },
        },
        mounted() {
            this.getDishes();
            this.getInfo();
            setTimeout(() => this.generateCartItems(), 1500);
            this.getAllDishesIds()
        },
        updated() {
            this.loadingCart()
        },
    }
</script>