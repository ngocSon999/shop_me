import './bootstrap';

window.Echo.private(`customer.${customerId}`)
    .listen('ChangeCoin');

window.Echo.private(`Send-Notify-Recharge-Card.${customerId}`)
    .listen('SendNotifyRechargeCard', (e) => {
        console.log('data', e);
    });
