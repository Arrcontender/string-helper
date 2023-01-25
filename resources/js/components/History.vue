<template>
    <div class="container">
        <h1 style="text-align: center;">History</h1>

        <table  class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">String</th>
                    <th scope="col">Language</th>
                    <th style="text-align:right" scope="col">
                        <button type="button" class="btn btn-danger" @click="deleteAllStrings()">Clear history</button>
                    </th>
                </tr>
            </thead>
            
                <tbody>
                        <tr v-for="string in strings">
                            <td v-html="string.inputed_string"></td>
                            <td>{{ string.language }}</td>
                            <td style="text-align:right"><button type="button" class="btn btn-primary me-md-2" @click="deleteString(string.id)">Delete string</button></td>
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
        },
        deleteAllStrings() {
            if(confirm('Are you sure you want to clear history?')) {
                axios.post('/api/destroy-all', {
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
        }
    },
    mounted() {
        this.getAllStrings()
    }
}
</script>
