<template>
    <v-col
        cols="12"
        md="4"
    >
        <v-card>
            <v-card-title>
                {{ scheme.package }}
            </v-card-title>
            <v-card-text>
                {{ scheme.vendor }}
            </v-card-text>
            <v-card-text>
                <v-chip dark color="red" v-if="invalid">
                    Ошибка работы
                </v-chip>
                <v-chip dark color="green" v-else>
                    Работает
                </v-chip>

                <v-divider class="mx-2 my-2"></v-divider>

                {{ scheme.scheme.version }}<br>
                <div v-if="newerVersionExist">Есть более новая версия: <span class="badge badge-pill badge-success">{{ latestVersion }}</span></div>

                <v-divider class="mx-2 my-2"></v-divider>

                <v-card-actions>
                    <v-btn v-if="newerVersionExist" @click="updatePlugin" color="primary">Обновить</v-btn>
                    <v-btn dark @click="deletePlugin" color="red">Удалить</v-btn>
                </v-card-actions>
            </v-card-text>
        </v-card>
    </v-col>
</template>

<script>
    import {
        VCol,
        VCard,
        VCardTitle,
        VCardText,
        VChip,
        VDivider,
        VCardActions,
        VBtn,
    } from 'vuetify/lib'

    export default {
        name: "CmsAppPluginCard",
        components: {
            VCol,
            VCard,
            VCardTitle,
            VCardText,
            VChip,
            VDivider,
            VCardActions,
            VBtn,
        },
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
