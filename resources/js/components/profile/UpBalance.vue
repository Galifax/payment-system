<template>
    <div>
        <h3>Пополнить баланс</h3>
        <form @submit.prevent="submit()">

            <div class="form-group row">
                <label for="number" class="col-md-4 col-form-label text-md-right">Количество единиц</label>
                <div class="col-md-6">
                    <input id="number" type="number" v-model="count" class="form-control"
                        name="number" required autofocus>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                count: 0
            }
        },
        methods: {
            submit() {
                axios.post('/api/up-balance', {
                    summ: this.count,
                    user_id: this.user.id
                })
                    .then(res => {
                        alert('Баланс пополен');
                        this.$store.state.balance = res.data.money
                        this.count = 0;
                    })
                    .catch(err => {
                        alert(err.response.data.message)
                    })
            }
        }
    }

</script>

<style>
h3 {
    text-align: center;
}
</style>
