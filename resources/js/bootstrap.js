import 'bootstrap';
import './adminLteJs/jquery.js';
import './adminLteJs/bootstrap.bundle.min.js';
import './adminLteJs/adminlte.min.js'



/**
 * Мы загрузим HTTP-библиотеку axios, которая позволяет нам легко отправлять запросы
 * в нашу серверную часть Laravel. Эта библиотека автоматически обрабатывает отправку токена
 * CSRF в виде заголовка на основе значения cookie-файла токена "XSRF".
 */

import axios from 'axios';
import router from "./router/index.js";
//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios = axios;
window.axios.defaults.withCredentials = true;

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
axios.interceptors.response.use(function (response) {
    return response;
}, function (error)  {

    if (error.response.status === 401 || error.response.status === 419) {
        const token = localStorage.getItem('x_xsrf_token')
        localStorage.removeItem('l')
        localStorage.removeItem('uid')

        if (token) {
            localStorage.removeItem('x_xsrf_token')
        }

        router.push({name: 'login.page'})
        return Promise.reject(error);
    }
});

/**
 * Echo предоставляет расширенный API для подписки на каналы и прослушивания
 * событий, транслируемых Laravel. Echo и event broadcasting
 * позволяют вашей команде легко создавать надежные веб-приложения реального времени.
 * */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
