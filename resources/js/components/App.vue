<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="navbar-nav">
                    <router-link class="nav-item nav-link" to="/">Checker</router-link>
                    <router-link class="nav-item nav-link" to="/history">History</router-link>
                </div>
            </div>
        </nav>
        <div style="margin-top: 10pt;">
            <router-view></router-view>
        </div>
    </div>
    
</template>

<script>
export default {
    name: "App"
}
</script>
