import './bootstrap';
import 'tw-elements';

import Alpine from 'alpinejs';
import Search from './pages/search';
import Alert from './components/Alert';

import { livewire_hot_reload } from 'virtual:livewire-hot-reload'
livewire_hot_reload();

window.Alpine = Alpine;

Alpine.start();

const searchPage = new Search();
const alert = new Alert();
