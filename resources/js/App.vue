<template>

    <div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"> Deliveboo </a>
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