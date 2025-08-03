window._ = require('lodash');

try {
    window.axios = require('axios');

    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
} catch (e) {
    console.error('Failed to load dependencies in bootstrap.js', e);
}
