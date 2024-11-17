/**
 * Обвинувачувати
 *
 * Повертає функцію, яка не запускатиметься, поки вона продовжує викликатися. Функція буде викликана 
 * після того, як вона перестане викликатися протягом N мілісекунд. Якщо передано `immediate`, 
 * функція запускається по передньому фронту а не по задньому.
 * 
 * 
 * Результатом декоратора debounce(f, ms) має бути обгортка,
 * яка передає виклик f не більше одного разу на ms мілісекунд. 
 * Інакше кажучи, коли ми викликаємо debounce, це гарантує, 
 * що й інші виклики будуть ігноруватися протягом ms.
 *
 * @param wait
 * @param func
 * @param immediate
 * @returns {Function}
 */
export const debounce = (wait, func, immediate) => {
    let timeout;

    return function () {
        let context = this, args = arguments;
        let later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        let callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};