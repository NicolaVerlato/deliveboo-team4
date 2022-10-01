<template>
    <section>
        <h2>Tipologie ristoranti</h2>
        <!--Checkbox types-->
            <div v-for="type in types" :key="type.id" class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">{{ type.name }}</label>
            </div>

    </section>
</template>

<script>
export default {
    name: 'Types',
    data() {
        return {
            types: []
        };
    },
    mounted() {
        axios.get('/api/types')
        .then((response) => {
               this.types = response.data.results;
        });
    }
}
</script>

