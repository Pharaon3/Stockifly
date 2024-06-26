import { useI18n } from "vue-i18n";

const fields = () => {
    const { t } = useI18n();
    const staffMemberAddEditUrl = "users";
    const customerAddEditUrl = "customers";
    const supplierAddEditUrl = "suppliers";

    const cummonInitData = {
        warehouse_id: undefined,
        warehouses: [],
        name: "",
        email: "",
        profile_image: undefined,
        profile_image_url: undefined,
        phone: "",
        address: "",
        status: "enabled",
        nickname: "",
        birthday: "",
        province: "",
        postcode: "",
        country: "",
        ref_invitation_name: "",
        joined_event: "",
        credit_memo: "",
        point: "",
        bankaccount: "",
        bankname: "",
        remark: ""
    };

    const customerSupplierInitData = {
        shipping_address: "",
        opening_balance: "",
        opening_balance_type: "receive",
        credit_period: "30",
        credit_limit: "",
        tax_number: undefined,
    };

    const customerInitData = {
        user_type: "customers",
        ...cummonInitData,
        ...customerSupplierInitData
    };

    const staffMemberInitData = {
        ...customerInitData,
        user_type: "staff_members",
        role_id: undefined,
        password: "",
    };

    const supplierInitData = {
        user_type: "suppliers",
        supplier_type: "",
        tax_document: "",
        supplier_tier: "",
        payment_channel: "",
        ...customerInitData,
        ...customerSupplierInitData,
    };

    const columns = [
        {
            title: t("user.name"),
            dataIndex: "name",
            key: "name",
        },
        {
            title: t("user.email"),
            dataIndex: "email",
        },
        {
            title: t("user.created_at"),
            dataIndex: "created_at",
        },
        {
            title: t("user.status"),
            dataIndex: "status",
            key: "status",
        },
        {
            title: t("common.action"),
            dataIndex: "action",
        },
    ];

    const supplierCustomerColumns = [
        {
            title: t("user.name"),
            dataIndex: "name",
            key: "name",
        },
        {
            title: t("user.email"),
            dataIndex: "email",
        },
        {
            title: t("user.created_at"),
            dataIndex: "created_at",
        },
        {
            title: t("common.balance"),
            dataIndex: "balance",
        },
        {
            title: t("user.status"),
            dataIndex: "status",
            key: "status",
        },
        {
            title: t("common.action"),
            dataIndex: "action",
        },
    ];

    const filterableColumns = [
        {
            key: "users.name",
            value: t("user.name")
        },
        {
            key: "email",
            value: t("user.email")
        },
        {
            key: "phone",
            value: t("user.phone")
        },
    ];

    return {
        customerInitData,
        staffMemberInitData,
        supplierInitData,
        columns,
        supplierCustomerColumns,
        filterableColumns,
        staffMemberAddEditUrl,
        customerAddEditUrl,
        supplierAddEditUrl,
    }
}

export default fields;
