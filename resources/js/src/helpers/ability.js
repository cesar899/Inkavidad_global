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
];
export default { admin, seller };
