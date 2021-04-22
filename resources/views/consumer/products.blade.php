@extends('consumer.layout')
@section('content')
    <div>
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for='product in products'>
                    <td v-text="product.title"></td>
                    <td v-text="product.description"></td>
                    <td v-text="product.price"></td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection

@section('vuejs-instance')
    <script>
        Vue.use(vueMoment);
        new Vue({
            el: '#app',
            data: function() {
                return {
                    products: []
                }
            },
            mounted() {
                var self = this;
                axios.get('products').then(function(response) {
                    self.products = response.data;
                })
            },
            vuetify: new Vuetify(),
        })

    </script>
@endsection
