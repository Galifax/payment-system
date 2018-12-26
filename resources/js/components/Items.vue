<template>
    <div>
        <div class="row">
            <div class="col col-xs-12 col-md-6">
                <h2>Мои операции</h2>
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
            </div>
            <div class="col col-xs-12 col-md-6">
                <h2>Операции пользователей с моим кошельком</h2>
                <ul>
                    <li v-for="item in data.forwards" :key="item.id">
                        {{ item.created_at }} Перевод денег на суму {{ item.summ }} {{ item.user_recipient.currency.code }}
                        (Конвертация: {{ item.conversion }} {{ data.currency.code }}).
                        Отправитель: {{ item.user_recipient.name }}
                    </li>
                </ul>
            </div>
        </div>

    </div>
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
        border: 1px solid gray;
        border-radius: 5px;
        padding: 5px;
        margin-top: 5px;
        background: white;
    }

</style>
