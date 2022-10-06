export default [
	{
        path: '/orders',
        name: 'orders',
        component: () => import('@/views/orders/index.vue'),
        meta: {
            pageTitle: 'orders',
            breadcrumb: [
                {
                    text: 'order',
                    active: true,
                },
              ],
        },
    },
]