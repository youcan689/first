<template>
    <div class="d-inline">
        <v-dialog persistent v-model="dialog" max-width="800px">
            <template v-slot:activator="{ on, attrs }">                
                <v-btn color="light-green accent-2" v-bind="attrs" v-on="on">
                    New Product
                </v-btn>
            </template>

            <v-snackbar v-model="hintSnackbar.enable" :timeout="2000">
                {{ hintSnackbar.message }}

                <template v-slot:action="{ attrs }">
                    <v-btn text color="red accent-3" v-bind="attrs" @click="hintSnackbar.enable = false">Close</v-btn>
                </template>
            </v-snackbar>

            <v-card>
                <v-card-title>
                    <span class="headline">{{ dialogTitle }}</span>
                    <v-spacer></v-spacer>
                    <v-btn label color="red accent-4" class="white--text" @click="close">
                        Cancel <v-icon color="white">close</v-icon>
                    </v-btn>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-form ref="updateForm" v-model="valid">
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field clearable v-model="editedItem.title" label="Title"
                                        :rules="[rules.required]">
                                    </v-text-field>
                                </v-col>

                                <v-col cols="12">
                                    <v-textarea no-resize outlined auto-grow background-color="green lighten-5"
                                        v-model="editedItem.description" label="Description"
                                        :rules="[rules.required]">
                                    </v-textarea>
                                </v-col>

                                <v-col cols="12">
                                    <v-text-field clearable dense v-model="editedItem.price" label="Price"
                                        :rules="[rules.required, rules.price]">
                                    </v-text-field>
                                </v-col>

                                <v-col cols="12" sm="6" md="4">
                                    <v-checkbox v-model="editedItem.published" label="Publish Directly"></v-checkbox>
                                </v-col>
                            </v-row>
                        </v-form>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text color="blue darken-1" @click="post">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
module.exports = {
    data() {
        return {
            dialog: false,
            valid: false,
            editedIndex: -1,
            editedItem: {
                title: '',
                description: '',
                price: 0,
                published: false,
            },
            defaultItem: {
                title: '',
                description: '',
                price: 0,
                published: false,
            },
            rules: {
                required: value => !!value || 'Required.',
                price: value => {
                    if (!value || isNaN(value))
                        return 'Not A Number';
                    const n = Number(value);
                    return n > 0 || 'Price must be geater than 0';
                },
            },
            hintSnackbar: {
                enable: false,
                message: '',
            },
        };
    },
    props: {
        
    },
    computed: {
        dialogTitle() {
            return this.editedIndex === -1 ? 'Create New Product' : 'Edit Product Info';
        },
    },
    methods: {
        /**
         * * Show hint message by snackbar.
         *
         * @param message some text should be put
         */
        hintSnackbarShow (message) {
            this.hintSnackbar.message = message;
            this.hintSnackbar.enable = true;
        },
        /**
         * * Close updateForm.
         */
        close() {
            this.dialog = false;
            this.$refs.updateForm.reset();
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            });
        },
        /**
         * * Post form data to server.
         */
        post() {
            if (!this.valid)
            {
                this.$refs.updateForm.validate();
                this.hintSnackbarShow('Please fill content above');
                return;
            }

            if (this.editedIndex < 0)
            {
                axios({
                    method: 'post',
                    url: '/management/products',
                    data: {
                        product: this.editedItem,
                    }
                }).then((response) => {
                    this.$emit('completed', response.data.productBeenAdded, this.editedIndex);
                    this.close();
                }).catch((error) => {
                    console.error('updateForm post failed.');
                    console.error(error);
                });
            }
        },
    },
}
</script>

<style scoped>

</style>