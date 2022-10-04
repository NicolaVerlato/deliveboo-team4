import Vue from 'vue';
import VueRouter from 'vue-router';

// Import the page-components
import HomePage from "./pages/HomePage.vue";
import CheckoutPage from "./pages/CheckoutPage.vue";
import RestaurantDetails from "./pages/RestaurantDetails.vue";

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
        { path: '/:slug', 
        component: RestaurantDetails,
        name: 'restaurant-details' 
        }
    ]
});

export default router;