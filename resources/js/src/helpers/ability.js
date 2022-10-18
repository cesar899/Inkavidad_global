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
];
export default { admin, seller };
