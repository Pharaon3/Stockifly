<template>
    <AdminPageHeader>
        <template #header>
            <a-page-header :title="$t(`menu.stonetype`)" class="p-0" />
        </template>
        <template #breadcrumb>
            <a-breadcrumb separator="-" style="font-size: 12px">
                <a-breadcrumb-item>
                    <router-link :to="{ name: 'admin.dashboard.index' }">
                        {{ $t(`menu.dashboard`) }}
                    </router-link>
                </a-breadcrumb-item>
                <a-breadcrumb-item>
                    {{ $t(`menu.product_manager`) }}
                </a-breadcrumb-item>
                <a-breadcrumb-item>
                    {{ $t(`menu.stonetype`) }}
                </a-breadcrumb-item>
            </a-breadcrumb>
        </template>
    </AdminPageHeader>

    <admin-page-filters>
        <a-row :gutter="[16, 16]">
            <a-col :xs="24" :sm="24" :md="12" :lg="10" :xl="10">
                <a-space>
                    <template
                        v-if="
                            permsArray.includes('stonetype_create') ||
                            permsArray.includes('admin')
                        "
                    >
                        <a-space>
                            <a-button type="primary" @click="addItem">
                                <PlusOutlined />
                                {{ $t("stonetype.add") }}
                            </a-button>
                            <ImportStonetype
                                :pageTitle="$t('stonetype.import_stonetype')"
                                :sampleFileUrl="sampleFileUrl"
                                importUrl="stonetype/import"
                                @onUploadSuccess="getStonetype"
                            />
                        </a-space>
                    </template>
                    <a-button
                        v-if="
                            selectedRowKeys.length > 0 &&
                            (permsArray.includes('stonetype_delete') ||
                                permsArray.includes('admin'))
                        "
                        type="primary"
                        @click="showSelectedDeleteConfirm"
                        danger
                    >
                        <template #icon><DeleteOutlined /></template>
                        {{ $t("common.delete") }}
                    </a-button>
                </a-space>
            </a-col>
            <a-col :xs="24" :sm="24" :md="12" :lg="14" :xl="14">
                <a-row :gutter="[16, 16]" justify="end"> </a-row>
            </a-col>
        </a-row>
    </admin-page-filters>

    <admin-page-table-content>
        <AddEdit
            :addEditType="addEditType"
            :visible="addEditVisible"
            :url="addEditUrl"
            @addEditSuccess="addEditSuccess"
            @closed="onCloseAddEdit"
            :formData="formData"
            :data="viewData"
            :destroyOnClose="true"
        />

        <a-row>
            <a-col :span="24">
                <div class="table-responsive">
                    <a-table
                        :row-selection="rowSelection"
                        :columns="columns"
                        :row-key="(record) => record.xid"
                        :data-source="allStonetype"
                        :defaultExpandAllRows="true"
                        bordered
                        size="middle"
                    >
                        <template #bodyCell="{ column, text, record }">
                            <template v-if="column.dataIndex === 'image_url'">
                                <a-image :width="32" :src="text" />
                            </template>
                            <template v-if="column.dataIndex === 'action'">
                                <a-button
                                    v-if="
                                        permsArray.includes('stonetype_edit') ||
                                        permsArray.includes('admin')
                                    "
                                    type="primary"
                                    @click="editItem(record)"
                                    style="margin-left: 4px"
                                >
                                    <template #icon><EditOutlined /></template>
                                </a-button>
                                <a-button
                                    v-if="
                                        (permsArray.includes('stonetype_delete') ||
                                            permsArray.includes('admin')) &&
                                        (!record.children || record.children.length == 0)
                                    "
                                    type="primary"
                                    @click="showDeleteConfirm(record.xid)"
                                    style="margin-left: 4px"
                                >
                                    <template #icon><DeleteOutlined /></template>
                                </a-button>
                            </template>
                        </template>
                    </a-table>
                </div>
            </a-col>
        </a-row>
    </admin-page-table-content>
</template>
<script>
import { onMounted, ref, createVNode, unref, computed } from "vue";
import fields from "./fields";
import {
    PlusOutlined,
    EditOutlined,
    DeleteOutlined,
    ExclamationCircleOutlined,
} from "@ant-design/icons-vue";
import { Modal, notification } from "ant-design-vue";
import { useStore } from "vuex";
import { useI18n } from "vue-i18n";
import { forEach } from "lodash-es";
import common from "../../../../common/composable/common";
import AddEdit from "./AddEdit.vue";
import AdminPageHeader from "../../../../common/layouts/AdminPageHeader.vue";
import ImportStonetype from "../../../../common/core/ui/Import.vue";

