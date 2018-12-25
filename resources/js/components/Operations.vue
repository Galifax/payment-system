<template>
    <div>
        <h3>Операции</h3>
         <form @submit.prevent="submit()">
            <div class="form-group row">
                <label for="number" class="col-md-4 col-form-label text-md-right">Дата от</label>
                <div class="col-md-6">
                    <input id="number" type="date" v-model="form.date_from" class="form-control">
                </div>

                <label for="number" class="col-md-4 col-form-label text-md-right">Дата до</label>
                <div class="col-md-6">
                    <input id="number" type="date" v-model="form.date_to" class="form-control" >
                </div>
                <button class="btn btn-success">
                    Отправить
                </button>
            </div>
        </form>
        <items :data="$store.state.operations"/>
    </div>
</template>

<script>
import Items from './Items'
export default {
    props: ['user'],
    data () {
        return {
            form: {
                date_from: '',
                date_to: ''
            }
        }
    },
    methods: {
        submit () {
            axios.get('/api/users/' + this.user.id, {
                params: {
                    date_from: this.form.date_from,
                    date_to: this.form.date_to
                }
            })
                .then(res => {
                    console.log(res.data)
                    this.$store.state.operations = res.data
                })
        }
    },
    async mounted () {
        await axios.get('/api/users/' + this.user.id)
            .then(res => {
                this.$store.state.operations = res.data
            })
    },
    components: {
        Items
    }
}
</script>

<style>

</style>
