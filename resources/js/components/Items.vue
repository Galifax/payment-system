<template>
    <ul>
        <li v-for="item in data.operations" :key="item.id">
            <span v-if="item.status == 0">
                {{ item.created_at }} Пополление баланса на <span style="color: green; font-weight: 900; text-decoration: underline; font-style: italic">
                    {{item.summ }} {{ data.currency.code }}
                </span>
            </span>
            <span v-if="item.status == 1">
                {{ item.created_at }} Перевод денег на суму <span style="color: green; font-weight: 900; text-decoration: underline; font-style: italic">
                    {{ item.summ }} {{ data.currency.code }}
                    <span v-if="item.conversion">
                        (Конвертация: {{ item.conversion }} {{ item.user.currency.code }})
                    </span></span>, получатель: <span style="color: red; font-weight: 900; text-decoration: underline; font-style: italic">
                    {{ item.user ? item.user.name : '' }}
                </span>
            </span>
        </li>
    </ul>

</template>

<script>
    export default {
        props: ['data']
    }

</script>

<style scoped>
ul {
    margin-top: 20px;
    padding: 0;
}
ul li {
    list-style-type: none;
}
</style>
