// Ви можете імпортувати модулі з теми lib або навіть з
// NPM packages якщо вони підтримують це ...
import SimpleComponent from "./components/SimpleComponent";

// також можете require модулі, якщо вони підтримують це ...
const NullComponent = require('./components/NullComponent');

// lotties web player
import "@lottiefiles/lottie-player";

//aos
import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init({
    duration: 1200,
    easing: 'ease-in-out-back',
}
);


//AlpineJS
import Alpine from 'alpinejs'
 
window.Alpine = Alpine
 
Alpine.start()

// Ініціалізація наших компонентів d jQuery.ready...
// jQuery(function ($) {
//     SimpleComponent.init();
//     NullComponent.init();
// });