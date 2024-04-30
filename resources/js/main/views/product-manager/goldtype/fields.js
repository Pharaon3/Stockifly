import { useI18n } from "vue-i18n";

const fields = () => {
	const addEditUrl = "goldtype";
	const { t } = useI18n();
	const hashableColumns = ['parent_id'];

	const initData = {
		name: ""
	};

	const columns = [
		{
			title: t("goldtype.name"),
			dataIndex: "name",
		},
		// {
		// 	title: t("goldtype.logo"),
		// 	dataIndex: "image_url",
		// },

		{
			title: t("common.action"),
			dataIndex: "action",
		},
	];

	return {
		hashableColumns,
		addEditUrl,
		initData,
		columns,
	}
}

export default fields;