export default {
    components: {
        PlusOutlined,
        EditOutlined,
        DeleteOutlined,
        ExclamationCircleOutlined,
        AddEdit,
        AdminPageHeader,
        ImportStonetype,
    },
    setup() {
        const store = useStore();
        const { initData, columns } = fields();
        const { permsArray } = common();
        const { t } = useI18n();
        const sampleFileUrl = window.config.stonetype_sample_file;

        const detailsVisible = ref(false);
        const viewData = ref({});

        const addEditVisible = ref(false);
        const addEditType = ref("add");
        const addEditUrl = ref("stonetype");
        const allStonetype = ref([]);

        const formData = ref({});

        const selectedRowKeys = ref([]);

        onMounted(() => {
            getStonetype();
        });

        const onRowSelectionChange = (selectedRowKeyValues) => {
            selectedRowKeys.value = selectedRowKeyValues;
        };

        const getCheckboxProps = (record) => {
            return {
                disabled: !record.children || record.children.length == 0 ? false : true,
                name: record.xid,
            };
        };

        const rowSelection = computed(() => {
            return {
                selectedRowKeys: unref(selectedRowKeys),
                onChange: onRowSelectionChange,
                getCheckboxProps: getCheckboxProps,
            };
        });

        const getStonetype = () => {
            axiosAdmin
                .get(
                    `stonetype?fields=id,xid,slug,name&limit=10000`
                )
                .then((response) => {
                    const allStonetypeArray = [];
                    var listArray = response.data;
                    // listArray = sortBy(listArray, "x_parent_id");

                    listArray.forEach((node) => {
                        // No parentId means top level
                        if (!node.x_parent_id) return allStonetypeArray.push(node);

                        // Insert node as child of parent in listArray array
                        const parentIndex = listArray.findIndex(
                            (el) => el.xid === node.x_parent_id
                        );
                        if (!listArray[parentIndex].children) {
                            return (listArray[parentIndex].children = [node]);
                        }

                        listArray[parentIndex].children.push(node);
                    });

                    allStonetype.value = allStonetypeArray;
                });
        };

        const viewItem = (item) => {
            viewData.value = item;
            detailsVisible.value = true;
        };

        const addItem = () => {
            addEditUrl.value = "stonetype";
            addEditType.value = "add";
            addEditVisible.value = true;
        };

        const addEditSuccess = (id) => {
            // If add action is performed then move page to first
            if (addEditType.value == "add") {
                formData.value = {
                    name: "",
                    slug: "",
                    image: undefined,
                    image_url: undefined,
                    parent_id: null,
                };
            }

            getStonetype();
            addEditVisible.value = false;
        };

        const onCloseAddEdit = () => {
            formData.value = { ...initData };
            addEditVisible.value = false;
        };

        const editItem = (item) => {
            formData.value = {
                name: item.name,
                slug: item.slug,
                image: item.image,
                image_url: item.image_url,
                parent_id: item.x_parent_id,
                _method: "PUT",
            };

            viewData.value = item;
            addEditUrl.value = `stonetype/${item.xid}`;
            addEditType.value = "edit";
            addEditVisible.value = true;
        };

        const showDeleteConfirm = (id) => {
            Modal.confirm({
                title: t("common.delete") + "?",
                icon: createVNode(ExclamationCircleOutlined),
                content: t("stonetype.delete_message"),
                centered: true,
                okText: t("common.yes"),
                okType: "danger",
                cancelText: t("common.no"),
                onOk() {
                    axiosAdmin.delete(`stonetype/${id}`).then(() => {
                        getStonetype();
                        notification.success({
                            message: t("common.success"),
                            description: t("stonetype.deleted"),
                        });
                    });
                },
                onCancel() {},
            });
        };

        const showSelectedDeleteConfirm = () => {
            Modal.confirm({
                title: t("common.delete") + "?",
                icon: createVNode(ExclamationCircleOutlined),
                content: t("stonetype.delete_message"),
                centered: true,
                okText: t("common.yes"),
                okType: "danger",
                cancelText: t("common.no"),
                onOk() {
                    const allDeletePromise = [];
                    forEach(selectedRowKeys.value, (selectedRow) => {
                        allDeletePromise.push(
                            axiosAdmin.delete(`stonetype/${selectedRow}`)
                        );
                    });

                    Promise.all(allDeletePromise).then((successResponse) => {
                        // Update Visible Subscription Modules
                        store.dispatch("auth/updateVisibleSubscriptionModules");

                        getStonetype();

                        notification.success({
                            message: t("common.success"),
                            description: t(`stonetype.deleted`),
                            placement: "bottomRight",
                        });
                    });
                },
                onCancel() {},
            });
        };

        return {
            columns,
            addEditSuccess,
            formData,
            editItem,
            addEditVisible,
            addItem,
            onCloseAddEdit,
            addEditUrl,
            addEditType,
            showDeleteConfirm,
            detailsVisible,
            viewItem,
            viewData,
            allStonetype,
            permsArray,
            sampleFileUrl,
            getStonetype,

            selectedRowKeys,
            rowSelection,
            showSelectedDeleteConfirm,
        };
    },
};
</script>
