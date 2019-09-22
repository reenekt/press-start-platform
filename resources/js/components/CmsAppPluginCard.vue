<template>
    <div class="col-4 pb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ name }}</h5>
                <p class="card-text">
                    <span v-if="invalid" class="badge badge-danger">Ошибка работы</span>
                    <span v-else class="badge badge-success">Работает</span>
                </p>
                <button @click="updatePlugin" class="btn btn-primary" type="button">Обновить</button>
                <button @click="deletePlugin" class="btn btn-danger" type="button">Удалить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CmsAppPluginCard",
        data () {
            return {

            }
        },
        props: {
            name: {
                required: true,
                type: String
            },
            className: {
                required: true,
                type: String
            },
            managerClass: {
                required: true,
                type: String
            },
            invalid: {
                required: true,
                type: String
            },
        },
        mounted () {
            this.checkForUpdates();
        },
        methods: {
            checkForUpdates () {
                //TODO
            },
            updatePlugin () {
                //TODO
            },
            deletePlugin () {
                //TODO
            },
        },
    }
</script>

<style scoped>

</style>
