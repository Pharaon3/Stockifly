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
                        :label="$t('jewerlygroup.name')"
                        name="name"
                        :help="rules.name ? rules.name.message : null"
                        :validateStatus="rules.name ? 'error' : null"
                        class="required"
                    >
                        <a-input
                            v-model:value="formData.name"
                            :placeholder="
                                $t('common.placeholder_default_text', [
                                    $t('jewerlygroup.name'),
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
                        :label="$t('jewerlygroup.slug')"
                        name="slug"
                        :help="rules.slug ? rules.slug.message : null"
                        :validateStatus="rules.slug ? 'error' : null"
                        class="required"
                    >
                        <a-input
                            v-model:value="formData.slug"
                            :placeholder="
                                $t('common.placeholder_default_text', [
                                    $t('jewerlygroup.slug'),
                                ])
                            "
                        />
                    </a-form-item>
                </a-col>
            </a-row>

            <!-- <a-row :gutter="16">
                <a-col :xs="24" :sm="24" :md="24" :lg="24">
                    <a-form-item
                        :label="$t('jewerlygroup.logo')"
                        name="image"
                        :help="rules.image ? rules.image.message : null"
                        :validateStatus="rules.image ? 'error' : null"
                    >
                        <Upload
                            :formData="formData"
                            folder="jewerlygroup"
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
        const { getRecursiveJewerlygroup, slugify } = common();
        const { t } = useI18n();
        const allJewerlygroup = ref([]);

        const getJewerlygroup = (xid = null) => {
            var url = "jewerlygroup?fields=id,name,slug&limit=10000";
            if (xid != null) {
                url += `&filters=id ne ${xid}&hashable=${xid}`;
            }

            axiosAdmin.get(url).then((response) => {
                allJewerlygroup.value = getRecursiveJewerlygroup(response, xid);
            });
        };

        const pageTitle = computed(() => {
            return props.addEditType == "add" ? t("jewerlygroup.add") : t("jewerlygroup.edit");
        });

        const onSubmit = () => {
            var addEditData = { ...props.formData };
            const successMessage =
                props.addEditType == "add"
                    ? t("jewerlygroup.created")
                    : t("jewerlygroup.updated");

            addEditRequestAdmin({
                url: props.url,
                data: addEditData,
                successMessage,
                success: (res) => {
                    getJewerlygroup();
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
                getJewerlygroup();
            } else {
                getJewerlygroup(newVal.data.xid);
            }
        });

        return {
            loading,
            rules,
            onClose,
            onSubmit,
            pageTitle,
            allJewerlygroup,
            slugify,
        };
    },
});
</script>
