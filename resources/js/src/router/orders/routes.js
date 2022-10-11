export default [
	{
        path: '/ordenes',
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
    {
        path: '/estado/lotes',
        name: 'estados',
        component: () => import('@/views/orders/estadoLotes.vue'),
        meta: {
            pageTitle: 'Estado de Lotes',
            breadcrumb: [
                {
                    text: 'Estados',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/estado/lotes/pago',
        name: 'pago',
        component: () => import('@/views/orders/proxPago.vue'),
        meta: {
            pageTitle: 'Proximo Pago',
            breadcrumb: [
                {
                    text: 'Proximo Pago',
                    active: true,
                },
              ],
        },
    },
]