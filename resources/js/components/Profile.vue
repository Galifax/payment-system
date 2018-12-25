<template>
    <div>
        Баланс: {{ $store.state.balance }}
        <up-balance :user="user" />

        <transfer :user="user" :users="users"/>

        <operations :user="user" />

    </div>    
</template>

<script>
import UpBalance from './profile/UpBalance'
import Transfer from './Transfer'
import Operations from './Operations'

export default {
    props: ['user', 'users'],
    data () {
        return {
        }
    },
    created () {
        this.$store.state.balance = this.user.money
    },
    components: {
        UpBalance,
        Transfer,
        Operations
    }
}
</script>

<style>

</style>
