import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Window._ = require('lodash');
window.Popper = require('@popperjs/core').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');
import 'alpinejs';

// Socket.io client
import io from 'socket.io-client';
window.io = io;