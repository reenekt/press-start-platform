<template>
    <!--<v-skeleton-loader-->
            <!--:loading="true"-->
            <!--transition="scale-transition"-->
            <!--height="94"-->
            <!--type="card, list-item-two-line"-->
            <!--boilerplate-->
    <!--&gt;-->
        <v-card
            :loading="(loading ? 'primary' : false)"
        >
            <v-card-title>
                {{ appName }}
            </v-card-title>
            <v-card-text>
                <a :href="appUrl">{{ appUrl }}</a>
            </v-card-text>
            <div v-if="loading">
                <v-card-text class="text-center">
                    Загрузка...
                </v-card-text>
            </div>
            <div v-else>
                <div v-if="!plugin || !plugin.scheme.scheme.version">
                    <v-card-text>
                        Плагин не установлен в CMS
                    </v-card-text>
                    <v-card-actions class="mt-3 d-flex justify-center">
                        <v-btn
                                color="primary"
                                @click="installPlugin"
                        >
                            Установить
                        </v-btn>
                    </v-card-actions>
                </div>

                <div v-else-if="plugin.scheme.scheme.version && plugin.scheme.scheme.version < latestVersion">
                    <v-card-text>
                        Текущая версия <v-chip color="orange">{{ plugin.scheme.scheme.version }}</v-chip><br>
                        Есть более новая версия <v-chip color="green">{{ latestVersion }}</v-chip>
                    </v-card-text>
                    <v-card-actions class="mt-3 d-flex justify-center">
                        <v-btn
                                color="primary"
                                @click="updatePlugin"
                        >
                            Обновить
                        </v-btn>
                    </v-card-actions>
                </div>

                <div v-else>
                    <v-card-text>
                        Установлена самая новая версия <v-chip dark color="green">{{ latestVersion }}</v-chip>
                    </v-card-text>
                </div>
            </div>
        </v-card>
    <!--</v-skeleton-loader>-->


    <!--<div class="card">-->
        <!--<div class="card-body">-->
            <!--<h5 class="card-title">{{ appName }}</h5>-->
            <!--<h5 class="card-subtitle">-->
                <!--<a :href="appUrl">{{ appUrl }}</a>-->
            <!--</h5>-->

            <!--<div v-if="loading">-->
                <!--Загрузка...-->
            <!--</div>-->
            <!--<div v-else>-->
                <!--<div v-if="!plugin || !plugin.scheme.scheme.version">-->
                    <!--<p class="card-text">-->
                        <!--Плагин не установлен в CMS-->
                    <!--</p>-->
                    <!--<div class="mt-3 d-flex justify-content-center">-->
                        <!--<button @click="installPlugin" type="button" class="btn btn-primary">Установить</button>-->
                    <!--</div>-->
                <!--</div>-->

                <!--<div v-else-if="plugin.scheme.scheme.version && plugin.scheme.scheme.version < latestVersion">-->
                    <!--<p class="card-text">-->
                        <!--Текущая версия <span class="badge badge-pill badge-warning">{{ plugin.scheme.scheme.version }}</span><br>-->
                        <!--Есть более новая версия <span class="badge badge-pill badge-success">{{ latestVersion }}</span>-->
                    <!--</p>-->
                    <!--<div class="mt-3 d-flex justify-content-center">-->
                        <!--<button @click="updatePlugin" type="button" class="btn btn-primary">Обновить</button>-->
                    <!--</div>-->
                <!--</div>-->

                <!--<div v-else>-->
                    <!--<p class="card-text">-->
                        <!--Установлена самая новая версия <span class="badge badge-pill badge-success">{{ latestVersion }}</span>-->
                    <!--</p>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <!--&lt;!&ndash;<button @click="reloadData" class="btn btn-info" type="button">reload</button>&ndash;&gt;-->
    <!--</div>-->
</template>

<script>
    import {
        VCard,
        VCardTitle,
        VCardText,
        VBtn,
        VCardActions,
        VChip,
    } from 'vuetify/lib'

    import {VSkeletonLoader} from 'vuetify/lib/components'

    export default {
        name: "InstallPluginCard",
        components: {
            VCard,
            VCardTitle,
            VCardText,
            VBtn,
            VCardActions,
            VChip,
            VSkeletonLoader,
        },
        data () {
            return {
                loading: true,
                plugin: null,
                apiPath: {
                    find: '/api/plugins/find',
                    install: '/api/plugins/install',
                    update: '/api/plugins/update',
                },
            }
        },
        props: {
            appName: {
                required: true,
                type: String,
            },
            appUrl: {
                required: true,
                type: String,
            },
            latestVersion: {
                required: true,
                type: String,
            },
            pluginVendor: {
                required: true,
                type: String,
            },
            pluginPackage: {
                required: true,
                type: String,
            },
            appKey: {
                required: true,
                type: String
            },
        },
        mounted () {
            this.loadData();
        },
        methods: {
            loadData () {
                let url = this.appUrl.replace(/\/$/, "");
                axios.post(url + this.apiPath.find, {
                    key: this.appKey,
                    vendor: this.pluginVendor,
                    package: this.pluginPackage,
                })
                    .then(response => {
                        if (response.data.plugin) {
                            this.plugin = response.data.plugin;
                        }
                    })
                    .catch(error => {
                        console.group();
                        console.error('Load data error:');
                        console.error(error);
                        console.groupEnd();
                    })
                    .finally(() => {
                        this.loading = false;
                    })
            },
            reloadData () {
                this.loading = true;
                this.loadData();
            },
            installPlugin() {
                this.loading = true;
                let url = this.appUrl.replace(/\/$/, "");
                axios.post(url + this.apiPath.install, {
                    key: this.appKey,
                    vendor: this.pluginVendor,
                    package: this.pluginPackage,
                    version: this.latestVersion,
                })
                    .then(response => {
                        console.log('installing started');
                        this.loadData();
                    })
                    .catch(error => {
                        console.group();
                        console.error('Plugin installing error:');
                        console.error(error);
                        console.groupEnd();
                    })
            },
            updatePlugin() {
                this.loading = true;
                let url = this.appUrl.replace(/\/$/, "");
                axios.post(url + this.apiPath.update, {
                    key: this.appKey,
                    vendor: this.pluginVendor,
                    package: this.pluginPackage,
                    version: this.latestVersion,
                })
                    .then(response => {
                        console.log('updating started');
                        this.loadData();
                    })
                    .catch(error => {
                        console.group();
                        console.error('Plugin updating error:');
                        console.error(error);
                        console.groupEnd();
                    })
            },
        },
    }
</script>

<style scoped>

</style>
