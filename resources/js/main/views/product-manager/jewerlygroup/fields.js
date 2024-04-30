import { useI18n } from "vue-i18n";

const fields = () => {
	const addEditUrl = "jewerlygroup";
	const { t } = useI18n();
	const hashableColumns = ['parent_id'];

	const initData = {
		name: ""
	};

	const columns = [
		{
			title: t("jewerlygroup.name"),
			dataIndex: "name",
		},
		// {
		// 	title: t("jewerlygroup.logo"),
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
