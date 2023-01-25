<template>
    <div class="container">

        <h1 style="text-align: center;">String Checker</h1>

        <form @submit.prevent="inputString">
            <div v-if="added_to_db" @blur="frontCheck" style="margin-bottom: 10pt;" v-html="inputed_string" contenteditable="true" class="form-control">

            </div>
            <div v-else class="mb-3">
                <textarea style="margin-bottom: 10pt;" type="text" v-model="inputed_string" class="form-control" placeholder="Input string here"></textarea>
                <button type="submit" class="btn btn-primary">Check string</button>
            </div>
        </form>

        <div>
            
        </div>

        <div class="alert alert-danger" style="text-align: center; margin-top: 20pt;" role="alert" v-if="errored">
            Error while checking string!
        </div>

        <h4 style="text-align: center;">Last checked strings</h4>

        <div v-for="string in strings">
            <p style="text-align: center;"><span v-html="string.inputed_string"></span> ({{ string.language }})</p>
            <hr>
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
            added_to_db: false
        }
    },
    methods: {
        frontCheck() {
            
        },
        checkedString() {
            axios.get('/api/show-last').then(response => {
                console.log(response.data.data.inputed_string)
                this.inputed_string = response.data.data.inputed_string
            }).catch(error => {
                console.log(error)
                this.errored = true
            })
        },
        inputString() {
            axios.post('/api/inputed-strings', {
                    inputed_string: this.inputed_string,
                })
                .then(response => {
                    this.getLastStrings()
                    this.added_to_db = true
                    this.inputed_string = this.checkedString()
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