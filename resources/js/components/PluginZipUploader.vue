<template>
    <div>
        <div v-if="!uploaded">
            <v-file-input
                    label="Плагин"
                    accept="application/zip,application/octet-stream,application/x-zip-compressed,multipart/x-zip"
                    hint="Выберите файл (zip архив)"
                    persistent-hint
                    @change="fileChange"
            ></v-file-input>

            <!--<div class="form-group">-->
                <!--<div class="custom-file">-->
                    <!--<input type="file" ref="file" @change="fileChange" :class="'custom-file-input ' + formValidationClass" id="customFile">-->
                    <!--<label class="custom-file-label" for="customFile" data-browse="Выбрать">Выберите файл (zip архив)</label>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="form-group" v-if="!autoSubmit">-->
                <!--<button type="button" :disaled="isFileZip">Загрузить</button>-->
            <!--</div>-->
        </div>
        <div v-if="uploaded">
            <v-card>
                <v-card-text class="title">
                    Вендор: <b>{{ responseInfo.vendor }}</b>
                    <v-divider class="my-3"></v-divider>
                    Пакет (плагин): <b>{{ responseInfo.package }}</b>
                    <v-divider class="my-3"></v-divider>
                    Версия: <b>{{ responseInfo.version }}</b>
                    <v-divider class="my-3"></v-divider>
                    Проверка схемы плагина:
                    <v-chip dark :color="(responseInfo.valid ? 'green' : 'red')">
                        {{ responseInfo.valid ? 'Схема правильная' : 'Ошибка схемы плагина' }}
                    </v-chip>
                    <v-divider class="my-3"></v-divider>
                    <v-chip dark :color="(responseInfo.saved ? 'green' : 'red')">
                        {{ responseInfo.saved ? 'Сохранен' : 'Не сохранен' }}
                    </v-chip>
                    <div v-if="responseInfo.errorMessage" class="red--text darken-3">
                        Ошибка: {{ responseInfo.errorMessage }}
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-btn class="mt-3" color="primary" @click="addNewPlugin">
                        Загрузить новый плагин
                    </v-btn>
                </v-card-actions>
            </v-card>
            <!--<ul class="list-group list-group-flush">-->
                <!--<li class="list-group-item">-->
                    <!--Вендор: <b>{{ responseInfo.vendor }}</b>-->
                <!--</li>-->
                <!--<li class="list-group-item">-->
                    <!--Пакет (плагин): <b>{{ responseInfo.package }}</b>-->
                <!--</li>-->
                <!--<li class="list-group-item">-->
                    <!--Версия: <b>{{ responseInfo.version }}</b>-->
                <!--</li>-->
                <!--<li class="list-group-item">-->
                    <!--Проверка схемы плагина:-->
                    <!--<span :class="'badge ' + (responseInfo.valid ? 'badge-success' : 'badge-danger')">-->
                        <!--{{ responseInfo.valid ? 'Схема правильная' : 'Ошибка схемы плагина' }}-->
                    <!--</span>-->
                <!--</li>-->
                <!--<li class="list-group-item">-->
                    <!--<b :class="responseInfo.saved ? 'text-success' : 'text-danger'">-->
                        <!--{{ responseInfo.saved ? 'Сохранен' : 'Не сохранен' }}-->
                    <!--</b>-->
                <!--</li>-->
                <!--<li v-if="responseInfo.errorMessage" class="list-group-item">-->
                    <!--<div class="text-danger">-->
                        <!--Ошибка: {{ responseInfo.errorMessage }}-->
                    <!--</div>-->
                <!--</li>-->
            <!--</ul>-->
            <!--<button @click="addNewPlugin" class="mt-3 btn btn-primary" type="button">Загрузить новый плагин</button>-->
        </div>
    </div>
</template>

<script>
    import {
        VFileInput,
        VCard,
        VCardText,
        VChip,
        VDivider,
        VCardActions,
        VBtn,
    } from 'vuetify/lib'
    import axios from 'axios'

    export default {
        name: "PluginZipUploader",
        components: {
            VFileInput,
            VCard,
            VCardText,
            VChip,
            VDivider,
            VCardActions,
            VBtn,
        },
        data() {
            return {
                zipMimeTypes: [
                    'application/zip',
                    'application/octet-stream',
                    'application/x-zip-compressed',
                    'multipart/x-zip',
                ],
                file: null,
                uploaded: false,
                responseInfo: {
                    vendor: null,
                    package: null,
                    version: null,
                    valid: false,
                    components: [],
                    saved: false,
                    errorMessage: '',
                },
            }
        },
        props: {
            submitUrl: {
                required: true,
                type: String,
            },
            autoSubmit: {
                required: false,
                type: Boolean,
                default () {
                    return true;
                }
            }
        },
        computed:  {
            isFileZip () {
                if (this.file) {
                    return this.zipMimeTypes.includes(this.file.type);
                }
                return false
            },
            formValidationClass () {
                if (!this.file) {
                    return '';
                }
                if (this.isFileZip) {
                    return 'is-valid';
                } else {
                    return 'is-invalid';
                }
            }
        },
        methods: {
            fileChange (file) {
                this.file = file;
                if (this.autoSubmit) {
                    this.submitFile()
                }
            },
            submitFile () {
                if (this.isFileZip) {
                    let formData = new FormData();
                    formData.append('file', this.file);

                    axios.post(this.submitUrl,
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    )
                        .then(response => {
                            this.uploaded = true;
                            this.responseInfo = response.data
                        })
                        .catch(error => {
                            console.log(error)
                        });
                }
            },
            addNewPlugin () {
                this.file = null;
                this.uploaded = false;
            }
        }
    }
</script>

<style scoped>

</style>
