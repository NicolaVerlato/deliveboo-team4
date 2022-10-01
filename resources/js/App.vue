<template>

    <div>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #fea543; color: white;">
                <div class="container-fluid">
                    <h2 class="navbar-brand col-sm-3 col-md-2 mr-0" style="font-size: 35px;">
                        <strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i></strong>
                    </h2>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav align-center">
                            
                            <router-link 
                                style="font-size: 20px;"
                                class="header-links"
                                v-for="(link, index) in links" 
                                :key="index" 
                                :to="link.name"> {{link.label}} 
                            </router-link>

                            <a class="header-links" style="color: white; font-size: 20px; margin-left: 15px;" href="http://127.0.0.1:8000/login"> Sezione ristoranti </a>
                        </div>

                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div>
                <router-view></router-view>
            </div>
            <Types />
            <Restaurants />
        </main>

        <footer style="height: 300px; background-color: #2f4858; color: white">
            <h4 style="font-size: 30px; padding: 80px 0; text-align: center;"> Qui footer con link vari </h4>
        </footer>
    </div>

</template>

<script>
import Restaurants from './components/Restaurants.vue';
import Dishes from './components/Dishes.vue';
import Types from './components/Types.vue';

    export default {
        name: "App",
        components: {
            Restaurants,
            Dishes,
            Types
        },
        data() {
            return {
                links: [
                    {
                        name: '/',
                        label: 'Home'
                    },
                    {
                        name: 'carrello',
                        label: 'Carrello'
                    },
                ]
            }
        },
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
</style>