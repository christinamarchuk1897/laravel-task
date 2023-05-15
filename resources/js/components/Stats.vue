<template >
    <div class="card-body">
        <h3 class="card-title">Personal Stats</h3>
        <div v-if="user">
            <span class="card-title bold">{{ user.name }}</span>
            <br>
            <span class="card-title bold">{{ user.email }}</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        user:{
            type: Object,
            reqired: true
        }
    }
}
</script>