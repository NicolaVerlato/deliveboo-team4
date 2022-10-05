<template>


    <div class="container">
        <div class="d-flex justify-content-center flex-wrap">
            <div v-for="(singleObj, index) in dishes" :key="singleObj.id">
                <div v-for="ciao in singleObj" :key="ciao.id">
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ciao.name}}</h5>
                            <p class="card-text">{{ciao.price}}&euro;</p>
                            <div @loadstart="ciao(index, ciao.price)"></div>
                        </div>
                        <label :for="ciao.id">Quantità prodotto</label>
                        <input type="number" :name="ciao.id" :id="ciao.id" @change="event => getValue(event, ciao.price)">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a style="color: white; font-size: 30px;" href="http://127.0.0.1:8000/orders/create"> 
            Completa pagamento 
            </a>
        </div>
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
                userInput: 0
            }
        },
        methods: {
            ciao(a, b) {
                console.log(a, b)
            },
            getValue(event, price) {
                // console.log(price)
                // console.log(event.target.valueAsNumber)
                if(event.target.valueAsNumber > this.userInput) {
                    this.userInput = event.target.valueAsNumber
                    this.calcPrice = 0
                    this.calcPrice = parseInt(price) * event.target.valueAsNumber;
                    return this.calcPrice
                } else {
                    console.log('minore')
                }
                console.log('totale', this.total)
            },
            getInfo() {
                for (const [key, value] of Object.entries(localStorage)) {
                    this.dish_id.push(key);
                    this.restaurant_id.push(value);
                }
                this.printDishes();
            },
            printDishes() {
                this.dish_id.forEach((element, index) => {
                    if (index == 0) {
                        return;
                    } else {
                        axios.get(`/api/dishes/${element}`)
                        .then((response) => {
                        this.dishes.push(response.data.results);
                    })
                }
                });
            }
        },
        mounted() {
            this.getInfo();
        },
    }
</script>