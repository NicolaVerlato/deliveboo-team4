import Vue from 'vue';
import VueRouter from 'vue-router';

// Import the page-components
import HomePage from "./pages/HomePage.vue";
import CheckoutPage from "./pages/CheckoutPage.vue";

Vue.use(VueRouter);

// Create a route foreach page-component
const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', 
        component: HomePage,
        name: 'home' 
        },
        { path: '/carrello', 
        component: CheckoutPage,
        name: 'carrello' 
        },

    ]
});

export default router;