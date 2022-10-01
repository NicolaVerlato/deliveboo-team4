<template>
    <section class="text-center" style="margin-bottom: 40px;">
        <h2 style="color:white; font-size: 30px; margin-bottom: 20px;">Tipologie ristoranti</h2>
        <!--Checkbox types-->
            <div v-for="restaurantType in types" :key="restaurantType.id" class="form-check form-check-inline"  style="color:white;">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    :name="restaurantType.name" 
                    :id="'id-' + restaurantType.id" 
                    :value="restaurantType.id"
                    @change="filterRestaurant($event)">

                <label 
                    class="form-check-label" 
                    :for="'id-' + restaurantType.id">
                    {{ restaurantType.name }}
                </label>
            </div>

    </section>
</template>

<script>
export default {
    name: 'Types',
    data() {
        return {
            types: [],
            filter: []
        };
    },
    methods: {
        filterRestaurant: function(e) {
        if(e.target.checked){
            this.filter.push(e.target.value)
            this.$emit('filterType', this.filter)
        }else{
           for (let i = 0; i < this.filter.length; i++) {
                if (this.filter[i] == e.target.value) {
                    let filterIndex = this.filter.indexOf(e.target.value)
                    this.filter.splice(filterIndex, 1);
                }
           }
           this.$emit('filterType', this.filter)
        }
        
    }
    },
    mounted() {
        axios.get('/api/types')
        .then((response) => {
               this.types = response.data.results;
        });
    }
}
</script>

