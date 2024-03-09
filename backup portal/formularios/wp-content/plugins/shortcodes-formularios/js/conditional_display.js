const radioName = '__RADIO_NAME__';
const hideValue = /__HIDE_VALUE__/;
const displayClass = '__DISPLAY_CLASS__';

document.getElementsByName(radioName).forEach(radioOption => {
    radioOption.addEventListener('change', function () {
        if (hideValue.test(Array.from(document.getElementsByName(radioName)).find(r => r.checked).value)) {
            document.getElementsByClassName(displayClass)[0].style.display = "none";
            document.querySelectorAll('.' + displayClass + ' textarea').forEach(textarea => textarea.value = "");
            document.querySelectorAll('.' + displayClass + ' input').forEach(textarea => textarea.value = "");
        } else {
            document.getElementsByClassName(displayClass)[0].style.display = "block";
        }
    })
});