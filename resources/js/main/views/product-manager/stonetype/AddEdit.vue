<template>
    <a-modal
        :open="visible"
        :closable="false"
        :centered="true"
        :title="pageTitle"
        @ok="onSubmit"
    >
        <a-form layout="vertical">
            <a-row :gutter="16">
                <a-col :xs="24" :sm="24" :md="24" :lg="24">
                    <a-form-item
                        :label="$t('stonetype.name')"
                        name="name"
                        :help="rules.name ? rules.name.message : null"
                        :validateStatus="rules.name ? 'error' : null"
                        class="required"
                    >
                        <a-input
                            v-model:value="formData.name"
                            :placeholder="
                                $t('common.placeholder_default_text', [
                                    $t('stonetype.name'),
                                ])
                            "
                            v-on:keyup="formData.slug = slugify($event.target.value)"
                        />
                    </a-form-item>
                </a-col>
            </a-row>

            <a-row :gutter="16">
                <a-col :xs="24" :sm="24" :md="24" :lg="24">
                    <a-form-item
                        :label="$t('stonetype.slug')"
                        name="slug"
                        :help="rules.slug ? rules.slug.message : null"
                        :validateStatus="rules.slug ? 'error' : null"
                        class="required"
                    >
                        <a-input
                            v-model:value="formData.slug"
                            :placeholder="
                                $t('common.placeholder_default_text', [
                                    $t('stonetype.slug'),
                                ])
                            "
                        />
                    </a-form-item>
                </a-col>
            </a-row>

            <!-- <a-row :gutter="16">
                <a-col :xs="24" :sm="24" :md="24" :lg="24">
                    <a-form-item
                        :label="$t('stonetype.logo')"
                        name="image"
                        :help="rules.image ? rules.image.message : null"
                        :validateStatus="rules.image ? 'error' : null"
                    >
                        <Upload
                            :formData="formData"
                            folder="stonetype"
                            @onFileUploaded="
                                (file) => {
                                    formData.image = file.file;
                                    formData.image_url = file.file_url;
                                }
                            "
                        />
                    </a-form-item>
                </a-col>
            </a-row> -->
        </a-form>
        <template #footer>
            <a-button key="submit" type="primary" :loading="loading" @click="onSubmit">
                <template #icon>
                    <SaveOutlined />
                </template>
                {{ addEditType == "add" ? $t("common.create") : $t("common.update") }}
            </a-button>
            <a-button key="back" @click="onClose">
                {{ $t("common.cancel") }}
            </a-button>
        </template>
    </a-modal>
</template>
<script>
import { defineComponent, ref, computed, watch } from "vue";
import { PlusOutlined, LoadingOutlined, SaveOutlined } from "@ant-design/icons-vue";
import { useI18n } from "vue-i18n";
import apiAdmin from "../../../../common/composable/apiAdmin";
import Upload from "../../../../common/core/ui/file/Upload.vue";
import common from "../../../../common/composable/common";

export default defineComponent({
    props: ["formData", "data", "visible", "url", "addEditType"],
    components: {
        PlusOutlined,
        LoadingOutlined,
        SaveOutlined,
        Upload,
    },
    setup(props, { emit }) {
        const { addEditRequestAdmin, loading, rules } = apiAdmin();
        const { getRecursiveStonetype, slugify } = common();
        const { t } = useI18n();
        const allStonetype = ref([]);

        const getStonetype = (xid = null) => {
            var url = "stonetype?fields=id,name,slug&limit=10000";
            if (xid != null) {
                url += `&filters=id ne ${xid}&hashable=${xid}`;
            }

            axiosAdmin.get(url).then((response) => {
                allStonetype.value = getRecursiveStonetype(response, xid);
            });
        };

        const pageTitle = computed(() => {
            return props.addEditType == "add" ? t("stonetype.add") : t("stonetype.edit");
        });

        const onSubmit = () => {
            var addEditData = { ...props.formData };
            const successMessage =
                props.addEditType == "add"
                    ? t("stonetype.created")
                    : t("stonetype.updated");

            addEditRequestAdmin({
                url: props.url,
                data: addEditData,
                successMessage,
                success: (res) => {
                    getStonetype();
                    emit("addEditSuccess", res.xid);
                },
            });
        };

        const onClose = () => {
            rules.value = {};
            emit("closed");
        };

        watch(props, (newVal, oldVal) => {
            if (newVal.addEditType == "add") {
                getStonetype();
            } else {
                getStonetype(newVal.data.xid);
            }
        });

        return {
            loading,
            rules,
            onClose,
            onSubmit,
            pageTitle,
            allStonetype,
            slugify,
        };
    },
});
</script>
