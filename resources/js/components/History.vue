<template>
    <div class="container">

        <h1 style="text-align: center;">History</h1>

        <div class="row">
            <div class="col-lg-4" v-for="folder in folder">
                <h2 style="text-align: center;" class="card-title">{{ folder.name }}</h2>
            </div>
        </div>
    </div>
</template>

<script>
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
        getAllFolders() {
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
        this.getAllFolders()
    }
}
</script>
