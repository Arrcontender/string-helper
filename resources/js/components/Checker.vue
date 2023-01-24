<template>
    <div class="container">

        <h1 style="text-align: center;">string checker</h1>

        <form @submit.prevent="inputString">
            <div class="mb-3">
                <textarea type="text" v-model="inputed_string" class="form-control" placeholder="Input string here"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Check string</button>
        </form>

        <div class="alert alert-danger" style="text-align: center; margin-top: 20pt;" role="alert" v-if="errored">
            Error while checking string!
        </div>

        <h4 style="text-align: center;">Last 5 strings</h4>

        <div v-for="string in strings">
            <p style="text-align: center;"><span v-html="string.inputed_string"></span> ({{ string.language }})</p>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data (){
        return {
            inputed_string: [],
            strings: [],
            errored: false,
        }
    },
    methods: {
        inputString() {
            axios.post('/api/inputed-strings', {
                    inputed_string: this.inputed_string,
                })
                .then(response => {
                    this.getLastStrings()
                }).catch(error => {
                    console.log(error)
                    this.errored = true
                })
        },
        getLastStrings() {
            axios.get('/api/last-strings').then(response => {
                this.strings = response.data.data
            }).catch(error => {
                console.log(error)
                this.errored = true
            })
        },
    },
    mounted(){
        this.getLastStrings()
    }
}
</script>