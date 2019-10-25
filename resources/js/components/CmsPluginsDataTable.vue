<template>
    <div>
        <v-data-table
                :headers="headers"
                :items="plugins"
                :options.sync="options"
                :server-items-length="totalPlugins"
                :loading="loading"
                class="elevation-1"
                :disable-sort="true"
                no-data-text="Нет данных"
                no-results-text="Ничего не найдено"
        >
            <template v-slot:body.prepend>
                <tr>
                    <td class="d-block d-md-table-cell">
                        <v-text-field @input="vendorFilterInput" :value="filterParameters.vendor" label="Вендор" clearable></v-text-field>
                    </td>
                    <td class="d-block d-md-table-cell">
                        <v-text-field @input="packageFilterInput" :value="filterParameters.package" label="Пакет" clearable></v-text-field>
                    </td>
                    <td colspan="2"></td>
                </tr>
            </template>
            <template v-slot:item.action="{ item }">
                <v-btn :href="pluginsBaseUrl + '/' + item.id" class="mr-md-2" color="primary">
                    <div class="d-none d-md-inline">Установить в CMS</div>
                    <v-icon class="d-md-none">
                        mdi-cloud-download-outline
                    </v-icon>
                </v-btn>
                <v-btn :href="pluginsBaseUrl + '/' + item.id + '/download'" color="info">
                    <div class="d-none d-md-inline">Скачать zip-архив</div>
                    <v-icon class="d-md-none">
                        mdi-zip-box-outline
                    </v-icon>
                </v-btn>
            </template>
            <template v-slot:footer>
                <slot name="footer"></slot>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import {
        VDataTable,
        VBtn,
        VTextField,
    } from 'vuetify/lib'
    import axios from 'axios'

    export default {
        name: "CmsPluginsDataTable",
        components: {
            VDataTable,
            VBtn,
            VTextField,
        },
        data () {
            return {
                totalPlugins: 0,
                plugins: [],
                loading: true,
                options: {},
                headers: [
                    { text: 'Вендор', value: 'vendor', sortable: false },
                    { text: 'Пакет (плагин)', value: 'package', sortable: false },
                    { text: 'Версия', value: 'version', sortable: false },
                    { text: 'Действия', value: 'action', sortable: false },
                ],
                filterParameters: {
                    vendor: '',
                    package: '',
                },
            }
        },
        props: {
            pluginsBaseUrl: {
                required: true,
                type: String,
                validator (value) {
                    return value[value.length - 1] !== '/'
                }
            },
            pluginsApiUrl: {
                required: true,
                type: String,
                validator (value) {
                    return value[value.length - 1] !== '/'
                }
            },
        },
        watch: {
            options: {
                handler () {
                    this.loadData();
                },
                deep: true,
            },
            filterParameters: {
                handler () {
                    this.loadData(), 300
                },
                deep: true,
            },
        },
        mounted () {
            this.loadData();
        },
        methods: {
            loadData () {
                // const { sortBy, sortDesc, page, itemsPerPage } = this.options
                const { sortBy, sortDesc, page, itemsPerPage } = this.options;
                this.loading = true;
                let url = this.pluginsApiUrl + '?page=' + page + '&perPage=' + itemsPerPage;
                if (this.filterParameters.vendor) {
                    url += '&vendor=' + this.filterParameters.vendor
                }
                if (this.filterParameters.package) {
                    url += '&package=' + this.filterParameters.package
                }
                axios.get(url)
                    .then(response => {
                        this.plugins = response.data.data;
                        this.totalPlugins = response.data.meta.total;
                    })
                    .catch(error => {
                        console.group();
                        console.error('error on load data');
                        console.error(error);
                        console.groupEnd();
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },

            vendorFilterInput: _.debounce(function (value) {
                this.filterParameters.vendor = value;
            }, 300),
            packageFilterInput: _.debounce(function (value) {
                this.filterParameters.package = value;
            }, 300),
        },
    }
</script>

<style scoped>

</style>
