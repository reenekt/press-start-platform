<template>
    <v-container fluid class="fill-height">
        <v-row
            justify="center"
            align="center"
        >
            <h1 class="d-flex flex-column justify-content-center align-content-center">
                <v-icon color="orange" x-large>mdi-alert</v-icon>
                <span>
                В разработке
            </span>
            </h1>
        </v-row>
    </v-container>
</template>

<script>
    import {
        VIcon,
    } from 'vuetify/lib'

    export default {
        name: "WorkInProgress",
        components: {
            VIcon,
        },
    }
</script>

<style scoped>

</style>
