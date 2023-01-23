<template>
    <div class="container">

        <h1 style="text-align: center;">Checker</h1>

        <form @submit.prevent="checkString">
            <div class="mb-3">
                <textarea type="text" v-model="string" class="form-control" placeholder="Input string here"></textarea>
                <div class="alert alert-danger" style="text-align: center; margin-top: 20pt;" role="alert" v-if="errored">
                    Error while checking string!
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Check string</button>
        </form>

        <div class="spinner-border" style="width: 4rem; height: 4rem; text-align: center;" role="status" v-if="loading">
            <span class="visually-hidden">Loading...</span>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data (){
        return {
            string: [],
            errored: false,
            loading: true,
        }
    },
    methods: {
        checkString() {
            axios.post('/api/V1/folder', {
                    name: this.name,
                    storage_id: this.storage_id
                })
                .then(response => {
                    this.folder = []
                    this.getAllFolders()
                }).catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        getLastStrings() {
            axios.get('/api/V1/folder').then(response => {
                this.folder = response.data.data
            }).catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false)
        },
    },
    mounted(){
        this.getLastStrings()
    }
}
</script>