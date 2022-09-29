export default [
    {
        path: '/batchs',
        name: 'batchs',
        component: () => import('@/views/batchs'),
        meta: {
            pageTitle: 'Batch',
            breadcrumb: [
                {
                    text: 'Batch',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/batchs/create',
        name: 'batchs-create',
        component: () => import('@/views/batchs/create'),
        meta: {
            pageTitle: 'Crear Lote',
            breadcrumb: [
                {
                    text: 'crear lote',
                    active: true,
                },
              ],
        },
    },
    {
        path: '/batchs/:batch_id/selection',
        name: 'batch-selection',
        component: () => import('@/views/batchs/selected.vue'),
        meta: {
            pageTitle: 'Seleción del Lote',
            breadcrumb: [
                {
                    text: 'seleción del lote',
                    active: true,
                },
              ],
        },
    },
]