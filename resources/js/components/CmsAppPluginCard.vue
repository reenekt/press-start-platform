<template>
    <div class="col-4 pb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ scheme.package }}</h5>
                <h6 class="card-subtitle">{{ scheme.vendor }}</h6>
                <p class="card-text">
                    <span v-if="invalid" class="badge badge-danger">Ошибка работы</span>
                    <span v-else class="badge badge-success">Работает</span>
                </p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    {{ scheme.scheme.version }}<br>
                    <div v-if="newerVersionExist">Есть более новая версия: <span class="badge badge-pill badge-success">{{ latestVersion }}</span></div>
                </li>
            </ul>
            <div class="card-body">
                <div v-if="loading">
                    Загрузка...
                </div>
                <div v-else>
                    <button v-if="newerVersionExist" @click="updatePlugin" class="btn btn-primary" type="button">Обновить</button>
                    <button @click="deletePlugin" class="btn btn-danger" type="button">Удалить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CmsAppPluginCard",
        data () {
            return {
                loading: true,
                plugin: null,
                apiPath: {
                    find: '/api/plugins/find',
                    update: '/api/plugins/update',
                    delete: '/api/plugins/delete',
                },
                latestVersion: null,
            }
        },
        props: {
            scheme: {
                required: true,
                type: Object
            },
            invalid: {
                required: true,
                type: Boolean
            },
            cmsAppUrl: {
                required: true,
                type: String
            },
            appKey: {
                required: true,
                type: String
            },
        },
        mounted () {
            this.checkForUpdates();
        },
        computed: {
            newerVersionExist () {
                if (!this.latestVersion) {
                    return false;
                }
                return this.latestVersion > this.scheme.scheme.version;
            },
        },
        methods: {
            checkForUpdates () {
                axios.post('/cms-plugins/get-plugin-latest-version', {
                    vendor: this.scheme.vendor,
                    package: this.scheme.package,
                    version: this.latestVersion,
                })
                    .then(response => {
                        this.latestVersion = response.data.version
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            updatePlugin () {
                this.loading = true;
                let url = this.cmsAppUrl.replace(/\/$/, "");
                axios.post(url + this.apiPath.update, {
                    key: this.appKey,
                    vendor: this.scheme.vendor,
                    package: this.scheme.package,
                    version: this.latestVersion,
                })
                    .then(response => {
                        console.log('updating started');
                        this.$emit('change')
                    })
                    .catch(error => {
                        console.group();
                        console.error('Plugin updating error:');
                        console.error(error);
                        console.groupEnd();
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            deletePlugin () {
                this.loading = true;
                let url = this.cmsAppUrl.replace(/\/$/, "");
                axios.post(url + this.apiPath.delete, {
                    key: this.appKey,
                    vendor: this.scheme.vendor,
                    package: this.scheme.package,
                    version: this.latestVersion,
                })
                    .then(response => {
                        console.log('deleting started');
                        this.$emit('change')
                    })
                    .catch(error => {
                        console.group();
                        console.error('Plugin updating error:');
                        console.error(error);
                        console.groupEnd();
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
        },
    }
</script>

<style scoped>

</style>
