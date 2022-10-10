<template>

    <div>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #fea543; color: white;">
                <div class="container-fluid">
                    <h2 class="navbar-brand col-sm-3 col-md-2 mr-0" style="font-size: 35px;">
                        <strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i></strong>
                    </h2>
             
                    <div class="navbar-nav align-center align-items-center">
                        
                        <router-link 
                            style="font-size: 20px;"
                            class="header-links"
                            v-for="(link, index) in links" 
                            :key="index" 
                            :to="link.name"> {{link.label}} 
                        </router-link>

                        <!-- In un mondo ideale contiene la somma degli elementi del carrello, sempre aggiornato -->
                        <!-- <span 
                        class="top-0 start-100 translate-middle p-2 border border-light rounded-circle"
                        style="width: 40px; height: 40px; text-align: center; margin-left: 10px;">
                            <span class="visually-hidden"> {{checkoutAmount}} </span>
                        </span> -->
                      
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div>
                <router-view></router-view>
            </div>
        </main>

        <footer>
            <Footer/>
        </footer>
    </div>

</template>

<script>

    import Footer from './components/Footer.vue';
    import RestaurantDetails from './pages/RestaurantDetails.vue';

    export default {
        name: "App",
        components: { Footer, RestaurantDetails },
        data() {
            return {
                checkoutAmount: 0,
                links: [
                    {
                        name: "/",
                        label: "Home"
                    },
                ]
            };
        },
        methods: {
            sendInfo(value) {
                console.log(value);
            }
        },
        // methods: {
        //     incrementAmount() {
        //         let value = this.checkoutAmount;
        //         value++;
        //         this.checkoutAmount = value;
        //     }
        // },
    }

</script>

<style lang="scss">

    header {
        nav {
            .navbar-brand {
                font-size: 24px;
            }
            .header-links {
                color: white;
                margin-left: 15px;
            }
        }
    }

    footer {
        background-color: #2f4858; 
        color: white;
    }

</style>