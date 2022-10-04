<template>


    <div class="container" style="height: 330px">

     
        <p v-for="item in dishes" :key="item.id"> 
            <!-- To fix -->
            {{item}}   
        </p>


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
                        console.log('skip');
                        return;
                    } else {
                        axios.get(`/api/dishes/${element}`)
                        .then((response) => {
                        this.dishes.push(response.data.results);
                        console.log('ok');
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