<template>
    <button @click="logout()">Выйти</button>
</template>
<script>
export default {
    methods:{
        logout(){
            axios.post('/logout')
            .then(() => {
                location="/";
            })
        }
    }
}
</script>
