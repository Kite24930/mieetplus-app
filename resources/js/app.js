import './bootstrap';
import '../css/app.css';
import { app, analytics } from "./module/firebase.js";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
