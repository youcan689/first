<template>
    <v-card>
        <v-card-title>
            Products
            <v-spacer v-for="spacer_i in 6" :key="spacer_i"></v-spacer>
            <v-text-field single-line hide-details v-model="search"
                append-icon="search" label="Search">
            </v-text-field>
        </v-card-title>

        <v-data-table show-select multi-sort class="elevation-1" v-model="selected"
            :headers="headers" :items="products" :search="search" item-key="id"
            :footer-props="{
                showFirstLastPage: true,
                showCurrentPage: true,
                firstIcon: 'first_page',
                lastIcon: 'last_page',
                prevIcon: 'navigate_before',
                nextIcon: 'navigate_next',
                itemsPerPageOptions: [10, 20, 50, 100, -1],
            }">
            <template v-slot:item.published="{ item }">
                <v-chip label small :class="'white--text'"
                    style="font-weight: 600; min-width: 4em;"
                    :color="(item.published != 0 ? 'blue' : 'red') + ' darken-1'"
                    v-text="item.published != 0 ? '已上架' : '未上架'">
                </v-chip>
            </template>

            <template v-slot:item.price="{ item }">
                <div style="min-width: 4em;" v-text="item.price">
                </div>
            </template>

            <template v-slot:item.updated_at="{ item, value }">
                <div style="min-width: 10em;" v-text="value.slice(0, value.length - 4)">
                </div>
            </template>

        </v-data-table>

    </v-card>
</template>

<script>
module.exports = {
    data: function() {
        return {
            selected: [],
            search: '',
            headers: [
                {
                    text: 'product no.',
                    value: 'id',
                    align: 'start',
                    sortable: false,
                },
                {
                    text: '商品名稱',
                    align: 'start',
                    sortable: false,
                    value: 'title',
                },
                { text: '描述', value: 'description', sortable: false, },
                { text: '價格 (US $)', value: 'price', align: 'end', sort: (a, b) => a - b, },
                { text: '上架狀態', value: 'published', align: 'center', },
                { text: '商品更新日期', value: 'updated_at', align: 'end', },
            ],
        };
    },
    props: {
        products: {
            default: () => [],
            type: Array,
        }
    },
    methods: {

    },
}
</script>

<style scoped>

</style>
