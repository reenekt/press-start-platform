<template>
    <div class="d-flex justify-content-center align-content-center w-100">
        <h1 class="d-flex flex-column justify-content-center align-content-center">
            <mdi-alert :fillColor="color" :size="size"></mdi-alert>
            <span>
                    В разработке
                </span>
        </h1>
    </div>
</template>

<script>
    import mdiAlert from 'vue-material-design-icons/Alert'

    export default {
        name: "WorkInProgress",
        components: {
            mdiAlert
        },
        data() {
            return {
                size: 48,
                color: '#dbd02c'
            }
        }
    }
</script>

<style scoped>

</style>
