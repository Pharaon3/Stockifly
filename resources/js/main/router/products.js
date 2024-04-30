import Brands from '../views/product-manager/brands/index.vue';
import Categories from '../views/product-manager/categories/index.vue';
import Stonetype from '../views/product-manager/stonetype/index.vue';
import Jewerlygroup from '../views/product-manager/jewerlygroup/index.vue';
import Goldtype from '../views/product-manager/goldtype/index.vue';
import Products from '../views/product-manager/products/index.vue';
import Variation from '../views/product-manager/variations/index.vue';

export default [
    {
        path: '/',
        component: () => import('../../common/layouts/Admin.vue'),
        children: [
            {
                path: '/admin/brands',
                component: Brands,
                name: 'admin.brands.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "brands",
                    permission: "brands_view",
                }
            },
            {
                path: '/admin/categories',
                component: Categories,
                name: 'admin.categories.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "categories",
                    permission: "categories_view",
                }
            },
            {
                path: '/admin/stonetype',
                component: Stonetype,
                name: 'admin.stonetype.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "stonetype",
                    permission: "stonetype_view",
                }
            },
            {
                path: '/admin/goldtype',
                component: Goldtype,
                name: 'admin.goldtype.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "goldtype",
                    permission: "goldtype_view",
                }
            },
            {
                path: '/admin/jewerlygroup',
                component: Jewerlygroup,
                name: 'admin.jewerlygroup.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "jewerlygroup",
                    permission: "jewerlygroup_view",
                }
            },
            {
                path: '/admin/products',
                component: Products,
                name: 'admin.products.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "products",
                    permission: "products_view",
                }
            },
            {
                path: '/admin/variations',
                component: Variation,
                name: 'admin.variations.index',
                meta: {
                    requireAuth: true,
                    menuParent: "product_manager",
                    menuKey: route => "variations",
                    permission: "products_view",
                }
            },
        ]
    }
];
