<template>


    <div class="container" style="height: 330px">

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <div v-for="item in dishes" :key="item.id"> 
                    <div v-for="ciao in item" :key="ciao.id">
                        <h5 class="card-title">{{ciao.name}}</h5>
                        <p class="card-text">{{ciao.price}}&euro;</p>
                    </div>
                </div>
            </div>
        </div>


        <a style="color: white; font-size: 30px;" href="http://127.0.0.1:8000/orders/create"> 
            Completa pagamento 
        </a>
    </div>

</template>

<script>

    export default {
        name: "HomePage",
        data() {
            return {
                dish_id: [],
                restaurant_id: [],
                dishesArray: [],
                dishes: []
            }
        },
        methods: {
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