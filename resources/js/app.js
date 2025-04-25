window.$ = window.jQuery = require('jquery');
require('jquery-slimscroll');
require('bootstrap');
// require('alpinejs');
require('select2');
require('./adminlte');

import Alpine from 'alpinejs';
import axios from 'axios';
import Choices from 'choices.js';

window.Alpine = Alpine;
window.axios = axios;
window.Choices = Choices;

Alpine.start();
