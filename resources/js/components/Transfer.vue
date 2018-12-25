<template>
    <div>
        <h3>Перевод денег</h3>

        <form @submit.prevent="submit()">
            <div class="form-group row">
                <label for="number" class="col-md-4 col-form-label text-md-right">Получатель</label>
                <div class="col-md-6">
                    <select id="number" type="number" v-model="form.recipient_id" class="form-control" 
                        required>
                        <option selected>Выберите получателя</option>
                        <option v-for="item in users" :key="item.id" :value="item.id">{{ item.id }} {{ item.name }} <span v-if="user.id == item.id">(Вы)</span></option>
                    </select>
                </div>

                <label for="number" class="col-md-4 col-form-label text-md-right">Сума</label>
                <div class="col-md-6">
                    <input id="number" type="number" v-model="form.summ" class="form-control" required
                        autofocus>
                </div>
                <button class="btn btn-success">
                    Отправить
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['user', 'users'],
        data() {
            return {
                form: {
                    recipient_id: 0,
                    summ: 0,
                    user_id: this.user.id,
                    currency: this.user.currency_id
                },
            }
        },
        methods: {
            submit() {
                axios.post('/api/transfer', this.form)
                    .then(res => {
                        this.form.summ = 0
                        this.form.recipient_id = 0
                        alert('Ваши средства были перечислины')
                        this.$store.state.operations.operations.unshift(res.data)
                        this.$store.state.balance -= Number(res.data.summ)
                    })
                    .catch(err => {
                        alert(err.response.data.message)
                    })
            }
        }
    }

</script>

<style>

</style>
