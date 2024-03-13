import './bootstrap';
import Echo from "laravel-echo";

Echo.private('customer.' + Auth::id())
    .notification((notification) => {
        console.log(notification.type);
    });
