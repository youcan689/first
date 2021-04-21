@extends('management/layout')

@section('title')
商品管理後台
@endsection

@section('body')
<div id="app">
<v-app id="appmain">
    <v-app-bar app flat color="white">
    <v-container class="py-0 fill-height">
        <v-avatar class="mr-10" color="grey darken-1" size="32"></v-avatar>

        <v-btn text>
            Tab
        </v-btn>

        <v-spacer></v-spacer>

        <v-responsive max-width="260">
            <v-text-field dense flat hide-details solo-inverted class="rounded-lg"></v-text-field>
        </v-responsive>
    </v-container>
    </v-app-bar>

    <v-content class="grey lighten-3">
    <v-container>
    <v-row>
        <v-col cols="2">
            <v-sheet rounded="lg">
                <v-list color="transparent">

                    <v-divider class="my-2"></v-divider>

                    <v-list-item link color="grey lighten-4" >
                        <v-list-item-content>
                            <v-list-item-title>
                                Refresh
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-sheet>
        </v-col>

        <v-col>
            <v-sheet min-height="70vh" rounded="lg" class="pt-15">
                <product-list :products="products"></product-list>
            </v-sheet>
        </v-col>
    </v-row>
    </v-container>
    </v-content>
</v-app>
</div>

<script>
    var app = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data: function() {
            return {
                products: [],
            };
        },
        props: {

        },
        methods: {
            
        },
        components: {
            'product-list': httpVueLoader('/js/vue/ProductList.vue'),
        },
        mounted: function() {
            var self = this;
            axios({
                method: 'get',
                url: '/management/product',
                responseType: 'json',
            })
            .then(function (response) {
                self.products = response.data.products;
            });
        },
    });
</script>
@endsection