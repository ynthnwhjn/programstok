window.$ = window.jQuery = require('jquery');
require('jquery-slimscroll');
require('bootstrap');
require('select2');
require('./adminlte');

import flatpickr from "flatpickr";
window.flatpickr = flatpickr;

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import axios from 'axios';
window.axios = axios;

import Choices from 'choices.js';
window.Choices = Choices;

Alpine.start();
