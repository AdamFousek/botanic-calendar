import './bootstrap';
import 'tw-elements';

import Alpine from 'alpinejs';
import Search from './pages/search';

window.Alpine = Alpine;

Alpine.start();

const searchPage = new Search();
