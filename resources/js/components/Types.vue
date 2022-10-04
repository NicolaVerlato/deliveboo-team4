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
                    v-model="vmodelFilter"
                    @change="update()">

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
            filter: [],
            vmodelFilter: []
        };
    },
    methods: {
        update() {
            this.$emit('filterType', this.vmodelFilter)
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

