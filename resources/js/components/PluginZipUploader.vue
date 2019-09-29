<template>
    <div>
        <div v-if="!uploaded">
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" ref="file" @change="fileChange" :class="'custom-file-input ' + formValidationClass" id="customFile">
                    <label class="custom-file-label" for="customFile" data-browse="Выбрать">Выберите файл (zip архив)</label>
                </div>
            </div>
            <div class="form-group" v-if="!autoSubmit">
                <button type="button" :disaled="isFileZip">Загрузить</button>
            </div>
        </div>
        <div v-if="uploaded">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Вендор: <b>{{ responseInfo.vendor }}</b>
                </li>
                <li class="list-group-item">
                    Пакет (плагин): <b>{{ responseInfo.package }}</b>
                </li>
                <li class="list-group-item">
                    Версия: <b>{{ responseInfo.version }}</b>
                </li>
                <li class="list-group-item">
                    Проверка схемы плагина:
                    <span :class="'badge ' + (responseInfo.valid ? 'badge-success' : 'badge-danger')">
                        {{ responseInfo.valid ? 'Схема правильная' : 'Ошибка схемы плагина' }}
                    </span>
                </li>
                <li class="list-group-item">
                    <b :class="responseInfo.saved ? 'text-success' : 'text-danger'">
                        {{ responseInfo.saved ? 'Сохранен' : 'Не сохранен' }}
                    </b>
                </li>
                <li v-if="responseInfo.errorMessage" class="list-group-item">
                    <div class="text-danger">
                        Ошибка: {{ responseInfo.errorMessage }}
                    </div>
                </li>
            </ul>
            <button @click="addNewPlugin" class="mt-3 btn btn-primary" type="button">Загрузить новый плагин</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PluginZipUploader",
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
            fileChange () {
                this.file = this.$refs.file.files[0];
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
