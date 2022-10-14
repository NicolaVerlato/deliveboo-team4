<template scoped>

    <div>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #fea543; color: white;">
                <div class="container">
                   <a class="mx-auto" href="/">
                    <img 
                        src="../../public/images/logo-header.png" 
                        alt="logo" 
                        class="bounce-in-top"
                        style="height: 200px; object-fit: contain;"
                    >
                   </a>
             
                    <div class="navbar-nav align-center align-items-center">
                    <!-- <h3>Il codice del gusto</h3> -->
                        
                        <!-- <router-link 
                            style="font-size: 20px;"
                            class="header-links"
                            v-for="(link, index) in links" 
                            :key="index" 
                            :to="link.name"> {{link.label}} 
                        </router-link> -->

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

    .bounce-in-top{
        animation:bounce-in-top 1.5s both
    }    
    @keyframes bounce-in-top {
        0%{transform:translateY(-500px);animation-timing-function:ease-in;opacity:0}
        38%{transform:translateY(0);animation-timing-function:ease-out;opacity:1}
        55%{transform:translateY(-65px);animation-timing-function:ease-in}
        72%{transform:translateY(0);animation-timing-function:ease-out}
        81%{transform:translateY(-28px);animation-timing-function:ease-in}
        90%{transform:translateY(0);animation-timing-function:ease-out}
        95%{transform:translateY(-8px);animation-timing-function:ease-in}
        100%{transform:translateY(0);animation-timing-function:ease-out}
    }
    .navbar {
        justify-content: space-between;

    }
    .navbar .container {
        color: white;
    }
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