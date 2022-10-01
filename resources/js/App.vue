<template>

    <div>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #fea543; color: white;">
                <div class="container-fluid">
                    <h2 class="navbar-brand col-sm-3 col-md-2 mr-0" style="font-size: 35px;">
                        <strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i></strong>
                    </h2>
             
                    <div class="navbar-nav align-center">
                        
                        <router-link 
                            style="font-size: 20px;"
                            class="header-links"
                            v-for="(link, index) in links" 
                            :key="index" 
                            :to="link.name"> {{link.label}} 
                        </router-link>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div>
                <router-view></router-view>
            </div>
        </main>

        <footer style="background-color: #2f4858; color: white">
            <Footer/>
        </footer>
    </div>

</template>

<script>
import Footer from './components/Footer.vue';

    export default {
    name: "App",
    components: {Footer},
    data() {
        return {
            links: [
                {
                    name: "/",
                    label: "Home"
                },
                {
                    name: "carrello",
                    label: "Carrello"
                },
            ]
        };
    },
    components: { Footer }
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