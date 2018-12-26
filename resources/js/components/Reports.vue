<template>
    <div>
        <h1>Reports</h1>
        <p>Список пользователей:</p>
        <ul class="users">
            <li v-for="item in data" :key="item.id" @click="form.name = item.name, submit()">
                <a class="btn btn-info">{{ item.name }}</a>
            </li>
        </ul>
        <form action="" style="display:flex" @submit.prevent="submit()">
            <input class="form-control" style="width:200px;" v-model="form.name" type="text" placeholder="Вветиде имя">
            <input id="number" type="date" style="width:200px;" v-model="form.date_from" class="form-control">
            <input id="number" type="date" style="width:200px;" v-model="form.date_to" class="form-control">

            <button class="btn btn-success">Найти</button>
        </form>
        <div class="info" v-if="user != ''">
            <a :href="`/api/users/${form.name}?${form.date_from}&${form.date_to}&export=true`"  class="btn btn-danger" style="margin:20px 0 20px 0;">Скачать Excel</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Значение ({{ user.currency.code }})</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Баланс</td>
                        <td>{{ user.money || 0}}</td>
                    </tr>
                    <tr>
                        <td>Пополнено</td>
                        <td>{{ user.balance || 0}}</td>
                    </tr>
                    <tr>
                        <td>Переведено</td>
                        <td>{{ user.forwarded || 0}}</td>
                    </tr>
                    <tr>
                        <td>Получено</td>
                        <td>{{ user.received || 0}}</td>
                    </tr>
                </tbody>
            </table>

            <items :data="user" />
        </div>

    </div>
</template>

<script>
    import Items from './Items'

    export default {
        props: ['data'],
        data() {
            return {
                user: [],
                form: {
                    name: '',
                    date_from: '',
                    date_to: ''
                }
            }
        },
        methods: {
            submit() {
                axios.get('/api/users/' + this.form.name, {
                        params: {
                            date_from: this.form.date_from,
                            date_to: this.form.date_to
                        }
                    })
                    .then(res => {
                        this.user = res.data
                    })
                    .catch(err => {
                        alert('Такого пользователя не существует')
                    })
            }
        },
        components: {
            Items
        }
    }

</script>

<style scoped>
    .users {
        padding: 0;
    }

    .users li {
        display: inline-block;
        margin: 5px;
    }

</style>
