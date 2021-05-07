@extends('consumer.layout')
@section('content')
    <div v-for="product in products">
        <v-hover v-slot="{hover}" open-delay="200">
            <v-card color="#FAEBD7" outlined shaped :elevation="hover ? 16 : 2">
                <v-card-title v-text="product.title"></v-card-title>
                <v-card-subtitle v-text="product.price"></v-card-subtitle>
                <v-card-text v-text="product.description"></v-card-text>
                <v-btn @click="addCart(product.id)">加入購物車</v-btn>
            </v-card>
        </v-hover>
    </div>
@endsection
@section('vuejs-instance')
    <script>
        Vue.use(vueMoment);
        new Vue({
            el: '#app',
            data: function() {
                return {
                    products: [],
                    cartEnd: [],
                }
            },
            mounted() {
                var self = this;
                axios.get('/consumer/products').then(function(response) {
                    self.products = response.data.products;
                })
                axios.get('/consumer/getCart').then(function(response) {
                    self.cartEnd = response.data.cartEnd;
                })
            },
            methods: {
                addCart: function(id) {
                    var self = this;
                    axios.post('/consumer/addCart', {
                        productId: id
                    }).then(function(response) {
                        self.cartEnd = response.data.cart;
                    }).catch(function(error) {
                        if (error.response.status == 401) {
                            window.location = "/login";
                        }
                    });
                },
            },
            vuetify: new Vuetify(),
        })

    </script>
@endsection
