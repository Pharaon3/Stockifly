import { useI18n } from "vue-i18n";

const fields = () => {
    const addEditUrl = "products";
    const { t } = useI18n();
    const hashableColumns = ["unit_id", "category_id", "brand_id", "tax_id"];
    const multiDimensalObjectColumns = {
        stock_quantitiy_alert: "details.stock_quantitiy_alert",
        mrp: "details.mrp",
        purchase_price: "details.purchase_price",
        sales_price: "details.sales_price",
        tax_id: "details.x_tax_id",
        purchase_tax_type: "details.purchase_tax_type",
        sales_tax_type: "details.sales_tax_type",
        opening_stock: "details.opening_stock",
        opening_stock_date: "details.opening_stock_date",
        wholesale_price: "details.wholesale_price",
        wholesale_quantity: "details.wholesale_quantity",
    };

    const initData = {
        warehouse_id: undefined,
        name: "",
        slug: "",
        image: undefined,
        image_url: undefined,
        barcode_symbology: "CODE128",
        item_code: "",
        stock_quantitiy_alert: null,
        category_id: undefined,
        stone_type: undefined,
        gold_type: undefined,
        jewerly_group: undefined,
        brand_id: undefined,
        mrp: 0,
        purchase_price: 0,
        sales_price: 0,
        tax_id: undefined,
        unit_id: undefined,
        description: "",
        purchase_tax_type: "exclusive",
        sales_tax_type: "exclusive",
        custom_fields: [],
        opening_stock: undefined,
        opening_stock_date: undefined,
        wholesale_price: undefined,
        wholesale_quantity: undefined,
        product_type: "single",
        variations: [],
        supplier: "",
        size: "",
        model: "",
        design: "",
    };

    const columns = [
        {
            title: "",
            dataIndex: "status",
        },
        {
            title: t("product.product"),
            dataIndex: "name",
        },
        // {
        //     title: t("warehouse.warehouse"),
        //     dataIndex: "warehouse_id",
        // },
        {
            title: t("product.category"),
            dataIndex: "category_id",
        },
        {
            title: t("product.brand"),
            dataIndex: "brand_id",
        },
        {
            title: t("product.sales_price"),
            dataIndex: "sales_price",
        },
        {
            title: t("product.purchase_price"),
            dataIndex: "purchase_price",
        },
        {
            title: t("product.current_stock"),
            dataIndex: "current_stock",
        },
        {
            title: t("common.action"),
            dataIndex: "action",
        },
    ];

    const variableProductcolumns = [
        {
            title: t("product.product"),
            dataIndex: "name",
        },
        {
            title: t("product.category"),
            dataIndex: "category_id",
        },
        {
            title: t("product.brand"),
            dataIndex: "brand_id",
        },
        {
            title: t("common.action"),
            dataIndex: "action",
        },
    ];

    const variantColumns = [
        {
            title: t("product.product"),
            dataIndex: "name",
        },
        {
            title: t("product.item_code"),
            dataIndex: "item_code",
        },
        {
            title: t("product.sales_price"),
            dataIndex: "sales_price",
        },
        {
            title: t("product.purchase_price"),
            dataIndex: "purchase_price",
        },
        {
            title: t("product.current_stock"),
            dataIndex: "current_stock",
        },
        {
            title: t("common.action"),
            dataIndex: "action",
        },
    ];

    const filterableColumns = [
        {
            key: "name",
            value: t("product.name"),
        },
        {
            key: "supplier",
            value: t("product.supplier"),
        },
        {
            key: "size",
            value: t("product.size"),
        },
        {
            key: "model",
            value: t("product.model"),
        },
        {
            key: "design",
            value: t("product.design"),
        },
        {
            key: "gold_type",
            value: t("product.gold_type"),
        },
        {
            key: "jewerly_group",
            value: t("product.jewerly_group"),
        },
        {
            key: "stone_type",
            value: t("product.stone_type"),
        },
    ];

    return {
        addEditUrl,
        initData,
        columns,
        variableProductcolumns,
        variantColumns,
        filterableColumns,
        hashableColumns,
        multiDimensalObjectColumns,
    };
};

export default fields;
