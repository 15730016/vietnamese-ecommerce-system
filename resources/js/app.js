import '../css/app.css';

// Import axios for AJAX requests
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import mobile menu functionality
import './mobile-menu';
