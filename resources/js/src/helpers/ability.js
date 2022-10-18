const admin = [
    {
        action: "read",
        subject: "user",
    },
    {
        action: "read",
        subject: "adminBatch",
    },
    {
        action: "read",
        subject: "orderList",
    },
    {
        action: "read",
        subject: "sellersList",
    },
    {
        action: "read",
        subject: "clientsList",
    },
    {
        action: "read",
        subject: "saleList",
    },
];
const seller = [
    {
        action: "read",
        subject: "user",
    },
    {
        action: "read",
        subject: "sellerBatch",
    },
    {
        action: "read",
        subject: "sellersList",
    },
    {
        action: "read",
        subject: "clientsList",
    },
    {
        action: "read",
        subject: "saleList",
    }
];
export default { admin, seller };
