<template>

    <div>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #fea543; color: white;">
                <div class="container-fluid">
                    <h2 class="navbar-brand col-sm-3 col-md-2 mr-0">
                        <strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i></strong>
                    </h2>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            
                            <router-link 
                                class="header-links"
                                v-for="link, index in links" 
                                :key="index" 
                                :to="link.name"> {{link.label}} 
                            </router-link>
                            
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="container mt-4">
                <router-view></router-view>
            </div>
        </main>
    </div>

</template>

<script>

    export default {
        name: "App",
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