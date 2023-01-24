<template>
    <div class="container">
        <h1 style="text-align: center;">History</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">String</th>
                    <th scope="col">Language</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            
                <tbody>
                        <tr v-for="string in strings">
                            <td scope="col" v-html="string.inputed_string"></td>
                            <td scope="col">{{ string.language }}</td>
                            <td scope="col"><button type="button" class="btn btn-danger mt-3" @click="deleteString(string.id)">Delete</button></td>
                        </tr>
                </tbody> 
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            strings: [],
            errored: false,
        }
    },
    methods: {
        getAllStrings() {
            axios.get('/api/inputed-strings').then(response => {
                this.strings = response.data.data
            }).catch(error => {
                console.log(error)
                this.errored = true
            })
        },
        deleteString(id) {
            axios.post('/api/inputed-strings/'+id, {
                _method: 'DELETE'
            })
            .then(response => {
                this.strings = []
                this.getAllStrings()
            }).catch(error => {
                console.log(error)
                this.errored = true
            })
        }
    },
    mounted() {
        this.getAllStrings()
    }
}
</script>
