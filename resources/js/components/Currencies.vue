<template>
    <div>
        <ul>
            <li v-for="item in currencies" :key="item.id">
                {{ item.code }} {{ item.exchanges ? item.exchanges.exchange : 1 }}
            </li>
            <li>
                <input type="date" v-model="date" @change="submit()">
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                date: '',
                currencies: []
            }
        },
        methods: {
            submit () {
                axios.get('/api/currencies/' + this.date)
                    .then(res => {
                        this.currencies = res.data
                    })
            }
        },
        mounted() {
            axios.get('/api/currencies')
                .then(res => {
                    this.currencies = res.data
                })
        }
    }

</script>

<style scoped>
ul li {
    display: inline-block;
    margin: 10px;
}
</style>
